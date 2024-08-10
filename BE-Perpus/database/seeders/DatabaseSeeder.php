<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder; // Menambahkan import RoleSeeder

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Menjalankan RoleSeeder untuk menambahkan role
        $this->call(RoleSeeder::class);

        // Contoh seeder pengguna (uncomment jika diperlukan)
        // \App\Models\User::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}