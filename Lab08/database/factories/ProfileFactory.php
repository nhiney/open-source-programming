<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // user_id sẽ gán từ seeder
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'birthday' => fake()->date(),
            'bio' => fake()->sentence(),
        ];
    }
}
