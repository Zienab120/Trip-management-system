<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'destination' => fake()->country(),
            'cost' => fake()->numberBetween(200,500),
            'days' => fake()->numberBetween(2,8),
            'image' => fake()->image()
        ];
    }

}
