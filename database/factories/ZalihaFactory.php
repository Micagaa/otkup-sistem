<?php

namespace Database\Factories;

use App\Models\SerijaPrerade;
use Illuminate\Database\Eloquent\Factories\Factory;

class ZalihaFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'serija_prerade_id' => SerijaPrerade::factory(),
            'vrsta_proizvoda' => fake()->word(),
            'kolicina_kg' => fake()->randomFloat(2, 0, 999999.99),
            'rok_upotrebe' => fake()->date(),
            'pozicija' => fake()->word(),
            'datum_prijema' => fake()->date(),
        ];
    }
}
