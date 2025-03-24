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
        Schema::create('users', function (Blueprint $table) {
            $table->id()->from(10000);
            $table->foreignId('school_id')->constrained('schools')->onDelete('cascade');
            $table->string('school_index')->nullable();
            $table->string('qr_code')->nullable()->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('user_email')->unique();
            $table->enum('role', ['CLERK', 'PRINCIPAL', 'ZONAL', 'TEACHER', 'SECTIONAL_HEAD', 'ZONAL_ADMIN'])->default('TEACHER');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('user_password');
            $table->string('profile_picture')->nullable();
            $table->string('user_phone')->unique();
            $table->date('registered_date');
            $table->enum('status', ['ACTIVE', 'INACTIVE', 'ONLEAVE'])->default('ACTIVE');
            $table->string('user_nic')->unique();
            $table->string('user_address_no');
            $table->string('user_address_street');
            $table->string('user_address_city');
            $table->date('user_dob');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
