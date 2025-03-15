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
        Schema::create('zone_offices', function (Blueprint $table) {
            $table->id();
            $table->string('zone_name');
            $table->string('zone_address_no');
            $table->string('zone_address_street');
            $table->string('zone_address_city');
            $table->string('zone_email')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zone_offices');
    }
};