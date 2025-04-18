<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveApplication;
use App\Models\LeaveStatus;
use App\Models\LeaveCounter;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
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
        // dd($request->all());
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
            'profile_picture' => 'required|image|mimes:jpg,png,jpeg|max:2048', // Only images, max size 2MB
            'status' => 'required',
        ]);
        if ($request->hasFile('profile_picture')) {
            $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        } else {
            $imagePath = null; // Default if no image is uploaded
        }
        try {
            User::create([
                'school_id' => $schoolId,
                'role' => 'SECTIONAL_HEAD',
                'user_password' => Hash::make('Section@123'),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'section' => $request->section,
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
                return redirect('/registerTeacher')->with('error', 'Seactional Head already exists!');
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
        // if($attendance->check_in_time < now()->subHours(8)->format('H:i:s')){
        //     return response()->json(['message' => 'Check-in time expired']);
        // }

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
                    ->where('section', $section)
                    ->whereIn('role', ['TEACHER', 'PRINCIPAL', 'SECTIONAL_HEAD']);
            })
            ->get();

        return view('sectional_head.liveAttendance', compact('attendances'));
    }


    public function liveAbsentees()
    {
        $schoolId = Auth::user()->school_id;
        $today = now()->toDateString();
        $sectionalHead = Auth::user();
        $section = $sectionalHead->section;
        $absentees = \App\Models\User::whereIn('role', ['TEACHER', 'PRINCIPAL', 'SECTIONAL_HEAD'])
            ->where('school_id', $schoolId)
            ->where('section', $section)
            ->whereDoesntHave('attendances', function ($query) use ($today) {
                $query->where('date', $today)
                    ->where('status', 'PRESENT');
            })
            ->get();

        return view('sectional_head.absenteessect', compact('absentees'));
    }

    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware(function ($request, $next) {
    //         if (Auth::user()->role !== 'SECTIONAL_HEAD') {
    //             abort(403, 'Unauthorized');
    //         }
    //         return $next($request);
    //     });
    // }

    public function dashboard()
    {
        $sectionalHead = Auth::user();
        $sectionId = $sectionalHead->section_id;

        $applications = LeaveApplication::whereHas('latestStatus', function ($query) {
            $query->where('status', 'PENDING');
        })
            ->whereHas('user', function ($query) use ($sectionId) {
                $query->where('section_id', $sectionId)
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

        if ($leaveApplication->user->section_id !== $sectionalHead->section_id) {
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

                    if ($leaveApplication->leave_type === 'CASUAL' && $leaveCounter->total_casual < $days) {
                        return redirect()->route('sectional_head.dashboard')->with('error', "User only has {$leaveCounter->total_casual} casual leave days remaining for {$year}.");
                    }
                    if ($leaveApplication->leave_type === 'MEDICAL' && $leaveCounter->total_medical < $days) {
                        return redirect()->route('sectional_head.dashboard')->with('error', "User only has {$leaveCounter->total_medical} medical leave days remaining for {$year}.");
                    }

                    if ($leaveApplication->leave_type === 'CASUAL') {
                        $leaveCounter->total_casual -= $days;
                    } elseif ($leaveApplication->leave_type === 'MEDICAL') {
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
}
