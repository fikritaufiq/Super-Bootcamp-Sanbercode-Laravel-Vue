<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data roles yang akan dimasukkan
        $roles = [
            [
                'id' => '923607c6-d032-49df-9e23-cddfdf5fd509',
                'name' => 'admin',
            ],
            [
                'id' => '6c88e443-5f48-4140-8cff-e33cc6039d4b',
                'name' => 'user',
            ],
        ];

        // Memasukkan data roles ke dalam database
        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
