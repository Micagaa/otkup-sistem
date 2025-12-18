<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DobavljacFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'naziv' => fake()->word(),
            'pib' => fake()->word(),
            'mesto' => fake()->word(),
            'telefon' => fake()->word(),
            'email' => fake()->safeEmail(),
        ];
    }
}
