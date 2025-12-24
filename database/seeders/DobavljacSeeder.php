<?php

namespace Database\Seeders;

use App\Models\Dobavljac;
use Illuminate\Database\Seeder;

class DobavljacSeeder extends Seeder
{
    public function run(): void
    {
        Dobavljac::insert([
            [
                'naziv' => 'OPG Jovanović',
                'pib' => '109876543',
                'mesto' => 'Ivanjica',
                'telefon' => '064111222',
                'email' => 'jovanovic@example.com',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'naziv' => 'Gazdinstvo Petrović',
                'pib' => '104512333',
                'mesto' => 'Arilje',
                'telefon' => '063222333',
                'email' => 'petrovic@example.com',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'naziv' => 'Šumski plodovi Milenković',
                'pib' => null,
                'mesto' => 'Požega',
                'telefon' => '065333444',
                'email' => null,
                'created_at' => now(), 'updated_at' => now(),
            ],
        ]);
    }
}
