<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        \App\Models\ZoneOffice::factory()->count(3)->create(); // Generate 3 zone offices
        \App\Models\School::factory()->count(10)->create(); // Generate 10 schools
        \App\Models\User::factory()->count(70)->create(); // Generate 50 users
        \App\Models\LeaveCounter::factory()->count(50)->create(); // Generate 50 leave counters (1 per user)
        \App\Models\LeaveApplication::factory()->count(100)->create(); // Generate 100 leave requests
        \App\Models\LeaveStatus::factory()->count(100)->create(); // Generate 100 leave statuses (1 per leave request)
        \App\Models\Attendance::factory()->count(100)->create(); // Generate 100 leave statuses (1 per leave request)

    }
}
