<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\School;
use App\Models\LeaveApplication;

class ClerkController extends Controller
{
    public function index()
    {
        return view('school.registerClerk');
    }

    public function store(Request $request)
    {
        $schoolId = session('school_id');

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
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
                'role' => 'CLERK',
                'user_password' => Hash::make('Clerk@123'),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
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
            return redirect('/schoolDashboard')->with('success', 'Clerk registered successfully!');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return redirect('/registerClerk')->with('error', 'Clerk already exists!');
            }
        } catch (\Exception $e) {
            return redirect('/registerClerk')->with('error', 'An error occurred!');
        }
    }

    public function fetchUserAttendance(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
        ]);

        $attendance = Attendance::where('user_id', $request->user_id)
            ->where('date', $request->date)
            ->first();

        return view('attendance.user_attendance', compact('attendance'));
    }

    public function updateUserAttendance(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'status' => 'required|in:PRESENT,ABSENT',
            'check_in_time' => 'nullable',
            'check_out_time' => 'nullable',
        ]);

        Attendance::updateOrCreate(
            ['user_id' => $request->user_id, 'date' => $request->date],
            [
                'status' => $request->status,
                'check_in_time' => $request->check_in_time,
                'check_out_time' => $request->check_out_time,
                'method' => 'MANUAL',
            ]
        );

        return redirect()->back()->with('success', 'Attendance updated successfully.');
    }

    public function liveAbsentees()
    {
        $schoolId = Auth::user()->school_id;
        $today = now()->toDateString();
        $this->markApprovedLeaveAsAbsent();

        $absentees = \App\Models\User::whereIn('role', ['TEACHER', 'PRINCIPAL', 'SECTIONAL_HEAD'])
            ->where('school_id', $schoolId)
            ->whereDoesntHave('attendances', function ($query) use ($today) {
                $query->where('date', $today)
                    ->where('status', 'PRESENT');
            })
            ->get();

        return view('clerk.absenteesclerk', compact('absentees'));
    }

    public function markApprovedLeaveAsAbsent()
    {
        $today = Carbon::today()->toDateString();

        $leaveApplications = LeaveApplication::whereHas('latestStatus', function ($query) {
            $query->where('status', 'APPROVED');
        })
            ->whereDate('commence_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->get();

        foreach ($leaveApplications as $application) {
            Attendance::updateOrCreate(
                [
                    'user_id' => $application->user_id,
                    'date' => $today,
                ],
                [
                    'status' => 'ABSENT',
                    'method' => 'MANUAL',
                    'check_in_time' => null,
                    'check_out_time' => null,
                ]
            );
        }
    }

    public function liveAttendanceView()
    {
        $clerk = Auth::user();
        $schoolId = $clerk->school_id;
        $today = now()->toDateString();

        $attendances = Attendance::with('user')
            ->whereDate('date', $today)
            ->where('status', 'PRESENT')
            ->whereHas('user', function ($query) use ($schoolId) {
                $query->where('school_id', $schoolId)
                    ->whereIn('role', ['TEACHER', 'PRINCIPAL', 'SECTIONAL_HEAD']);
            })
            ->get();

        return view('clerk.liveAttendanceclerk', compact('attendances'));
    }

    public function dashboard()
    {
        $schoolId = Auth::user()->school_id;

        $attendanceRecords = Attendance::with('user')
            ->whereHas('user', function ($query) use ($schoolId) {
                $query->where('school_id', $schoolId)
                    ->whereIn('role', ['TEACHER', 'PRINCIPAL', 'SECTIONAL_HEAD']);
            })
            ->orderByDesc('date')
            ->get();

        return view('clerk.clerkDashboard', compact('attendanceRecords'));
    }

    public function assignDutyLeave()
    {
        if (Auth::user()->role !== 'CLERK') {
            abort(403, 'Unauthorized access.');
        }

        $schoolId = Auth::user()->school_id;
        $teachers = User::where('school_id', $schoolId)
            ->where('role', 'TEACHER')
            ->get();
        return view('clerk.assign_duty_leave', compact('teachers'));
    }
}