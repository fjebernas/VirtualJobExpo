<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobPost>
 */
class JobPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'position' => fake()->jobTitle(),
            'company' => fake()->company(),
            'location' => fake()->city() . ', ' . fake()->state(),
            'level' => fake()->randomElement(['entry-level ', 'intermediate', 'senior', 'internship']),
            'employment' => 'Full-time',
            'salary_range' => [
                'low' => fake()->numberBetween(3,5) . '0000',
                'high' => fake()->numberBetween(6,9) . '0000',
            ],
        ];
    }
}
