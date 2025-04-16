<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leave_counters', function (Blueprint $table) {
            $table->integer('year')->default(date('Y'))->after('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('leave_counters', function (Blueprint $table) {
            $table->dropColumn('year');
        });
    }
};

