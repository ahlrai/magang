<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'username' => $this->faker->unique()->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'platform' => $this->faker->randomElement(['instagram', 'tiktok', 'facebook', 'youtube']),
            'status' => $this->faker->randomElement(['baru', 'follow-up', 'closing', 'lost']),
        ];
    }
}
