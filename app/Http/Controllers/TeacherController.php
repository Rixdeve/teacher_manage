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
use App\Models\Notification;

// use function Laravel\Prompts\alert;

class TeacherController extends Controller
{

    public function index()
    {
        return view('school.registerTeacher');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $schoolId = session('school_id');
        $selectedSubjects = $request->input('subjects');

        // Check if the teacher already exists (NIC or email)
        $existingTeacher = User::where('user_nic', $request->user_nic)
            ->orWhere('user_email', $request->user_email)
            ->first();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'school_index' => 'required|numeric',
            'user_address_no' => 'required|string',
            'user_address_street' => 'required|string',
            'user_address_city' => 'required|string',
            'user_nic' => 'required|string',
            'user_dob' => 'required|date',
            'user_email' => 'required|email',
            'user_phone' => 'required|numeric|digits:10',
            'profile_picture' => $existingTeacher ? 'nullable|image|mimes:jpg,png,jpeg|max:2048' : 'required|image|mimes:jpg,png,jpeg|max:2048',
            'status' => 'required|in:ACTIVE,INACTIVE,TRANSFERRED,RETIRED,ONLEAVE',
        ]);

        if ($existingTeacher) {
            // Block registration if not marked as TRANSFERRED
            if ($existingTeacher->status !== 'TRANSFERRED') {
                return redirect('/registerTeacher')->with('error', 'This teacher already exists and is not marked as transferred from the previous school.');
            }

            // Proceed to update the transferred teacher's record
            if ($request->hasFile('profile_picture')) {
                // Delete old photo if exists
                if ($existingTeacher->profile_picture && Storage::disk('public')->exists($existingTeacher->profile_picture)) {
                    Storage::disk('public')->delete($existingTeacher->profile_picture);
                }

                $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            } else {
                $imagePath = $existingTeacher->profile_picture; // retain old if not uploaded
            }

            // Update fields
            $existingTeacher->school_id = $schoolId;
            $existingTeacher->role = 'TEACHER';
            $existingTeacher->user_password = Hash::make('Teacher@123');
            $existingTeacher->first_name = $request->first_name;
            $existingTeacher->last_name = $request->last_name;
            $existingTeacher->section = trim($request->section);
            $existingTeacher->subjects = json_encode($selectedSubjects);
            $existingTeacher->school_index = $request->school_index;
            $existingTeacher->user_address_no = $request->user_address_no;
            $existingTeacher->user_address_street = $request->user_address_street;
            $existingTeacher->user_address_city = $request->user_address_city;
            $existingTeacher->user_dob = $request->user_dob;
            $existingTeacher->user_email = $request->user_email;
            $existingTeacher->user_phone = $request->user_phone;
            $existingTeacher->profile_picture = $imagePath;
            $existingTeacher->status = 'ACTIVE';
            $existingTeacher->registered_date = now();

            $existingTeacher->save(); // <-- REQUIRED to persist the update

            return redirect('/schoolDashboard')->with('success', 'Transferred teacher registered successfully to your school!');
        }

        // ✅ If teacher doesn't exist, proceed with fresh registration
        $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');

        try {
            User::create([
                'school_id' => $schoolId,
                'role' => 'TEACHER',
                'user_password' => Hash::make('Teacher@123'),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'section' => trim($request->section),
                'subjects' => json_encode($selectedSubjects),
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

             $existingTeacher->save();            

            return redirect('/schoolDashboard')->with('success', 'Teacher registered successfully!');
        } catch (QueryException $e) {
            return redirect('/registerTeacher')->with('error', 'Teacher already exists!');
        } catch (\Exception $e) {
            return redirect('/registerTeacher')->with('error', 'An error occurred while registering.');
        }
    }

    public function checkTransferNIC(Request $request)
    {
        $nic = trim($request->input('nic'));

        $principal = User::where('user_nic', $nic)
            ->whereRaw('UPPER(role) = ?', ['PRINCIPAL'])
            ->first();

        if (!$principal) {
            return response()->json(['status' => 'not_found'], 404);
        }

        if (strtoupper($principal->status) !== 'TRANSFERRED') {
            return response()->json(['status' => 'not_transferred'], 403);
        }

        return response()->json([
            'status' => 'TRANSFERRED',
            'principal' => [
                'id' => $principal->id,
                'first_name' => $principal->first_name,
                'last_name' => $principal->last_name,
                'user_email' => $principal->user_email,
                'user_phone' => $principal->user_phone,
                'user_nic' => $principal->user_nic,
                'user_dob' => \Carbon\Carbon::parse($principal->user_dob)->format('Y-m-d'),
                'school_index' => '', // Always empty for transferred
                'user_address_no' => $principal->user_address_no,
                'user_address_street' => $principal->user_address_street,
                'user_address_city' => $principal->user_address_city,
                'profile_picture' => $principal->profile_picture
            ]
        ], 200);
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


    public function manage()
    {
        $schoolId = session('school_id');
        $teachers = User::where('school_id', $schoolId)->where('role', 'TEACHER')->get();
        return view('school.manageTeachers', compact('teachers'));
    }


    // Show edit form for a teacher
    public function edit($id)
    {
        $teacher = User::where('role', 'TEACHER')->findOrFail($id);
        return view('school.editTeacher', compact('teacher'));
    }

    // Handle update form submission
    public function update(Request $request, $id)
    {
        $teacher = User::where('role', 'TEACHER')->findOrFail($id);
    
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'school_index' => 'nullable|string',
            'user_email' => 'required|email|unique:users,user_email,' . $id,
            'user_phone' => 'required|digits:10|unique:users,user_phone,' . $id,
            'user_nic' => 'required|string',
            'user_address_no' => 'required|string',
            'user_address_street' => 'required|string',
            'user_address_city' => 'required|string',
            'user_dob' => 'required|date',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'section' => $request->section,
            'school_index' => $request->school_index,
            'user_email' => $request->user_email,
            'user_phone' => $request->user_phone,
            'user_nic' => $request->user_nic,
            'user_address_no' => $request->user_address_no,
            'user_address_street' => $request->user_address_street,
            'user_address_city' => $request->user_address_city,
            'user_dob' => $request->user_dob,
            'subjects' => $request->has('subjects') ? json_encode($request->subjects) : null,
        ];
    
        if ($request->hasFile('profile_picture')) {
            // Delete old one if exists
            if ($teacher->profile_picture && Storage::disk('public')->exists($teacher->profile_picture)) {
                Storage::disk('public')->delete($teacher->profile_picture);
            }
    
            $data['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }
    
        $teacher->update($data);
    
        return redirect()->route('teachers.manage')->with('success', 'Teacher profile updated successfully!');
    }

    // Soft delete / deactivate teacher (for transfer/retirement)
    public function updateStatus($id, $status)
    {
        $validStatuses = ['INACTIVE', 'TRANSFERRED', 'RETIRED'];
        if (!in_array(strtoupper($status), $validStatuses)) {
            return redirect()->back()->with('error', 'Invalid status');
        }
    
        $teacher = User::findOrFail($id);
        $teacher->status = strtoupper($status);
        $teacher->save();
    
        return redirect()->back()->with('success', 'Teacher status updated successfully!');
    }

    public function reactivate($id)
    {
        $teacher = User::findOrFail($id);
        $teacher->status = 'ACTIVE';
        $teacher->save();

        return redirect()->back()->with('success', 'Teacher reactivated successfully.');
    }

}