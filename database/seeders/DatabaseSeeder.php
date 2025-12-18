<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed core domain data
        $this->call([
            DobavljacSeeder::class,
            OtkupSeeder::class,
            SerijaPreradeSeeder::class,
            ZalihaSeeder::class,
        ]);

        // Seed test user (for Breeze login)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
