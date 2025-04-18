<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\User;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Database\QueryException;
// use Illuminate\Support\Facades\Auth;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;
// use App\Models\Attendance;


// class PrincipalController extends Controller
// {

//     public function index()
//     {
//         return view('school.registerPrincipal');
//     }
//     public function store(Request $request)
//     {
//         // dd($request->all());
//         $schoolId = session('school_id');

//         $request->validate([
//             'first_name' => 'required|string|max:255',
//             'last_name' => 'required|string|max:255',
//             'school_index' => 'required|numeric',
//             'user_address_no' => 'required|string',
//             'user_address_street' => 'required|string',
//             'user_address_city' => 'required|string',
//             'user_nic' => 'required|string|unique:users,user_nic',
//             'user_dob' => 'required|date',
//             'user_email' => 'required|email|unique:users,user_email',
//             'user_phone' => 'required|numeric|digits:10|unique:users,user_phone',
//             'profile_picture' => 'required|image|mimes:jpg,png,jpeg|max:2048',
//             'status' => 'required',
//         ]);
//         if ($request->hasFile('profile_picture')) {
//             $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
//         } else {
//             $imagePath = null;
//         }
//         try {
//             User::create([
//                 'school_id' => 100,
//                 'role' => 'PRINCIPAL',
//                 'user_password' => Hash::make('Principal@123'),
//                 'first_name' => $request->first_name,
//                 'last_name' => $request->last_name,
//                 'school_index' => $request->school_index,
//                 'user_address_no' => $request->user_address_no,
//                 'user_address_street' => $request->user_address_street,
//                 'user_address_city' => $request->user_address_city,
//                 'user_nic' => $request->user_nic,
//                 'user_dob' => $request->user_dob,
//                 'user_email' => $request->user_email,
//                 'user_phone' => $request->user_phone,
//                 'profile_picture' => $imagePath,
//                 'status' => $request->status,
//                 'registered_date' => now(),

//             ]);
//             return redirect('/schoolDashboard')->with('success', 'Principal registered successfully!');
//         } catch (QueryException $e) {
//             if ($e->errorInfo[1] == 1062) {
//                 return redirect('/registerPrincipal')->with('error', 'Principal already exists!');
//             }
//         } catch (\Exception $e) {
//             return redirect('/registerPrincipal')->with('error', 'An error occurred!');
//         }
//     }

//     public function showQRCode($id)
//     {
//         $teacher = User::findOrFail($id);
//         $qrContent = $teacher->id;

//         return view('zonal.qrcode', [
//             'teacher' => $teacher,
//             'qrCode' => QrCode::size(180)->generate($qrContent),
//         ]);
//     }



//     public function logAttendance($id)
//     {
//         $user = User::findOrFail($id);
//         $today = now()->toDateString();

//         $attendance = Attendance::firstOrNew([
//             'user_id' => $user->id,
//             'date' => $today
//         ]);

//         if (!$attendance->exists || is_null($attendance->check_in_time)) {
//             $attendance->status = 'PRESENT';
//             $attendance->check_in_time = now()->format('H:i:s');
//             $attendance->method = 'QR';
//             $attendance->save();

//             return response()->json(['message' => 'Check-in successful']);
//         }

//         if (is_null($attendance->check_out_time)) {
//             $attendance->check_out_time = now()->format('H:i:s');
//             $attendance->save();

//             return response()->json(['message' => 'Check-out successful']);
//         }
//         // if($attendance->check_in_time < now()->subHours(8)->format('H:i:s')){
//         //     return response()->json(['message' => 'Check-in time expired']);
//         // }

//         return response()->json(['message' => 'Already checked in and out today']);
//     }


//     public function dashboard()
//     {
//         $schoolId = Auth::user()->school_id;

//         $attendanceRecords = Attendance::with('user')
//             ->whereHas('user', function ($query) use ($schoolId) {
//                 $query->where('school_id', $schoolId)
//                     ->whereIn('role', ['TEACHER', 'PRINCIPAL', 'SECTIONAL_HEAD']);
//             })
//             ->orderByDesc('date')
//             ->get();

//         return view('principal.principalDashboard', compact('attendanceRecords'));
//     }



//     public function dashboardview()
//     {
//         $schoolId = Auth::user()->school_id;
//         $today = now()->toDateString();

//         $query = Attendance::whereDate('date', $today)
//             ->whereHas('user', function ($q) use ($schoolId) {
//                 $q->where('role', ['TEACHER', 'PRINCIPAL', 'SECTIONAL_HEAD'])
//                     ->where('school_id', $schoolId);
//             });

//         $presentCount = (clone $query)->where('status', 'PRESENT')->count();
//         $lateCount = (clone $query)->whereTime('check_in_time', '>', '07:45:00')->count();
//         $absentCount = (clone $query)->where('status', 'ABSENT')->count();

//         return view('principal.principalDashboard', compact('presentCount', 'lateCount', 'absentCount'));
//     }

//     public function showAttendanceTable()
//     {
//         $schoolId = Auth::user()->school_id;

//         $attendanceRecords = \App\Models\Attendance::with('user')
//             ->whereHas('user', function ($query) use ($schoolId) {
//                 $query->where('school_id', $schoolId)
//                     ->whereIn('role', ['TEACHER', 'PRINCIPAL', 'SECTIONAL_HEAD']);
//             })
//             ->orderByDesc('date')
//             ->get();

//         return view('principal.attendanceReport', compact('attendanceRecords'));
//     }

//     public function liveAbsentees()
//     {
//         $schoolId = Auth::user()->school_id;
//         $today = now()->toDateString();

//         $absentees = \App\Models\User::whereIn('role', ['TEACHER', 'PRINCIPAL', 'SECTIONAL_HEAD'])
//             ->where('school_id', $schoolId)
//             ->whereDoesntHave('attendances', function ($query) use ($today) {
//                 $query->where('date', $today)
//                     ->where('status', 'PRESENT');
//             })
//             ->get();

//         return view('principal.absenteesprin', compact('absentees')); // Or clerk.absentees
//     }

//     public function liveAttendanceView()
//     {
//         $principal = Auth::user();
//         $schoolId = $principal->school_id;
//         $today = now()->toDateString();

//         $attendances = Attendance::with('user')
//             ->whereDate('date', $today)
//             ->where('status', 'PRESENT')
//             ->whereHas('user', function ($query) use ($schoolId) {
//                 $query->where('school_id', $schoolId)
//                     ->whereIn('role', ['TEACHER', 'PRINCIPAL', 'SECTIONAL_HEAD']);
//             })
//             ->get();

//         return view('principal.liveAttendanceprin', compact('attendances'));
//     }


// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\User;
// use App\Models\LeaveApplication;
// use App\Models\LeaveStatus;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Database\QueryException;
// use Illuminate\Support\Facades\Auth;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;
// use App\Models\Attendance;

// class PrincipalController extends Controller
// {
//     public function __construct()
//     {
//         $this->middleware('auth'); // Ensure the principal is logged in
//     }

//     public function index()
//     {
//         return view('school.registerPrincipal');
//     }

//     public function store(Request $request)
//     {
//         $schoolId = session('school_id');

//         $request->validate([
//             'first_name' => 'required|string|max:255',
//             'last_name' => 'required|string|max:255',
//             'school_index' => 'required|numeric',
//             'user_address_no' => 'required|string',
//             'user_address_street' => 'required|string',
//             'user_address_city' => 'required|string',
//             'user_nic' => 'required|string|unique:users,user_nic',
//             'user_dob' => 'required|date',
//             'user_email' => 'required|email|unique:users,user_email',
//             'user_phone' => 'required|numeric|digits:10|unique:users,user_phone',
//             'profile_picture' => 'required|image|mimes:jpg,png,jpeg|max:2048',
//             'status' => 'required',
//         ]);

//         if ($request->hasFile('profile_picture')) {
//             $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
//         } else {
//             $imagePath = null;
//         }

//         try {
//             User::create([
//                 'school_id' => 100,
//                 'role' => 'PRINCIPAL',
//                 'user_password' => Hash::make('Principal@123'),
//                 'first_name' => $request->first_name,
//                 'last_name' => $request->last_name,
//                 'school_index' => $request->school_index,
//                 'user_address_no' => $request->user_address_no,
//                 'user_address_street' => $request->user_address_street,
//                 'user_address_city' => $request->user_address_city,
//                 'user_nic' => $request->user_nic,
//                 'user_dob' => $request->user_dob,
//                 'user_email' => $request->user_email,
//                 'user_phone' => $request->user_phone,
//                 'profile_picture' => $imagePath,
//                 'status' => $request->status,
//                 'registered_date' => now(),
//             ]);

//             return redirect('/schoolDashboard')->with('success', 'Principal registered successfully!');
//         } catch (QueryException $e) {
//             if ($e->errorInfo[1] == 1062) {
//                 return redirect('/registerPrincipal')->with('error', 'Principal already exists!');
//             }
//         } catch (\Exception $e) {
//             return redirect('/registerPrincipal')->with('error', 'An error occurred!');
//         }
//     }

//     public function showQRCode($id)
//     {
//         $teacher = User::findOrFail($id);
//         $qrContent = $teacher->id;

//         return view('zonal.qrcode', [
//             'teacher' => $teacher,
//             'qrCode' => QrCode::size(180)->generate($qrContent),
//         ]);
//     }

//     public function logAttendance($id)
//     {
//         $user = User::findOrFail($id);
//         $today = now()->toDateString();

//         $attendance = Attendance::firstOrNew([
//             'user_id' => $user->id,
//             'date' => $today
//         ]);

//         if (!$attendance->exists || is_null($attendance->check_in_time)) {
//             $attendance->status = 'PRESENT';
//             $attendance->check_in_time = now()->format('H:i:s');
//             $attendance->method = 'QR';
//             $attendance->save();

//             return response()->json(['message' => 'Check-in successful']);
//         }

//         if (is_null($attendance->check_out_time)) {
//             $attendance->check_out_time = now()->format('H:i:s');
//             $attendance->save();

//             return response()->json(['message' => 'Check-out successful']);
//         }

//         return response()->json(['message' => 'Already checked in and out today']);
//     }

//     public function dashboard()
//     {
//         $schoolId = Auth::user()->school_id;

//         $attendanceRecords = Attendance::with('user')
//             ->whereHas('user', function ($query) use ($schoolId) {
//                 $query->where('school_id', $schoolId)
//                     ->whereIn('role', ['TEACHER', 'PRINCIPAL', 'SECTIONAL_HEAD']);
//             })
//             ->orderByDesc('date')
//             ->get();

//         // Fetch pending leave applications for the school
//         $applications = LeaveApplication::whereHas('latestStatus', function ($query) {
//             $query->where('status', 'PENDING');
//         })
//         ->whereHas('user', function ($query) use ($schoolId) {
//             $query->where('school_id', $schoolId);
//         })
//         ->with('user', 'latestStatus')
//         ->get();

//         return view('principal.principalDashboard', compact('attendanceRecords', 'applications'));
//     }

//     public function dashboardview()
//     {
//         $schoolId = Auth::user()->school_id;
//         $today = now()->toDateString();

//         $query = Attendance::whereDate('date', $today)
//             ->whereHas('user', function ($q) use ($schoolId) {
//                 $q->whereIn('role', ['TEACHER', 'PRINCIPAL', 'SECTIONAL_HEAD'])
//                     ->where('school_id', $schoolId);
//             });

//         $presentCount = (clone $query)->where('status', 'PRESENT')->count();
//         $lateCount = (clone $query)->whereTime('check_in_time', '>', '07:45:00')->count();
//         $absentCount = (clone $query)->where('status', 'ABSENT')->count();

//         return view('principal.principalDashboard', compact('presentCount', 'lateCount', 'absentCount'));
//     }

//     public function showAttendanceTable()
//     {
//         $schoolId = Auth::user()->school_id;

//         $attendanceRecords = Attendance::with('user')
//             ->whereHas('user', function ($query) use ($schoolId) {
//                 $query->where('school_id', $schoolId)
//                     ->whereIn('role', ['TEACHER', 'PRINCIPAL', 'SECTIONAL_HEAD']);
//             })
//             ->orderByDesc('date')
//             ->get();

//         return view('principal.attendanceReport', compact('attendanceRecords'));
//     }

//     public function liveAbsentees()
//     {
//         $schoolId = Auth::user()->school_id;
//         $today = now()->toDateString();

//         $absentees = User::whereIn('role', ['TEACHER', 'PRINCIPAL', 'SECTIONAL_HEAD'])
//             ->where('school_id', $schoolId)
//             ->whereDoesntHave('attendances', function ($query) use ($today) {
//                 $query->where('date', $today)
//                     ->where('status', 'PRESENT');
//             })
//             ->get();

//         return view('principal.absenteesprin', compact('absentees'));
//     }

//     public function liveAttendanceView()
//     {
//         $principal = Auth::user();
//         $schoolId = $principal->school_id;
//         $today = now()->toDateString();

//         $attendances = Attendance::with('user')
//             ->whereDate('date', $today)
//             ->where('status', 'PRESENT')
//             ->whereHas('user', function ($query) use ($schoolId) {
//                 $query->where('school_id', $schoolId)
//                     ->whereIn('role', ['TEACHER', 'PRINCIPAL', 'SECTIONAL_HEAD']);
//             })
//             ->get();

//         return view('principal.liveAttendanceprin', compact('attendances'));
//     }

//     public function updateLeaveStatus(Request $request, $id)
//     {
//         $request->validate([
//             'status' => 'required|in:APPROVED,REJECTED',
//             'comment' => 'nullable|string|required_if:status,REJECTED',
//         ]);

//         $leaveApplication = LeaveApplication::findOrFail($id);
//         $latestStatus = $leaveApplication->latestStatus;

//         if (!$latestStatus) {
//             return redirect()->route('principal.dashboard')->with('error', 'Leave status not found.');
//         }

//         // Update the status
//         $latestStatus->update([
//             'status' => $request->status,
//             'user_id' => Auth::id(), // The principal who updated the status
//             'comment' => $request->comment,
//         ]);

//         return redirect()->route('principal.dashboard')->with('success', 'Leave application status updated successfully.');
//     }
// }



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LeaveApplication;
use App\Models\LeaveStatus;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Attendance;

class PrincipalController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware(function ($request, $next) {
    //         if (Auth::user()->role !== 'PRINCIPAL') {
    //             abort(403, 'Unauthorized');
    //         }
    //         return $next($request);
    //     });
    // }

    public function index()
    {
        return view('school.registerPrincipal');
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
                'role' => 'PRINCIPAL',
                'user_password' => Hash::make('Principal@123'),
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

            return redirect('/schoolDashboard')->with('success', 'Principal registered successfully!');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return redirect('/registerPrincipal')->with('error', 'Principal already exists!');
            }
        } catch (\Exception $e) {
            return redirect('/registerPrincipal')->with('error', 'An error occurred!');
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

        $applications = LeaveApplication::whereHas('latestStatus', function ($query) {
            $query->where('status', 'PENDING');
        })
            ->whereHas('user', function ($query) use ($schoolId) {
                $query->where('school_id', $schoolId);
            })
            ->with('user', 'latestStatus')
            ->get();

        return view('principal.principalDashboard', compact('attendanceRecords', 'applications'));
    }

    public function dashboardview()
    {
        $schoolId = Auth::user()->school_id;
        $today = now()->toDateString();

        $query = Attendance::whereDate('date', $today)
            ->whereHas('user', function ($q) use ($schoolId) {
                $q->whereIn('role', ['TEACHER', 'PRINCIPAL', 'SECTIONAL_HEAD'])
                    ->where('school_id', $schoolId);
            });

        $presentCount = (clone $query)->where('status', 'PRESENT')->count();
        $lateCount = (clone $query)->whereTime('check_in_time', '>', '07:45:00')->count();
        $absentCount = (clone $query)->where('status', 'ABSENT')->count();

        // Add attendance records
        $attendanceRecords = Attendance::with('user')
            ->whereHas('user', function ($query) use ($schoolId) {
                $query->where('school_id', $schoolId)
                    ->whereIn('role', ['TEACHER', 'PRINCIPAL', 'SECTIONAL_HEAD']);
            })
            ->orderByDesc('date')
            ->get();

        // Add pending leave applications
        $applications = LeaveApplication::whereHas('latestStatus', function ($query) {
            $query->where('status', 'PENDING');
        })
            ->whereHas('user', function ($query) use ($schoolId) {
                $query->where('school_id', $schoolId);
            })
            ->with('user', 'latestStatus')
            ->get();

        return view('principal.principalDashboard', compact('presentCount', 'lateCount', 'absentCount', 'attendanceRecords', 'applications'));
    }


    public function showAttendanceTable()
    {
        $schoolId = Auth::user()->school_id;

        $attendanceRecords = Attendance::with('user')
            ->whereHas('user', function ($query) use ($schoolId) {
                $query->where('school_id', $schoolId)
                    ->whereIn('role', ['TEACHER', 'PRINCIPAL', 'SECTIONAL_HEAD']);
            })
            ->orderByDesc('date')
            ->get();

        return view('principal.attendanceReport', compact('attendanceRecords'));
    }

    public function liveAbsentees()
    {
        $schoolId = Auth::user()->school_id;
        $today = now()->toDateString();

        $absentees = User::whereIn('role', ['TEACHER', 'PRINCIPAL', 'SECTIONAL_HEAD'])
            ->where('school_id', $schoolId)
            ->whereDoesntHave('attendances', function ($query) use ($today) {
                $query->where('date', $today)
                    ->where('status', 'PRESENT');
            })
            ->get();

        return view('principal.absenteesprin', compact('absentees'));
    }

    public function liveAttendanceView()
    {
        $principal = Auth::user();
        $schoolId = $principal->school_id;
        $today = now()->toDateString();

        $attendances = Attendance::with('user')
            ->whereDate('date', $today)
            ->where('status', 'PRESENT')
            ->whereHas('user', function ($query) use ($schoolId) {
                $query->where('school_id', $schoolId)
                    ->whereIn('role', ['TEACHER', 'PRINCIPAL', 'SECTIONAL_HEAD']);
            })
            ->get();

        return view('principal.liveAttendanceprin', compact('attendances'));
    }

    //     public function updateLeaveStatus(Request $request, $id)
    //     {
    //         $request->validate([
    //             'status' => 'required|in:APPROVED,REJECTED',
    //             'comment' => 'nullable|string|required_if:status,REJECTED',
    //         ]);

    //         $leaveApplication = LeaveApplication::findOrFail($id);
    //         $latestStatus = $leaveApplication->latestStatus;

    //         if (!$latestStatus) {
    //             return redirect()->route('principal.dashboard')->with('error', 'Leave status not found.');
    //         }

    //         $latestStatus->update([
    //             'status' => $request->status,
    //             'user_id' => Auth::id(),
    //             'comment' => $request->comment,
    //         ]);

    //         return redirect()->route('principal.dashboard')->with('success', 'Leave application status updated successfully.');
    //     }
    // }
    public function updateLeaveStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:APPROVED,REJECTED',
            'comment' => 'nullable|string|required_if:status,REJECTED',
        ]);

        $leaveApplication = LeaveApplication::findOrFail($id);
        $latestStatus = $leaveApplication->latestStatus;

        if (!$latestStatus) {
            return redirect()->route('principal.dashboard')->with('error', 'Leave status not found.');
        }

        // Update the status and comment without modifying the user_id
        $latestStatus->update([
            'status' => $request->status,
            'comment' => $request->comment,
        ]);

        return redirect()->route('principal.dashboard')->with('success', 'Leave application status updated successfully.');
    }
}
