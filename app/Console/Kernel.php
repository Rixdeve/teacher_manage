<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Http\Controllers\AttendanceController;

class Kernel extends ConsoleKernel
{




    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            app(AttendanceController::class)->markEveryonePendingAt729();
        })->dailyAt('07:29');

        // 2. Mark approved leave users as ABSENT at 7:30 AM
        $schedule->call(function () {
            app(AttendanceController::class)->markApprovedLeaveAsAbsent();
        })->dailyAt('07:30');

        // 3. Mark remaining PENDING users as ABSENT at 1:31 PM
        $schedule->call(function () {
            app(AttendanceController::class)->markAbsentAfter131();
        })->dailyAt('13:31');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
