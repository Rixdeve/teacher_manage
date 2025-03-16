<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\LeaveApplication;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeaveApplication>
 */
class LeaveApplicationFactory extends Factory
{
    protected $model = LeaveApplication::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-1 month', 'now'); // Ensure start date is not in the future
        $endDate = $this->faker->dateTimeBetween($startDate, strtotime('+5 days', $startDate->getTimestamp())); // Ensure valid range


        $leaveType = $this->faker->randomElement(['CASUAL', 'MEDICAL', 'HALF_DAY', 'SHORT', 'NO_PAY']);

        return [
            'user_id' => User::factory(), // Associate leave request with a user
            'commence_date' => $startDate->format('Y-m-d'),
            'end_date' => $leaveType === 'HALF_DAY' || $leaveType === 'SHORT' ? $startDate->format('Y-m-d') : $endDate->format('Y-m-d'),
            'leave_type' => $leaveType,
            'reason' => $this->faker->sentence(),
            'attachment_url_1' => $this->faker->optional()->imageUrl(),
            'attachment_url_2' => $this->faker->optional()->imageUrl(),
            'attachment_url_3' => $this->faker->optional()->imageUrl(),
        ];
    }
}
