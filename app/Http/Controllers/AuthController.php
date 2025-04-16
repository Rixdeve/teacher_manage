<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\School;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\ZoneOffice;

class AuthController extends Controller
{
    public function index()
    {
        return view('login'); // your custom login.blade.php
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'user_email' => ['required', 'email'],
            'user_password' => ['required'],
        ]);

        $email = $credentials['user_email'];
        $password = $credentials['user_password'];

        // Try logging in a School first
        $school = School::where('school_email', $email)->first();
        if ($school && Hash::check($password, $school->password)) {
            // Manually log in school by setting session
            session(['school_id' => $school->id]);
            return redirect('/schoolDashboard');
        }

        $zonal = ZoneOffice::where('zone_email', $email)->first();
        if ($zonal && Hash::check($password, $zonal->password)) {
            // Manually log in zonal by setting session
            session(['zone_office_id' => $zonal->id]);
            return redirect('/zonalDashboard');
        }

        // Try logging in a User next
        $user = User::where('user_email', $email)->first();
        if ($user && Hash::check($password, $user->user_password)) {
            Auth::login($user);
            $request->session()->regenerate();

            switch ($user->role) {
                case 'PRINCIPAL':
                    return redirect()->intended('/principalDashboard');
                case 'TEACHER':
                    return redirect()->intended('/teacherDashboard');
                case 'CLERK':
                    return redirect()->intended('/clerkDashboard');
                case 'ZONAL':
                case 'ZONAL_ADMIN':
                    return redirect()->intended('/zonalDashboard');
                case 'SECTIONAL_HEAD':
                    return redirect()->intended('/sectionheadDashboard');
            }
        }

        return back()->withErrors([
            'user_email' => 'Invalid credentials.',
        ])->onlyInput('user_email');
    }


    // public function logout(Request $request)
    // {
    //     // Step 1: Log out any authenticated user (if it's a User model)
    //     Auth::logout();

    //     // Step 2: Clear any custom session like `school_id`
    //     $request->session()->forget('school_id');

    //     // Step 3: Fully invalidate the session
    //     $request->session()->invalidate();

    //     // Step 4: Regenerate CSRF token
    //     $request->session()->regenerateToken();

    //     // Step 5: Redirect to login or homepage
    //     return redirect('/');
    // }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->forget('school_id');

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
