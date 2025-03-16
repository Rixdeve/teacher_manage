<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\School;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'school_id' => School::factory(), // Associate user with a school
            'school_index' => strtoupper($this->faker->bothify('SCH-###')),
            'qr_code' => null, // QR codes can be generated later
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'user_email' => $this->faker->unique()->safeEmail(),
            'role' => $this->faker->randomElement(['CLERK', 'PRINCIPAL', 'ZONAL', 'TEACHER', 'SECTIONAL_HEAD', 'ZONAL_ADMIN', 'IT_CLERK']),
            'email_verified_at' => now(),
            'user_password' => static::$password ??= Hash::make('password'), // Securely hashed password
            'profile_picture' => null,
            'user_phone' => $this->faker->unique()->numerify('077#######'), // Valid phone number format
            'registered_date' => now(),
            'status' => $this->faker->randomElement(['ACTIVE', 'INACTIVE', 'ONLEAVE']),
            'user_nic' => $this->faker->unique()->bothify('#########V'), // Random 9-digit NIC ending in 'V'
            'user_address_no' => $this->faker->buildingNumber(),
            'user_address_street' => $this->faker->streetName(),
            'user_address_city' => $this->faker->city(),
            'user_dob' => $this->faker->date(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
