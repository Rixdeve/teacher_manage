<?php

namespace App\Http\Controllers;

use App\Mail\LeaveReqestRecivedMail;
use App\Mail\LeaveRequestUpdateMail;
use App\Mail\PHPMailerService;
use App\Models\LeaveApplication;
use App\Models\LeaveStatus;
use App\Models\LeaveCounter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use App\Mail\LeaveRequestMail;
use Illuminate\Support\Facades\Mail;

class LeaveApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $year = now()->year;
        $leaveCounter = LeaveCounter::getOrCreateForUser(Auth::id(), $year);
        $user = Auth::user();

        if ($user->role === 'PRINCIPAL') {
            return view('Principal.leaveform', compact('leaveCounter'));
        } elseif ($user->role === 'SECTION_HEAD') {
            return view('Sectional_head.leave_applications', compact('leaveCounter'));
        } else {
            return view('Teacher.leave_application', compact('leaveCounter'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'commence_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:commence_date',
            'leave_type' => 'required|string',
            'reason' => 'nullable|string',
            'attachment_url_1' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'attachment_url_2' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'attachment_url_3' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        ]);
        $subject = 'Leave Request Submitted';
        $name = Auth::user()->name;
        $user_email = Auth::user()->user_email;
        $leave_type = strtoupper($request->leave_type);
        $start_date = $request->commence_date;
        $end_date = $request->end_date;
        $reason = $request->reason;
        $user = Auth::user();
        $principal = $user->school?->principal;
        $leaveType = strtoupper($request->leave_type);
        $principal_email = $principal->user_email ?? null;
        $principal_name = $principal->name ?? null;
        $principal_subject = 'Leave Request Recived From ' . $user->name;
        $mailService = new PHPMailerService();

        $leaveApplication = new LeaveApplication();
        $leaveApplication->user_id = Auth::id();
        $leaveApplication->commence_date = $request->commence_date;
        $leaveApplication->end_date = $request->end_date;
        $leaveApplication->leave_type = $leaveType;

        Log::info('Leave Application Dates', [
            'commence_date' => $request->commence_date,
            'end_date' => $request->end_date,
            'leave_days' => $leaveApplication->leave_days,
        ]);

        $leaveDaysByYear = $leaveApplication->leave_days_by_year;

        if (in_array($leaveType, ['CASUAL', 'MEDICAL'])) {
            foreach ($leaveDaysByYear as $year => $days) {
                $leaveCounter = LeaveCounter::getOrCreateForUser($user->id, $year);

                if ($leaveType === 'CASUAL') {
                    $remainingCasual = $leaveCounter->total_casual;
                    if ($remainingCasual < $days) {
                        return redirect()->route('leave.create')->with('error', "You only have {$remainingCasual} casual leave days remaining for {$year}.");
                    }
                } elseif ($leaveType === 'MEDICAL') {
                    $remainingMedical = $leaveCounter->total_medical;
                    if ($remainingMedical < $days) {
                        return redirect()->route('leave.create')->with('error', "You only have {$remainingMedical} medical leave days remaining for {$year}.");
                    }
                }
            }
        } elseif ($leaveType === 'SHORT') {
            $year = Carbon::parse($request->commence_date)->year;
            $leaveCounter = LeaveCounter::getOrCreateForUser($user->id, $year);
            if ($leaveCounter->total_short < 1) {
                return redirect()->route('leave.create')->with('error', 'You have exhausted your short leave balance.');
            }
        }

        $leaveApplication->reason = $request->reason;

        // Store files in the private_leave_attachments disk
        if ($request->hasFile('attachment_url_1')) {
            $leaveApplication->attachment_url_1 = $request->file('attachment_url_1')->store('', 'private_leave_attachments');
        }
        if ($request->hasFile('attachment_url_2')) {
            $leaveApplication->attachment_url_2 = $request->file('attachment_url_2')->store('', 'private_leave_attachments');
        }
        if ($request->hasFile('attachment_url_3')) {
            $leaveApplication->attachment_url_3 = $request->file('attachment_url_3')->store('', 'private_leave_attachments');
        }

        $leaveApplication->save();

        LeaveStatus::create([
            'leave_id' => $leaveApplication->id,
            'user_id' => Auth::id(),
            'status' => 'PENDING',
        ]);
        Mail::to($user_email)->send(new LeaveRequestMail($name, $subject, $leaveType, $start_date, $end_date, $reason));

        // $mailService->sendMail($user->user_email, 'Leave Request Submitted', 'Your leave request has been successfully submitted.');
        Mail::to($principal_email)->send(new LeaveReqestRecivedMail($principal_name, $principal_email, $name, $principal_subject, $leave_type, $start_date, $end_date, $reason));
        return redirect()->route('leave.create')->with('success', 'Leave application submitted successfully.');
    }

    public function index()
    {
        if (Auth::user()->role !== 'PRINCIPAL') {
            abort(403, 'Unauthorized access.');
        }

        $applications = LeaveApplication::with(['user', 'latestStatus'])
            ->whereHas('latestStatus', function ($query) {
                $query->where('status', 'PENDING');
            })
            ->get()
            ->map(function ($application) {
                // Check if each attachment exists
                $application->has_attachment_1 = $application->attachment_url_1 && Storage::disk('private_leave_attachments')->exists($application->attachment_url_1);
                $application->has_attachment_2 = $application->attachment_url_2 && Storage::disk('private_leave_attachments')->exists($application->attachment_url_2);
                $application->has_attachment_3 = $application->attachment_url_3 && Storage::disk('private_leave_attachments')->exists($application->attachment_url_3);
                return $application;
            });

        return view('Principal.leave_applications', compact('applications'));
    }

    public function updateStatus(Request $request, $leaveId)
    {

        $request->validate([
            'status' => 'required|in:APPROVED,REJECTED',
            'comment' => 'nullable|string',
        ]);
        $leaveApplication = LeaveApplication::findOrFail($leaveId);
        $teacher_name = $leaveApplication->user->name;
        $teacher_email = $leaveApplication->user->user_email;

        $subject = 'Leave Request Status Updated';
        $leave_type = strtoupper($leaveApplication->leave_type);
        $start_date = $leaveApplication->commence_date;
        $end_date = $leaveApplication->end_date;
        $reject_comment = $request->comment;
        $status = $request->status;


        if (Auth::user()->role !== 'PRINCIPAL') {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $latestStatus = $leaveApplication->latestStatus;
        if (!$latestStatus) {
            return redirect()->back()->with('error', 'Leave status not found.');
        }

        $user = $leaveApplication->user;
        $leaveDaysByYear = $leaveApplication->leave_days_by_year;

        if ($request->status === 'APPROVED') {
            if (in_array($leaveApplication->leave_type, ['CASUAL', 'MEDICAL'])) {
                foreach ($leaveDaysByYear as $year => $days) {
                    $leaveCounter = LeaveCounter::getOrCreateForUser($user->id, $year);

                    if ($leaveApplication->leave_type === 'CASUAL') {
                        $remainingCasual = $leaveCounter->total_casual;
                        if ($remainingCasual < $days) {
                            return redirect()->route('leave.index')->with('error', "User only has {$remainingCasual} casual leave days remaining for {$year}.");
                        }
                        $leaveCounter->total_casual -= $days;
                    } elseif ($leaveApplication->leave_type === 'MEDICAL') {
                        $remainingMedical = $leaveCounter->total_medical;
                        if ($remainingMedical < $days) {
                            return redirect()->route('leave.index')->with('error', "User only has {$remainingMedical} medical leave days remaining for {$year}.");
                        }
                        $leaveCounter->total_medical -= $days;
                    }

                    $leaveCounter->save();
                }
            } elseif ($leaveApplication->leave_type === 'SHORT') {
                $year = Carbon::parse($leaveApplication->commence_date)->year;
                $leaveCounter = LeaveCounter::getOrCreateForUser($user->id, $year);
                if ($leaveCounter->total_short < 1) {
                    return redirect()->route('leave.index')->with('error', 'User has exhausted their short leave balance.');
                }
                $leaveCounter->total_short -= 1;

                $leaveCounter->save();
            }
        }

        $latestStatus->update([
            'status' => $request->status,
            'comment' => $request->comment,
        ]);
        Mail::to(($teacher_email))->send(new LeaveRequestUpdateMail($teacher_name, $subject, $teacher_email, $leave_type, $start_date, $end_date, $status, $reject_comment));

        return redirect()->route('leave.index')->with('success', 'Leave application status updated successfully.');
    }

    public function history()
    {
        $pastApplications = LeaveApplication::where('user_id', Auth::id())
            ->with('latestStatus')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Teacher.LeaveStatus', compact('pastApplications'));
    }

    // public function record()
    // {
    //     if (Auth::user()->role !== 'PRINCIPAL') {
    //         return redirect()->back()->with('error', 'Unauthorized access.');
    //     }

    //     $schoolId = Auth::user()->school_id;

    //     $approvedLeaves = LeaveApplication::whereHas('latestStatus', function ($query) {
    //         $query->where('status', 'APPROVED');
    //     })
    //         ->whereHas('user', function ($query) use ($schoolId) {
    //             $query->where('school_id', $schoolId);
    //         })
    //         ->with(['user', 'latestStatus'])
    //         ->orderBy('updated_at', 'desc')
    //         ->paginate(5);

    //     return view('Principal.leave_record', compact('approvedLeaves'));
    // }
    public function record()
    {
        if (Auth::user()->role !== 'PRINCIPAL') {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        $schoolId = Auth::user()->school_id;

        $approvedLeaves = LeaveApplication::whereHas('latestStatus', function ($query) {
            $query->where('status', 'APPROVED');
        })
            ->whereHas('user', function ($query) use ($schoolId) {
                $query->where('school_id', $schoolId);
            })
            ->with(['user', 'latestStatus'])
            ->orderBy('updated_at', 'desc')
            ->paginate(5)
            ->through(function ($leave) {

                $leave->has_attachment_1 = $leave->attachment_url_1 && Storage::disk('private_leave_attachments')->exists($leave->attachment_url_1);
                $leave->has_attachment_2 = $leave->attachment_url_2 && Storage::disk('private_leave_attachments')->exists($leave->attachment_url_2);
                $leave->has_attachment_3 = $leave->attachment_url_3 && Storage::disk('private_leave_attachments')->exists($leave->attachment_url_3);
                return $leave;
            });

        return view('Principal.leave_record', compact('approvedLeaves'));
    }

    public function serveAttachment($id, $index)
    {
        if (Auth::user()->role !== 'PRINCIPAL') {
            abort(403, 'Unauthorized access.');
        }

        $application = LeaveApplication::findOrFail($id);
        $attachmentField = 'attachment_url_' . $index;

        if (!$application->$attachmentField || !Storage::disk('private_leave_attachments')->exists($application->$attachmentField)) {
            abort(404, 'Attachment not found.');
        }

        $filePath = Storage::disk('private_leave_attachments')->path($application->$attachmentField);
        $mimeType = \Illuminate\Support\Facades\File::mimeType($filePath);

        return response()->file($filePath, [
            'Content-Type' => $mimeType,
        ]);
    }
}
