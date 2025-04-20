<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveApplication;
use App\Models\LeaveStatus;
use App\Models\LeaveCounter;
use App\Models\ReliefAssignment;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Attendance;

class SectionalController extends Controller
{
    public function index()
    {
        return view('school.registerSectionhead');
    }

    public function store(Request $request)
    {
        $schoolId = session('school_id');
        $selectedSubjects = $request->input('subjects');

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'school_index' => 'required|numeric',
            'user_address_no' => 'required|string',
            'user_address_street' => 'required|string',
            'user_address_city' => 'required|string',
            'user_nic' => 'required|string|unique:users,user_nic',
            'user_dob' => 'required|date',
            'user_email' => 'required|email|unique:users,user_email',
            'user_phone' => 'required|numeric|digits:10|unique:users,user_phone',
            'profile_picture' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'status' => 'required',
        ]);

        if ($request->hasFile('profile_picture')) {
            $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        } else {
            $imagePath = null;
        }

        try {
            User::create([
                'school_id' => $schoolId,
                'role' => 'SECTIONAL_HEAD',
                'user_password' => Hash::make('Section@123'),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'section' => (string) trim($request->section),
                'subjects' => $selectedSubjects,
                'school_index' => $request->school_index,
                'user_address_no' => $request->user_address_no,
                'user_address_street' => $request->user_address_street,
                'user_address_city' => $request->user_address_city,
                'user_nic' => $request->user_nic,
                'user_dob' => $request->user_dob,
                'user_email' => $request->user_email,
                'user_phone' => $request->user_phone,
                'profile_picture' => $imagePath,
                'status' => $request->status,
                'registered_date' => now(),
            ]);
            return redirect('/schoolDashboard')->with('success', 'Sectional Head registered successfully!');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return redirect('/registerTeacher')->with('error', 'Sectional Head already exists!');
            }
        } catch (\Exception $e) {
            return redirect('/registerTeacher')->with('error', 'An error occurred!');
        }
    }

    public function showQRCode($id)
    {
        $teacher = User::findOrFail($id);
        $qrContent = $teacher->id;

        return view('zonal.qrcode', [
            'teacher' => $teacher,
            'qrCode' => QrCode::size(180)->generate($qrContent),
        ]);
    }

    public function logAttendance($id)
    {
        $user = User::findOrFail($id);
        $today = now()->toDateString();

        $attendance = Attendance::firstOrNew([
            'user_id' => $user->id,
            'date' => $today
        ]);

        if (!$attendance->exists || is_null($attendance->check_in_time)) {
            $attendance->status = 'PRESENT';
            $attendance->check_in_time = now()->format('H:i:s');
            $attendance->method = 'QR';
            $attendance->save();

            return response()->json(['message' => 'Check-in successful']);
        }

        if (is_null($attendance->check_out_time)) {
            $attendance->check_out_time = now()->format('H:i:s');
            $attendance->save();

            return response()->json(['message' => 'Check-out successful']);
        }

        return response()->json(['message' => 'Already checked in and out today']);
    }

    public function liveAttendanceView()
    {
        $sectionalHead = Auth::user();
        $schoolId = $sectionalHead->school_id;
        $section = $sectionalHead->section;
        $today = now()->toDateString();

        $attendances = Attendance::with('user')
            ->whereDate('date', $today)
            ->where('status', 'PRESENT')
            ->whereHas('user', function ($query) use ($schoolId, $section) {
                $query->where('school_id', $schoolId)
                    ->where('section', '=', (string) $section)
                    ->whereIn('role', ['TEACHER']);
            })
            ->get();

        return view('sectional_head.liveAttendance', compact('attendances'));
    }

    public function liveAbsentees()
    {
        $sectionalHead = Auth::user();
        $schoolId = $sectionalHead->school_id;
        $section = $sectionalHead->section;
        $today = now()->toDateString();

        $absentees = User::where('school_id', $schoolId)
            ->where('section', $section)
            ->whereIn('role', ['TEACHER'])
            ->whereDoesntHave('attendances', function ($query) use ($today) {
                $query->where('date', $today)
                    ->where('status', 'PRESENT');
            })
            ->get();

        return view('sectional_head.absenteessection', compact('absentees'));
    }

    public function dashboard()
    {
        $sectionalHead = Auth::user();
        $section = $sectionalHead->section;

        $applications = LeaveApplication::whereHas('latestStatus', function ($query) {
            $query->where('status', 'PENDING');
        })
            ->whereHas('user', function ($query) use ($section) {
                $query->where('section', $section)
                    ->where('role', 'TEACHER');
            })
            ->with('user', 'latestStatus')
            ->get();

        return view('sectional_head.dashboard', compact('applications'));
    }

    public function updateLeaveStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:APPROVED,REJECTED',
            'comment' => 'nullable|string|required_if:status,REJECTED',
        ]);

        $leaveApplication = LeaveApplication::findOrFail($id);
        $sectionalHead = Auth::user();

        if ($leaveApplication->user->section !== $sectionalHead->section) {
            abort(403, 'Unauthorized to update this leave application.');
        }

        $latestStatus = $leaveApplication->latestStatus;

        if (!$latestStatus) {
            return redirect()->route('sectional_head.dashboard')->with('error', 'Leave status not found.');
        }

        $user = $leaveApplication->user;
        $leaveDaysByYear = $leaveApplication->leave_days_by_year;

        if ($request->status === 'APPROVED') {
            if (in_array($leaveApplication->leave_type, ['CASUAL', 'MEDICAL'])) {
                foreach ($leaveDaysByYear as $year => $days) {
                    $leaveCounter = LeaveCounter::getOrCreateForUser($user->id, $year);
                    $totalLeaveDaysTaken = $user->getTotalLeaveDaysTaken($year);
                    $remainingLeaveDays = 20 - $totalLeaveDaysTaken;

                    if (($totalLeaveDaysTaken + $days) > 20) {
                        return redirect()->route('sectional_head.dashboard')->with('error', "This application would exceed the 20-day annual limit for CASUAL and MEDICAL leave in {$year}. User has already taken {$totalLeaveDaysTaken} days.");
                    }

                    if ($leaveApplication->leave_type === 'CASUAL') {
                        $remainingCasual = $leaveCounter->total_casual;
                        if ($remainingCasual < $days) {
                            return redirect()->route('sectional_head.dashboard')->with('error', "User only has {$remainingCasual} casual leave days remaining for {$year}.");
                        }
                        $leaveCounter->total_casual -= $days;
                    } elseif ($leaveApplication->leave_type === 'MEDICAL') {
                        $remainingMedical = $leaveCounter->total_medical;
                        if ($remainingMedical < $days) {
                            return redirect()->route('sectional_head.dashboard')->with('error', "User only has {$remainingMedical} medical leave days remaining for {$year}.");
                        }
                        $leaveCounter->total_medical -= $days;
                    }

                    $leaveCounter->save();
                }
            } else {
                $year = Carbon::parse($leaveApplication->commence_date)->year;
                $leaveCounter = LeaveCounter::getOrCreateForUser($user->id, $year);
                if ($leaveApplication->leave_type === 'SHORT' && $leaveCounter->total_short < 1) {
                    return redirect()->route('sectional_head.dashboard')->with('error', 'User has exhausted their short leave balance.');
                }

                $leaveCounter->total_short -= 1;
                $leaveCounter->save();
            }
        }

        $latestStatus->update([
            'status' => $request->status,
            'user_id' => $sectionalHead->id,
            'comment' => $request->comment,
        ]);

        return redirect()->route('sectional_head.dashboard')->with('success', 'Leave application status updated successfully.');
    }

    // public function showAssignReliefForm($leaveApplicationId)
    // {
    //     $leaveApplication = LeaveApplication::findOrFail($leaveApplicationId);
    //     $sectionalHead = Auth::user();

    //     if ($leaveApplication->user->section !== $sectionalHead->section) {
    //         abort(403, 'Unauthorized to assign relief for this leave application.');
    //     }

    //     $startDate = Carbon::parse($leaveApplication->commence_date);
    //     $endDate = Carbon::parse($leaveApplication->end_date);
    //     $dates = [];
    //     for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
    //         $dates[] = $date->toDateString();
    //     }

    //     return view('sectional_head.assign_relief', compact('leaveApplication', 'dates'));
    // }

    // public function getTeachers(Request $request, $leaveApplicationId)
    // {
    //     $leaveApplication = LeaveApplication::findOrFail($leaveApplicationId);
    //     $sectionalHead = Auth::user();
    //     $selectedDate = $request->query('date');

    //     if (!$selectedDate) {
    //         return response()->json(['error' => 'Date is required'], 400);
    //     }

    //     if ($leaveApplication->user->section !== $sectionalHead->section) {
    //         return response()->json(['error' => 'Unauthorized'], 403);
    //     }

    //     $absentTeachers = User::where('role', 'TEACHER')
    //         ->where('section', $sectionalHead->section)
    //         ->where('school_id', $sectionalHead->school_id)
    //         ->whereHas('leaveApplications', function ($query) use ($selectedDate) {
    //             $query->whereHas('latestStatus', function ($q) {
    //                 $q->where('status', 'APPROVED');
    //             })
    //                 ->whereDate('commence_date', '<=', $selectedDate)
    //                 ->whereDate('end_date', '>=', $selectedDate);
    //         })
    //         ->get(['id', 'first_name', 'last_name'])
    //         ->map(function ($teacher) {
    //             return [
    //                 'id' => $teacher->id,
    //                 'name' => $teacher->first_name . ' ' . $teacher->last_name,
    //             ];
    //         });

    //     $availableTeachers = User::where('role', 'TEACHER')
    //         ->where('section', $sectionalHead->section)
    //         ->where('school_id', $sectionalHead->school_id)
    //         ->whereDoesntHave('leaveApplications', function ($query) use ($selectedDate) {
    //             $query->whereHas('latestStatus', function ($q) {
    //                 $q->where('status', 'APPROVED');
    //             })
    //                 ->whereDate('commence_date', '<=', $selectedDate)
    //                 ->whereDate('end_date', '>=', $selectedDate);
    //         })
    //         ->get(['id', 'first_name', 'last_name'])
    //         ->map(function ($teacher) {
    //             return [
    //                 'id' => $teacher->id,
    //                 'name' => $teacher->first_name . ' ' . $teacher->last_name,
    //             ];
    //         });

    //     return response()->json([
    //         'absentTeachers' => $absentTeachers,
    //         'availableTeachers' => $availableTeachers,
    //     ]);
    // }

    // public function storeReliefAssignment(Request $request, $leaveApplicationId)
    // {
    //     $leaveApplication = LeaveApplication::findOrFail($leaveApplicationId);
    //     $sectionalHead = Auth::user();

    //     if ($leaveApplication->user->section !== $sectionalHead->section) {
    //         abort(403, 'Unauthorized to assign relief for this leave application.');
    //     }

    //     $request->validate([
    //         'date' => 'required|date',
    //         'absent_teacher_id' => 'required|exists:users,id',
    //         'relief_teacher_id' => 'required|exists:users,id',
    //         'time_slot' => 'required|string',
    //         'class' => 'required|string',
    //     ]);

    //     $absentTeacher = User::findOrFail($request->absent_teacher_id);
    //     if ($absentTeacher->section !== $sectionalHead->section || $absentTeacher->role !== 'TEACHER') {
    //         return redirect()->back()->with('error', 'Invalid absent teacher selected.');
    //     }

    //     $reliefTeacher = User::findOrFail($request->relief_teacher_id);
    //     if ($reliefTeacher->section !== $sectionalHead->section || $reliefTeacher->role !== 'TEACHER') {
    //         return redirect()->back()->with('error', 'Invalid relief teacher selected.');
    //     }

    //     $selectedDate = Carbon::parse($request->date);
    //     $isAbsent = $absentTeacher->leaveApplications()
    //         ->whereHas('latestStatus', function ($q) {
    //             $q->where('status', 'APPROVED');
    //         })
    //         ->whereDate('commence_date', '<=', $selectedDate)
    //         ->whereDate('end_date', '>=', $selectedDate)
    //         ->exists();

    //     if (!$isAbsent) {
    //         return redirect()->back()->with('error', 'The selected teacher is not on leave on this date.');
    //     }

    //     $isAvailable = !$reliefTeacher->leaveApplications()
    //         ->whereHas('latestStatus', function ($q) {
    //             $q->where('status', 'APPROVED');
    //         })
    //         ->whereDate('commence_date', '<=', $selectedDate)
    //         ->whereDate('end_date', '>=', $selectedDate)
    //         ->exists();

    //     if (!$isAvailable) {
    //         return redirect()->back()->with('error', 'The selected relief teacher is not available on this date.');
    //     }

    //     $reliefAssignment = ReliefAssignment::create([
    //         'leave_application_id' => $leaveApplication->id,
    //         'absent_teacher_id' => $request->absent_teacher_id,
    //         'relief_teacher_id' => $request->relief_teacher_id,
    //         'date' => $request->date,
    //         'time_slot' => $request->time_slot,
    //         'class' => $request->class,
    //     ]);

    //     Notification::create([
    //         'user_id' => $reliefTeacher->id,
    //         'title' => 'Relief Assignment',
    //         'message' => "You have been assigned as a relief teacher for {$absentTeacher->first_name} {$absentTeacher->last_name} on {$request->date} during {$request->time_slot} for class {$request->class}.",
    //         'read' => false,
    //     ]);

    //     return redirect()->route('sectional_head.dashboard')->with('success', 'Relief teacher assigned successfully, and notification sent.');
    // }

    // public function showNotifications()
    // {
    //     $user = Auth::user();
    //     $notifications = Notification::where('user_id', $user->id)
    //         ->orderBy('created_at', 'desc')
    //         ->get();

    //     return view('sectional_head.notifications', compact('notifications'));
    // }
}