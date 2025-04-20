<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('relief_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('leave_application_id')->constrained()->onDelete('cascade');
            $table->foreignId('absent_teacher_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('relief_teacher_id')->constrained('users')->onDelete('cascade');
            $table->date('date');
            $table->string('time_slot'); 
            $table->string('class'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relief_assignments');
    }
};
