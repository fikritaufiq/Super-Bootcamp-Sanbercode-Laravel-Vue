<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Roles;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
        if (!User::where('email', 'owner@mail.com')->exists()) {
            $roleOwner = Roles::where('name', 'owner')->first();

            DB::table('users')->insert([
                'id' => (string) Str::uuid(), 
                'name' => 'Owner',
                'email' => 'owner@mail.com',
                'password' => Hash::make('password'),
                'role_id' => $roleOwner->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}