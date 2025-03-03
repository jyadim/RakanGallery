<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@KennGallery.com',
            'username' => 'AdminMantapWell',
            'password' => Hash::make('12345678'),
            'address' => 'aa',
            'verified' => true,
            'is_admin' => true,
        ]);
    }
}
