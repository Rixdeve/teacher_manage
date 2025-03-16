<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\LeaveCounter;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeaveCounter>
 */
class LeaveCounterFactory extends Factory
{
    protected $model = LeaveCounter::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Associate with a user
            'total_casual' => $this->faker->numberBetween(10, 20), // Random casual leave balance
            'total_medical' => $this->faker->numberBetween(10, 20), // Random medical leave balance
            'total_short' => $this->faker->numberBetween(1, 2), // Random short leave balance
        ];
    }
}
