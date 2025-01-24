<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection('users')->table('dosen')->insert([
            [
                'username' => 'prita', 
                'email' => 'prita@polban.ac.id', 
                'password' => bcrypt('linakscore')
            ],
            [
                'username' => 'ucup', 
                'email' => 'ucup@polban.ac.id', 
                'password' => bcrypt('linakscore')
            ],
            [
                'username' => 'idoy', 
                'email' => 'idoy@polban.ac.id', 
                'password' => bcrypt('linakscore')
            ],
            [
                'username' => 'hikmah', 
                'email' => 'hikmah@polban.ac.id', 
                'password' => bcrypt('linakscore')
            ],
            [
                'username' => 'komli', 
                'email' => 'komli@polban.ac.id', 
                'password' => bcrypt('linakscore')
            ],
            [
                'username' => 'toni', 
                'email' => 'toni@polban.ac.id', 
                'password' => bcrypt('linakscore')
            ],
            [
                'username' => 'rizz', 
                'email' => 'rizz@polban.ac.id', 
                'password' => bcrypt('linakscore')
            ],
            [
                'username' => 'razz', 
                'email' => 'razz@polban.ac.id', 
                'password' => bcrypt('linakscore')
            ],
        ]);
    }
}
