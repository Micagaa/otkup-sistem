<?php

namespace Tests\Feature;

use App\Models\Dobavljac;
use App\Models\Otkup;
use App\Models\SerijaPrerade;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QcUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_update_qc_status_for_serija(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $dobavljac = Dobavljac::create([
            'naziv' => 'Test Dobavljac',
            'pib' => '987654321',
            'mesto' => 'Ivanjica',
            'telefon' => '060999888',
            'email' => 'dobavljac2@test.com',
        ]);

        $otkup = Otkup::create([
            'dobavljac_id' => $dobavljac->id,
            'vrsta_ploda' => 'Malina',
            'kolicina_kg' => 50.00,
            'cena_po_kg' => 600.00,
            'datum_otkupa' => '2025-12-24',
            'status_isplate' => 'na_cekanju',
        ]);

        $serija = SerijaPrerade::create([
            'otkup_id' => $otkup->id,
            'faza' => 'ciscenje',
            'status_kvaliteta' => 'na_kontroli',
            'napomena_kvaliteta' => null,
            'datum_pocetka' => '2025-12-24',
            'datum_zavrsetka' => null,
        ]);

        $response = $this->put(route('qc.update', $serija), [
            'status_kvaliteta' => 'ispravno',
            'napomena_kvaliteta' => 'Sve OK',
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('serija_prerades', [
            'id' => $serija->id,
            'status_kvaliteta' => 'ispravno',
            'napomena_kvaliteta' => 'Sve OK',
        ]);
    }
}
