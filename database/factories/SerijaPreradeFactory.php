<?php

namespace Database\Factories;

use App\Models\Otkup;
use Illuminate\Database\Eloquent\Factories\Factory;

class SerijaPreradeFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'otkup_id' => Otkup::factory(),
            'faza' => fake()->randomElement(["ciscenje","sortiranje","susenje","hladjenje","pakovanje"]),
            'status_kvaliteta' => fake()->randomElement(["na_kontroli","ispravno","neispravno"]),
            'napomena_kvaliteta' => fake()->text(),
            'datum_pocetka' => fake()->date(),
            'datum_zavrsetka' => fake()->date(),
        ];
    }
}
