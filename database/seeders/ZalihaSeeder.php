<?php

namespace Database\Seeders;

use App\Models\SerijaPrerade;
use App\Models\Zaliha;
use Illuminate\Database\Seeder;

class ZalihaSeeder extends Seeder
{
    public function run(): void
    {
        $serija = SerijaPrerade::first();
        if (! $serija) {
            return;
        }

        Zaliha::create([
            'serija_prerade_id' => $serija->id,
            'vrsta_proizvoda' => 'Sušena borovnica',
            'kolicina_kg' => 10.00,
            'rok_upotrebe' => now()->addMonths(6)->toDateString(),
            'pozicija' => 'Hladnjača A-1',
            'datum_prijema' => now()->toDateString(),
        ]);
    }
}
