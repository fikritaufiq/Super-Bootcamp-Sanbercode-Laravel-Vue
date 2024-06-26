<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id_uuid' => Str::uuid()->toString(),
                'name' => 'admin'
            ],
            [
                'id_uuid' => Str::uuid()->toString(),
                'name' => 'user'
            ]
        ]);
    }
}
