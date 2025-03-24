<?php

// namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Password;

// class ForgotPasswordController extends Controller
// {
//     public function showLinkRequestForm()
//     {
//         return view('auth.forgot-password');
//     }

//     public function sendResetLinkEmail(Request $request)
//     {
//         $request->validate(['user_email' => 'required|email']);

//         $status = Password::sendResetLink(
//             ['user_email' => $request->email]
//         );

//         return $status === Password::RESET_LINK_SENT
//             ? back()->with('status', __($status))
//             : back()->withErrors(['user_email' => __($status)]);
//     }
// }