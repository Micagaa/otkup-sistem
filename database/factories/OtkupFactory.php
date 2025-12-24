<?php

namespace Database\Factories;

use App\Models\Dobavljac;
use Illuminate\Database\Eloquent\Factories\Factory;

class OtkupFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'dobavljac_id' => Dobavljac::factory(),
            'vrsta_ploda' => fake()->word(),
            'kolicina_kg' => fake()->randomFloat(2, 0, 999999.99),
            'cena_po_kg' => fake()->randomFloat(2, 0, 99999999.99),
            'datum_otkupa' => fake()->date(),
            'status_isplate' => fake()->randomElement(['na_cekanju', 'isplaceno']),
        ];
    }
}
