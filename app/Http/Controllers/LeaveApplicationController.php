<?php


namespace App\Http\Controllers;

use App\Models\LeaveApplication;
use App\Models\LeaveStatus;
use App\Models\LeaveCounter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


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

        return view('Teacher.leave_Application', compact('leaveCounter'));
    }
    // public function create()
    // {
    //     $year = now()->year;
    //     $leaveCounter = LeaveCounter::getOrCreateForUser(Auth::id(), $year);
    //     $user = Auth::user();


    //     if ($user->role === 'PRINCIPAL') {
    //         return view('Principal.leave_applications', compact('leaveCounter'));
    //     } elseif ($user->role === 'SECTION_HEAD') {
    //         return view('Sectional_head.leave_applications', compact('leaveCounter'));
    //     } else {
    //         return view('Teacher.leave_application', compact('leaveCounter'));
    //     }
    // }


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

        $user = Auth::user();
        $leaveType = strtoupper($request->leave_type);

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

        if ($request->hasFile('attachment_url_1')) {
            $leaveApplication->attachment_url_1 = $request->file('attachment_url_1')->store('leave_attachments');
        }
        if ($request->hasFile('attachment_url_2')) {
            $leaveApplication->attachment_url_2 = $request->file('attachment_url_2')->store('leave_attachments');
        }
        if ($request->hasFile('attachment_url_3')) {
            $leaveApplication->attachment_url_3 = $request->file('attachment_url_3')->store('leave_attachments');
        }

        $leaveApplication->save();

        LeaveStatus::create([
            'leave_id' => $leaveApplication->id,
            'user_id' => Auth::id(),
            'status' => 'PENDING',
        ]);

        return redirect()->route('leave.create')->with('success', 'Leave application submitted successfully.');
    }

    // public function index()
    // {
    //     $applications = LeaveApplication::with(['user', 'latestStatus'])
    //         ->whereHas('latestStatus', function ($query) {
    //             $query->where('status', 'PENDING');
    //         })
    //         ->get();

    //     return view('Principal.leave_applications', compact('applications'));
    // }
    public function index()
    {
        $applications = LeaveApplication::with(['user', 'latestStatus'])
            ->whereHas('latestStatus', function ($query) {
                $query->where('status', 'PENDING');
            })
            ->get();

        return view('Principal.leave_applications', compact('applications'));
    }



    public function updateStatus(Request $request, $leaveId)
    {
        $request->validate([
            'status' => 'required|in:APPROVED,REJECTED',
            'comment' => 'nullable|string',
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
            ->paginate(5);

        return view('Principal.leave_record', compact('approvedLeaves'));
    }
}
