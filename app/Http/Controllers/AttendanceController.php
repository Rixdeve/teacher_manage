<?php

use Illuminate\Support\Carbon;
use App\Models\Attendance;
use Illuminate\Database\QueryException;
use App\Models\User;



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
}
