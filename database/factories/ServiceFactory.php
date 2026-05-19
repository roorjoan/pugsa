<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'        => fake()->words(3, true),
            'type'        => fake()->randomElement(['web', 'application']),
            'icon'        => fake()->optional()->word(),
            'path'        => '/' . fake()->slug(2),
            'description' => fake()->sentence(),
        ];
    }
}
