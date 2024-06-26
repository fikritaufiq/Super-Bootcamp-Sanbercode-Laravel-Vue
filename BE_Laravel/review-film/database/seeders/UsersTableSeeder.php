<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $adminRoleId = DB::table('roles')->where('name', 'admin')->value('id_uuid');

        DB::table('users')->insert([
            'id_uuid' => Str::uuid()->toString(),
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Pastikan untuk menghash password
            'email_verified_at' => now(),
            'role_id_uuid' => $adminRoleId
        ]);
    }
}
