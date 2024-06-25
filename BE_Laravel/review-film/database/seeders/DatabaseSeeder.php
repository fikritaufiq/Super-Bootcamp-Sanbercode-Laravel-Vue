<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Memanggil seeder RolesTableSeeder
        $this->call(RolesTableSeeder::class);

        // Memanggil seeder UsersTableSeeder
        $this->call(UsersTableSeeder::class);
    }
}
