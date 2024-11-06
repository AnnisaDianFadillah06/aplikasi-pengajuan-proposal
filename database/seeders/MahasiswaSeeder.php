<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection('users')->table('mahasiswa')->insert([
            [
                'id' => 1, 
                'username' => 'harish', 
                'email' => 'harish@polban.ac.id', 
                'password' => '$2y$12$cZSKUXcfGfxccfOrcB3E3eSf3NuKwiw5JSFRa.EQbAruUUbDHfqbO'
            ],
        ]);
    }
}

// public function run(): void
//     {
//         DB::connection('users')->table('mahasiswa')->insert([
//             'username' => Str::random(10),
//             'email' => Str::random(10) . '@polban.ac.id',
//             'password' => bcrypt('password'),
//         ]);
//     }