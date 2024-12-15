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
                'username' => 'El-Pengaju', 
                'email' => 'El-Pengaju@polban.ac.id', 
                'password' => '$2y$12$cZSKUXcfGfxccfOrcB3E3eSf3NuKwiw5JSFRa.EQbAruUUbDHfqbO'
            ],
            [
                'id' => 2, 
                'username' => 'Yanto', 
                'email' => 'yanto@polban.ac.id', 
                'password' => '$2y$12$cZSKUXcfGfxccfOrcB3E3eSf3NuKwiw5JSFRa.EQbAruUUbDHfqbO'
            ],
            [
                'id' => 3, 
                'username' => 'Angel', 
                'email' => 'angel@polban.ac.id', 
                'password' => '$2y$12$cZSKUXcfGfxccfOrcB3E3eSf3NuKwiw5JSFRa.EQbAruUUbDHfqbO'
            ],
            [
                'id' => 4, 
                'username' => 'Dhea', 
                'email' => 'dhea@polban.ac.id', 
                'password' => '$2y$12$cZSKUXcfGfxccfOrcB3E3eSf3NuKwiw5JSFRa.EQbAruUUbDHfqbO'
            ],
            [
                'id' => 5, 
                'username' => 'Dian', 
                'email' => 'dian@polban.ac.id', 
                'password' => '$2y$12$cZSKUXcfGfxccfOrcB3E3eSf3NuKwiw5JSFRa.EQbAruUUbDHfqbO'
            ],
            [
                'id' => 6, 
                'username' => 'Harish', 
                'email' => 'muhammad.harish.tif23@polban.ac.id', 
                'password' => '$2y$12$cZSKUXcfGfxccfOrcB3E3eSf3NuKwiw5JSFRa.EQbAruUUbDHfqbO'
            ],
            [
                'id' => 7, 
                'username' => 'Elroy', 
                'email' => 'elroy@polban.ac.id', 
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