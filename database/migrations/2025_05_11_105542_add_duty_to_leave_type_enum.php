<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Step 1: Update invalid leave_type values to a default valid value
        DB::statement("UPDATE leave_applications SET leave_type = 'CASUAL' WHERE leave_type NOT IN ('CASUAL', 'MEDICAL', 'SHORT')");

        // Step 2: Modify the leave_type ENUM to include 'DUTY'
        DB::statement("ALTER TABLE leave_applications MODIFY COLUMN leave_type ENUM('CASUAL', 'MEDICAL', 'SHORT', 'DUTY') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to the original ENUM values (excluding 'DUTY')
        DB::statement("ALTER TABLE leave_applications MODIFY COLUMN leave_type ENUM('CASUAL', 'MEDICAL', 'SHORT') NOT NULL");
    }
};