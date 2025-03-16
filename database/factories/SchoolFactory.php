<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\School;
use App\Models\ZoneOffice;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\School>
 */
class SchoolFactory extends Factory
{
    protected $model = School::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'school_number' => $this->faker->unique()->randomNumber(5), // Unique school number
            'zonal_id' => ZoneOffice::factory(), // Link to a randomly created Zone Office
            'school_name' => $this->faker->company() . " School",
            'school_address_no' => $this->faker->buildingNumber(),
            'school_address_street' => $this->faker->streetName(),
            'school_address_city' => $this->faker->city(),
            'school_email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'), // Securely hashed password
            'school_phone' => $this->faker->unique()->numerify('077#######'), // Valid phone number format
            'status' => $this->faker->randomElement(['ACTIVE', 'INACTIVE']),
        ];
    }
}
