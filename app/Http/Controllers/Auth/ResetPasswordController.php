<?php

// namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Password;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Str;

// class ResetPasswordController extends Controller
// {
//     public function showResetForm(Request $request, $token)
//     {
//         return view('auth.reset-password', ['token' => $token, 'user_email' => $request->email]);
//     }

//     public function reset(Request $request)
//     {
//         $request->validate([
//             'token' => 'required',
//             'user_email' => 'required|email',
//             'user_password' => 'required|string|confirmed|min:8',
//         ]);

//         $status = Password::reset(
//             $request->only('user_email', 'user_password', 'password_confirmation', 'token'),
//             function ($user) use ($request) {
//                 $user->user_password = Hash::make($request->password);
//                 $user->setRememberToken(Str::random(60));
//                 $user->save();
//             }
//         );

//         return $status === Password::PASSWORD_RESET
//             ? redirect()->route('login')->with('status', __($status))
//             : back()->withErrors(['user_email' => [__($status)]]);
//     }
// }