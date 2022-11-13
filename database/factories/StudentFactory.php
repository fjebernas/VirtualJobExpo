<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $gender = fake()->randomElement(['male', 'female']);

        return [
            'first_name' => fake()->firstName($gender),
            'middle_name' => fake()->lastName(),
            'last_name' => fake()->lastName(),
            'birthdate' => fake()->date('Y-m-d','-20 years'),
            'gender' => $gender,
            'university' => 'University of ' . fake()->lastName(),
            'contact_number' => fake()->phoneNumber(),
        ];
    }
}
