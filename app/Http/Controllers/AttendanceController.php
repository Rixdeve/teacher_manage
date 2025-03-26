<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use App\Models\Attendance;
use Illuminate\Database\QueryException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class AttendanceController
{
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

    public function store(Request $request)
    {
        $date = $request->input('attendance_date');
        $entries = $request->input('teachers');

        foreach ($entries as $teacherId => $data) {
            \App\Models\Attendance::updateOrCreate(
                [
                    'user_id' => $teacherId,
                    'date' => $date,
                ],
                [
                    'check_in_time' => $data['check_in_time'] ?? null,
                    'check_out_time' => $data['check_out_time'] ?? null,
                    'status' => $data['status'],
                    'method' => 'MANUAL',
                ]
            );
        }

        return redirect()->back()->with('success', 'Attendance successfully submitted.');
    }
    public function showManualEntry()
    {
        $clerk = \Illuminate\Support\Facades\Auth::user(); // logged-in clerk
        $teachersAndPrincipals = \App\Models\User::whereIn('role', ['TEACHER', 'PRINCIPAL', 'SECTIONAL_HEAD'])
            ->where('school_id', $clerk->school_id)
            ->get();

        return view('clerk.manualAttendance', ['teachersAndPrincipals' => $teachersAndPrincipals]);
    }

    public function fetchUserAttendance(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
        ]);

        $attendance = Attendance::where('user_id', $request->user_id)
            ->where('date', $request->date)
            ->first();

        return view('attendance.user_attendance', compact('attendance'));
    }

    public function updateUserAttendance(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'status' => 'required|in:PRESENT,ABSENT',
            'check_in_time' => 'nullable',
            'check_out_time' => 'nullable',
        ]);

        Attendance::updateOrCreate(
            ['user_id' => $request->user_id, 'date' => $request->date],
            [
                'status' => $request->status,
                'check_in_time' => $request->check_in_time,
                'check_out_time' => $request->check_out_time,
                'method' => 'MANUAL',
            ]
        );

        return redirect()->back()->with('success', 'Attendance updated successfully.');
    }

    public function myAttendance()
    {
        $userId = Auth::id();

        $attendances = \App\Models\Attendance::where('user_id', $userId)
            ->orderByDesc('date')
            ->get();

        return view('attendance.my_attendance', compact('attendances'));
    }
}
