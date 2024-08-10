<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan akun owner
        $roleOwner = Role::where('name', 'owner')->first();
        User::create([
            'name' => 'Owner User',
            'email' => 'owner@mail.com',
            'password' => Hash::make('password'), // Ganti dengan password yang aman
            'role_id' => $roleOwner->id,
        ]);
    }
}
