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
            'company' => 'not set',
            'location' => fake()->city() . ', ' . fake()->state(),
            'level' => 'Senior',
            'employment' => 'Full-time',
            'salary_range' => [
                'low' => fake()->numberBetween(3,5) . '0000',
                'high' => fake()->numberBetween(6,9) . '0000',
            ],
        ];
    }
}
