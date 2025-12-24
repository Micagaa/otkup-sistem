<?php

namespace Tests\Feature;

use App\Models\Dobavljac;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OtkupStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_otkup(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Napravi dobavljača (minimum polja)
        $dobavljac = Dobavljac::create([
            'naziv' => 'Test Dobavljac',
            'pib' => '123456789',
            'mesto' => 'Ivanjica',
            'telefon' => '060123456',
            'email' => 'dobavljac@test.com',
        ]);

        $payload = [
            'dobavljac_id' => $dobavljac->id,
            'vrsta_ploda' => 'Borovnica',
            'kolicina_kg' => 120.50,
            'cena_po_kg' => 450.00,
            'datum_otkupa' => '2025-12-24',
            // ako ti forma šalje status, ostavi; ako ne šalje, možeš da obrišeš ovu liniju
            'status_isplate' => 'na_cekanju',
        ];

        $response = $this->post(route('otkupi.store'), $payload);

        $response->assertStatus(302); // redirect posle uspešnog store-a

        $this->assertDatabaseHas('otkups', [
            'dobavljac_id' => $dobavljac->id,
            'vrsta_ploda' => 'Borovnica',
        ]);
    }
}
