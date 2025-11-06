<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SocialMediaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Instagram', 'Facebook', 'TikTok', 'YouTube']),
            'icon' => fake()->randomElement(['📸', '📘', '🎵', '▶️']),
            'description' => fake()->sentence(),
        ];
    }
}
