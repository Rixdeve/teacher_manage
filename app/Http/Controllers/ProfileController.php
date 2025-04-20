<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Attendance;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }
    public function changePassword()
    {
        return view('profile.change-password');
    }

    // public function updatePassword(Request $request)
    // {

    //     $request->validate([
    //         'current_password' => 'required',
    //         'new_password' => 'required|min:8|confirmed',
    //     ]);

    //     if (!Hash::check($request->current_password, Auth::user()->user_password)) {
    //         return back()->withErrors(['current_password' => 'Current password is incorrect']);
    //     }

    //     Auth::user()->update([
    //         'user_password' => $request->new_password,
    //     ]);

    //     return redirect()->route('profile.show')->with('success', 'Password updated successfully.');
    // }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    // public function update(Request $request)
    // {
    //     $user = Auth::user();

    //     $request->validate([
    //         'first_name' => 'required|string',
    //         'last_name' => 'required|string',
    //         'user_dob' => 'required|date',
    //         'user_address_no' => 'required|string',
    //         'user_address_street' => 'required|string',
    //         'user_address_city' => 'required|string',
    //         'user_nic' => 'required|string',
    //     ]);

    //     // $user->update($request->only([
    //     //     'first_name',
    //     //     'last_name',
    //     //     'user_dob',
    //     //     'user_address_no',
    //     //     'user_address_street',
    //     //     'user_address_city',
    //     //     'user_nic',
    //     // ]));

    //     return redirect()->route('profile.show')->with('success', 'Profile updated!');
    // }
}
