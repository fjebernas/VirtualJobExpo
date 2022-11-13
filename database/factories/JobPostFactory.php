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
            'location' => 'not set',
            'level' => 'Senior',
            'employment' => 'Full-time',
            'salary_range' => [
                'low' => fake()->numberBetween(4,7) . '0000',
                'high' => fake()->numberBetween(8,9) . '0000',
            ],
        ];
    }
}
