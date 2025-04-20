<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Support\Carbon;

class DailyAttendanceProcessor extends Command
{
    protected $signature = 'attendance:process';

    protected $description = 'Handles default PENDING and converts to ABSENT by 1:31 PM';

    public function handle()
    {
        $today = Carbon::today()->toDateString();
        $now = Carbon::now();

        if ($now->lessThan(Carbon::createFromTime(7, 30))) {
            $this->info("Setting PENDING for all users...");

            $users = User::whereIn('role', ['TEACHER', 'PRINCIPAL', 'SECTIONAL_HEAD'])->get();

            foreach ($users as $user) {
                Attendance::firstOrCreate(
                    ['user_id' => $user->id, 'date' => $today],
                    [
                        'status' => 'PENDING',
                        'method' => null,
                        'check_in_time' => null,
                        'check_out_time' => null,
                    ]
                );
            }
        }

        if ($now->greaterThanOrEqualTo(Carbon::createFromTime(13, 31))) {
            $this->info("Marking all PENDING users as ABSENT...");

            Attendance::where('date', $today)
                ->where('status', 'PENDING')
                ->update([
                    'status' => 'ABSENT',
                    'method' => 'MANUAL',
                    'check_in_time' => null,
                    'check_out_time' => null,
                ]);
        }
    }
}
