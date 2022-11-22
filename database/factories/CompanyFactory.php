<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->company(),
            'industry' => fake()->randomElement(['IT/Technology', 'Commerce', 'Manufacturing', 'Finance', 'Agriculture']),
            'address' => fake()->streetAddress() . ', ' . fake()->state(),
            'contact_number' => fake()->phoneNumber(),
            'about' => fake()->realText(300, 2),
            'user_id' => User::factory(),
        ];
    }
}
