<?php

namespace Database\Factories;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'start_date' => fake()->date(),
            'price' => fake()->randomFloat(4, 20, 100),
            'currency' => 'USD',
            'frequency' => 'monthly',
            'link' => fake()->url(),
        ];
    }
}
