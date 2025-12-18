<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SerijaPrerade;
use App\Models\Otkup;

class SerijaPreradeSeeder extends Seeder
{
    public function run(): void
    {
        $otkupi = Otkup::all();

        foreach ($otkupi as $otkup) {
            SerijaPrerade::create([
                'otkup_id' => $otkup->id,
                'faza' => 'ciscenje',
                'status_kvaliteta' => 'na_kontroli',
                'napomena_kvaliteta' => null,
                'datum_pocetka' => now()->toDateString(),
                'datum_zavrsetka' => null,
            ]);
        }
    }
}
