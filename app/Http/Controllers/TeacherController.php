<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;

// use function Laravel\Prompts\alert;

class TeacherController extends Controller
{

    public function index()
    {
        return view('registerTeacher');
    }
    public function store(Request $request)
    {
        // // ✅ Debugging: Check received input
        // dd($request->all());

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
            // ✅ Store the new school in the database
            User::create([
                'school_id' => 100, // Default value
                'role' => 'TEACHER',
                'user_password' => Hash::make('Teacher@123'),
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
            ]);
            return redirect('/schoolDashboard')->with('success', 'Teacher registered successfully!');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return redirect('/registerTeacher')->with('error', 'Teacher already exists!');
            }
        } catch (\Exception $e) {
            return redirect('/registerTeacher')->with('error', 'An error occurred!');
        }
    }
}
