<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        if (Auth::attempt([
            'user_email' => $credentials['user_email'],
            'password' => $credentials['user_password'],
        ])) {
            $request->session()->regenerate();
            $request->session()->regenerate();

            // ✅ Redirect based on user role
            $user = Auth::user();

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
                    return redirect()->intended('/sectionalDashboard');
                case 'SCHOOL':
                    return redirect()->intended('/schoolDashboard');
            }
        }

        return back()->withErrors([
            'user_email' => 'Invalid credentials.',
        ])->onlyInput('user_email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
