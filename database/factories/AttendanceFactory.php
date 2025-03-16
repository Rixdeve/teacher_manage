<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Attendance;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    protected $model = Attendance::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['PENDING', 'PRESENT', 'ABSENT']);
        $checkIn = $status === 'PRESENT' ? '08:30:00' : null;
        $checkOut = $status === 'PRESENT' ? '15:30:00' : null;
        $method = $status === 'PRESENT'
            ? $this->faker->randomElement(['QR', 'MANUAL']) : NULL; // Random method for present users) 
        // Default for non-present users

        return [
            'user_id' => User::factory(), // Associate attendance with a user
            'status' => $status,
            'date' => $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'), // Random past date
            'check_in_time' => $checkIn,
            'check_out_time' => $checkOut,
            'method' => $method, // ✅ Now always 'QR' or 'MANUAL'
        ];
    }
}
