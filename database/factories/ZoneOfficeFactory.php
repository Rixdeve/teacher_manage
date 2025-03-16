<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ZoneOffice;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ZoneOffice>
 */
class ZoneOfficeFactory extends Factory
{
    protected $model = ZoneOffice::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'zone_name' => 'Zone ' . $this->faker->city(),
            'zone_address_no' => $this->faker->buildingNumber(),
            'zone_address_street' => $this->faker->streetName(),
            'zone_address_city' => $this->faker->city(),
            'zone_email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'), // Securely hashed password
        ];
    }
}
