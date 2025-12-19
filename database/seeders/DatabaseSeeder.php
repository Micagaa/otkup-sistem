<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

        // Admin user (known credentials)
        User::create([
            'name' => 'Admin',
            'email' => 'admin@smrcak.rs',
            'password' => Hash::make('admin123'),
        ]);
    }
}
