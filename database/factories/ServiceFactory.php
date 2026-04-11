<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'        => fake()->words(3, true),
            'type'        => fake()->randomElement(['web', 'app']),
            'icon'        => fake()->optional()->word(),
            'path'        => '/' . fake()->slug(2),
            'description' => fake()->sentence(),
        ];
    }
}
