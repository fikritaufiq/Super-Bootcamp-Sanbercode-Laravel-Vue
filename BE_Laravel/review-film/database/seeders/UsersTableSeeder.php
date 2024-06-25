<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tambahkan user dengan role admin
        User::create([
            'id' => 'a5cc3a29-3ee7-4b9b-b7c6-2562b8a505c4', // Sesuaikan dengan UUID yang Anda inginkan
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Ganti dengan password yang Anda inginkan
            'role_id' => '923607c6-d032-49df-9e23-cddfdf5fd509', // Sesuaikan dengan UUID role admin
            'email_verified_at' => now(),
        ]);
    }
}
