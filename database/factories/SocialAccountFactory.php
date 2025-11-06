<?php

namespace Database\Factories;

use App\Models\SocialMedia;
use Illuminate\Database\Eloquent\Factories\Factory;

class SocialAccountFactory extends Factory
{
    public function definition(): array
    {
        return [
            'social_media_id' => SocialMedia::inRandomOrder()->first()?->id ?? SocialMedia::factory(),
            'account_name' => fake()->company(),
            'account_url' => fake()->url(),
            'credentials' => [
                'api_key' => fake()->uuid(),
                'access_token' => fake()->sha1(),
                'page_id' => fake()->uuid(),
            ],
        ];
    }
}
