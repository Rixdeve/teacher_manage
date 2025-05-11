<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use App\Models\School;
use App\Models\ZoneOffice;


class PasswordResetController extends Controller
{
    public function showRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'type' => 'required|in:user,school,zonal'
        ]);

        $email = $request->email;
        $type = $request->type;
        $token = Str::random(64);
        $accountExists = match ($type) {
            'user' => User::where('user_email', $email)->exists(),
            'school' => School::where('school_email', $email)->exists(),
            'zonal' => ZoneOffice::where('zone_email', $email)->exists(),
            default => false
        };

        if (!$accountExists) {
            return back()->withErrors(['email' => 'We couldn’t find an account with that email.']);
        }
        DB::table('password_resets')->updateOrInsert(
            ['email' => $email, 'type' => $type],
            ['token' => $token, 'created_at' => Carbon::now()]
        );

        $resetLink = url("/password/reset/{$token}?type={$type}");

        Mail::to($email)->send(new \App\Mail\PasswordResetMail($resetLink));
        return back()->with('status', 'Password reset link has been sent to your email.');
    }

    public function showResetForm($token)
    {
        $type = request('type');
        return view('auth.passwords.reset', compact('token', 'type'));
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'type' => 'required|in:user,school,zonal',
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $record = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('type', $request->type)
            ->where('token', $request->token)
            ->first();

        if (!$record) {
            return back()->withErrors(['token' => 'Invalid or expired token.']);
        }

        switch ($request->type) {
            case 'user':
                $account = User::where('user_email', $request->email)->first();
                if (!$account) break;
                $account->user_password = Hash::make($request->password);
                break;

            case 'school':
                $account = School::where('school_email', $request->email)->first();
                if (!$account) break;
                $account->password = Hash::make($request->password);
                break;

            case 'zonal':
                $account = ZoneOffice::where('zone_email', $request->email)->first();
                if (!$account) break;
                $account->password = Hash::make($request->password);
                break;
        }
        if (!$account) {
            return back()->withErrors(['email' => 'Account not found.']);
        }




        if ($account) {
            $account->save();
            DB::table('password_resets')->where('email', $request->email)->delete();
            return redirect('/')->with('success', 'Password has been reset. You can now login.');
        }

        return back()->withErrors(['email' => 'Account not found.']);
    }
}
