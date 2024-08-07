<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        {
            Roles::create([
                'name' => 'user'
            ]);
    
            Roles::create([
                'name' => 'owner'
            ]);
        } 
    }
}