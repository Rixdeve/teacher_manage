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
        Schema::create('leave_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('commence_date');
            $table->date('end_date');
            $table->enum('leave_type', ['CASUAL', 'MEDICAL', 'HALF_DAY', 'SHORT', 'NO_PAY']);
            $table->text('reason')->nullable();
            $table->string('attachment_url_1')->nullable();
            $table->string('attachment_url_2')->nullable();
            $table->string('attachment_url_3')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_applications');
    }
};
