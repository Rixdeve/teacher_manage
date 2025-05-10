<?php

namespace App\Http\Controllers;

use App\Models\LeaveApplication;
use App\Models\LeaveStatus;
use App\Models\LeaveCounter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

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

    public function clerkCreate()
    {
        if (Auth::user()->role !== 'CLERK') {
            abort(403, 'Unauthorized access.');
        }

        $schoolId = Auth::user()->school_id;
        $users = User::where('school_id', $schoolId)
            ->whereIn('role', ['TEACHER', 'PRINCIPAL', 'SECTION_HEAD', 'CLERK'])
            ->get();
        return view('clerk.manual_leave_application', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'commence_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:commence_date',
            'leave_type' => 'required|string',
            'reason' => 'required|string',
            'attachments.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        ]);

        $user = Auth::user();
        $leaveType = strtoupper($request->leave_type);
        $targetUserId = $request->input('user_id', Auth::id());

        if ($user->role === 'CLERK' && $request->has('user_id')) {
            $targetUser = User::findOrFail($targetUserId);
            if ($targetUser->school_id !== $user->school_id) {
                return redirect()->route('clerk.leave.create')->with('error', 'You can only submit leave applications for users in your school.');
            }
        }

        $leaveApplication = new LeaveApplication();
        $leaveApplication->user_id = $targetUserId;
        $leaveApplication->submitted_by = Auth::id();
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
                $leaveCounter = LeaveCounter::getOrCreateForUser($targetUserId, $year);

                if ($leaveType === 'CASUAL') {
                    $remainingCasual = $leaveCounter->total_casual;
                    if ($remainingCasual < $days) {
                        return redirect()->route($user->role === 'CLERK' ? 'clerk.leave.create' : 'leave.create')
                            ->with('error', "User only has {$remainingCasual} casual leave days remaining for {$year}.");
                    }
                } elseif ($leaveType === 'MEDICAL') {
                    $remainingMedical = $leaveCounter->total_medical;
                    if ($remainingMedical < $days) {
                        return redirect()->route($user->role === 'CLERK' ? 'clerk.leave.create' : 'leave.create')
                            ->with('error', "User only has {$remainingMedical} medical leave days remaining for {$year}.");
                    }
                }
            }
        } elseif ($leaveType === 'SHORT') {
            $year = Carbon::parse($request->commence_date)->year;
            $leaveCounter = LeaveCounter::getOrCreateForUser($targetUserId, $year);
            if ($leaveCounter->total_short < 1) {
                return redirect()->route($user->role === 'CLERK' ? 'clerk.leave.create' : 'leave.create')
                    ->with('error', 'User has exhausted their short leave balance.');
            }
        }

        $leaveApplication->reason = $request->reason;

        if ($request->hasFile('attachments')) {
            $attachments = $request->file('attachments');
            $attachmentFields = ['attachment_url_1', 'attachment_url_2', 'attachment_url_3'];
            foreach ($attachments as $index => $file) {
                if ($index < 3) {
                    $leaveApplication->{$attachmentFields[$index]} = $file->store('', 'private_leave_attachments');
                }
            }
        }

        $leaveApplication->save();

        LeaveStatus::create([
            'leave_id' => $leaveApplication->id,
            'user_id' => $targetUserId,
            'status' => 'PENDING',
        ]);

        return redirect()->route($user->role === 'CLERK' ? 'clerk.leave.create' : 'leave.create')
            ->with('success', 'Leave application submitted successfully.');
    }

    public function index()
    {
        if (Auth::user()->role !== 'PRINCIPAL') {
            abort(403, 'Unauthorized access.');
        }

        $schoolId = Auth::user()->school_id;

        $applications = LeaveApplication::with(['user', 'latestStatus'])
            ->whereHas('latestStatus', function ($query) {
                $query->where('status', 'PENDING');
            })
            ->whereHas('user', function ($query) use ($schoolId) {
                $query->where('school_id', $schoolId);
            })
            ->get()
            ->map(function ($application) {
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
            'comment' => 'required_if:status,REJECTED|string|nullable',
        ]);

        $leaveApplication = LeaveApplication::findOrFail($leaveId);

        if (Auth::user()->role !== 'PRINCIPAL') {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $latestStatus = $leaveApplication->latestStatus;
        if (!$latestStatus) {
            return redirect()->back()->with('error', 'Leave status not found.');
        }

        $user = $leaveApplication->user;
        $leaveDaysByYear = $leaveApplication->leave_days_by_year;

        Log::info('Updating leave status', [
            'leave_id' => $leaveId,
            'status' => $request->status,
            'leave_type' => $leaveApplication->leave_type,
            'leave_days_by_year' => $leaveDaysByYear,
        ]);

        if ($request->status === 'APPROVED') {
            try {
                if (in_array($leaveApplication->leave_type, ['CASUAL', 'MEDICAL'])) {
                    foreach ($leaveDaysByYear as $year => $days) {
                        $leaveCounter = LeaveCounter::getOrCreateForUser($user->id, $year);

                        Log::info('Processing leave counter', [
                            'user_id' => $user->id,
                            'year' => $year,
                            'leave_counter' => $leaveCounter->toArray(),
                            'days' => $days,
                        ]);

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

                        if (!$leaveCounter->save()) {
                            Log::error('Failed to save leave counter', [
                                'user_id' => $user->id,
                                'year' => $year,
                                'leave_type' => $leaveApplication->leave_type,
                            ]);
                            return redirect()->route('leave.index')->with('error', 'Failed to update leave balance.');
                        }
                    }
                } elseif ($leaveApplication->leave_type === 'SHORT') {
                    $year = Carbon::parse($leaveApplication->commence_date)->year;
                    $leaveCounter = LeaveCounter::getOrCreateForUser($user->id, $year);

                    Log::info('Processing short leave counter', [
                        'user_id' => $user->id,
                        'year' => $year,
                        'leave_counter' => $leaveCounter->toArray(),
                    ]);

                    if ($leaveCounter->total_short < 1) {
                        return redirect()->route('leave.index')->with('error', 'User has exhausted their short leave balance.');
                    }
                    $leaveCounter->total_short -= 1;

                    if (!$leaveCounter->save()) {
                        Log::error('Failed to save short leave counter', [
                            'user_id' => $user->id,
                            'year' => $year,
                        ]);
                        return redirect()->route('leave.index')->with('error', 'Failed to update short leave balance.');
                    }
                }
            } catch (\Exception $e) {
                Log::error('Error updating leave balance', [
                    'leave_id' => $leaveId,
                    'error' => $e->getMessage(),
                ]);
                return redirect()->route('leave.index')->with('error', 'An error occurred while updating the leave balance.');
            }
        }

        $latestStatus->update([
            'status' => $request->status,
            'comment' => $request->comment,
        ]);

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