<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id()->from(100);
            $table->string('school_number')->unique();
            $table->foreignId('zonal_id')->constrained('zone_offices')->onDelete('cascade');
            $table->string('school_name');
            $table->string('school_address_no');
            $table->string('school_address_street');
            $table->string('school_address_city');
            $table->string('school_email')->unique();
            $table->string('password');
            $table->string('school_phone')->unique();
            $table->enum('status', ['ACTIVE', 'INACTIVE'])->default('ACTIVE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
