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
                'username' => 'El-Pengaju', 
                'email' => 'El-Pengaju@polban.ac.id', 
                'password' => '$2y$12$cZSKUXcfGfxccfOrcB3E3eSf3NuKwiw5JSFRa.EQbAruUUbDHfqbO'
            ],
            [
                'username' => 'Yanto', 
                'email' => 'yanto@polban.ac.id', 
                'password' => '$2y$12$cZSKUXcfGfxccfOrcB3E3eSf3NuKwiw5JSFRa.EQbAruUUbDHfqbO'
            ],
            [
                'username' => 'Angel', 
                'email' => 'angel@polban.ac.id', 
                'password' => '$2y$12$cZSKUXcfGfxccfOrcB3E3eSf3NuKwiw5JSFRa.EQbAruUUbDHfqbO'
            ],
            [
                'username' => 'Dhea', 
                'email' => 'dhea@polban.ac.id', 
                'password' => '$2y$12$cZSKUXcfGfxccfOrcB3E3eSf3NuKwiw5JSFRa.EQbAruUUbDHfqbO'
            ],
            [
                'username' => 'Dian', 
                'email' => 'dian@polban.ac.id', 
                'password' => '$2y$12$cZSKUXcfGfxccfOrcB3E3eSf3NuKwiw5JSFRa.EQbAruUUbDHfqbO'
            ],
            [
                'username' => 'Harish', 
                'email' => 'muhammad.harish.tif23@polban.ac.id', 
                'password' => '$2y$12$cZSKUXcfGfxccfOrcB3E3eSf3NuKwiw5JSFRa.EQbAruUUbDHfqbO'
            ],
            [
                'username' => 'Elroy', 
                'email' => 'elroy@polban.ac.id', 
                'password' => '$2y$12$cZSKUXcfGfxccfOrcB3E3eSf3NuKwiw5JSFRa.EQbAruUUbDHfqbO'
            ],
        ]);
    }
}
