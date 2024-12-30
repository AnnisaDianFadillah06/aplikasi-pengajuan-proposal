<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection('pgsql')->table('roles')->insert([
            ['id_role' => 1, 'role' => 'bem'],
            ['id_role' => 2, 'role' => 'pembina'],
            ['id_role' => 3, 'role' => 'kajur'],
            ['id_role' => 4, 'role' => 'kli'],
            ['id_role' => 5, 'role' => 'wd3'],
        ]);
    }
}
