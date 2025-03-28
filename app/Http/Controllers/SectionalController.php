<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Attendance;

// use function Laravel\Prompts\alert;

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
        $today = now()->toDateString();

        $attendances = Attendance::with('user')
            ->whereDate('date', $today)
            ->where('status', 'PRESENT')
            ->whereHas('user', function ($query) use ($schoolId) {
                $query->where('school_id', $schoolId)
                    ->whereIn('role', ['TEACHER', 'PRINCIPAL', 'SECTIONAL_HEAD']);
            })
            ->get();

        return view('sectional_head.liveAttendance', compact('attendances'));
    }


    public function liveAbsentees()
    {
        $schoolId = Auth::user()->school_id;
        $today = now()->toDateString();

        $absentees = \App\Models\User::whereIn('role', ['TEACHER', 'PRINCIPAL', 'SECTIONAL_HEAD'])
            ->where('school_id', $schoolId)
            ->whereDoesntHave('attendances', function ($query) use ($today) {
                $query->where('date', $today)
                    ->where('status', 'PRESENT');
            })
            ->get();

        return view('sectional_head.absenteessect', compact('absentees'));
    }
}
