<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\LeaveStatus;
use App\Models\User;
use App\Models\LeaveApplication;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeaveStatus>
 */
class LeaveStatusFactory extends Factory
{
    protected $model = LeaveStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['PENDING', 'APPROVED', 'REJECTED']);

        return [
            'leave_id' => LeaveApplication::factory(), // Associate with a leave request
            'user_id' => User::factory(), // Associate with an approver
            'status' => $status,
            'comment' => $status !== 'PENDING' ? $this->faker->sentence() : null, // Add comment for approved/rejected leaves
        ];
    }
}
