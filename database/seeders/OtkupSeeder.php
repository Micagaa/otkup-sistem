<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Otkup;
use App\Models\Dobavljac;

class OtkupSeeder extends Seeder
{
    public function run(): void
    {
        $d1 = Dobavljac::first();
        $d2 = Dobavljac::skip(1)->first();

        Otkup::insert([
            [
                'dobavljac_id' => $d1->id,
                'vrsta_ploda' => 'Borovnica',
                'kolicina_kg' => 25.00,
                'cena_po_kg' => 600.00,
                'datum_otkupa' => now()->toDateString(),
                'status_isplate' => 'na_cekanju',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'dobavljac_id' => $d2->id,
                'vrsta_ploda' => 'Malina',
                'kolicina_kg' => 40.50,
                'cena_po_kg' => 520.00,
                'datum_otkupa' => now()->subDay()->toDateString(),
                'status_isplate' => 'isplaceno',
                'created_at' => now(), 'updated_at' => now(),
            ],
        ]);
    }
}
