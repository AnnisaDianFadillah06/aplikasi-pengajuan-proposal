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
                'password' => '$2y$12$cZSKUXcfGfxccfOrcB3E3eSf3NuKwiw5JSFRa.EQbAruUUbDHfqbO'
            ],
            [
                'username' => 'ucup', 
                'email' => 'ucup@polban.ac.id', 
                'password' => '$2y$12$cZSKUXcfGfxccfOrcB3E3eSf3NuKwiw5JSFRa.EQbAruUUbDHfqbO'
            ],
            [
                'username' => 'idoy', 
                'email' => 'idoy@polban.ac.id', 
                'password' => '$2y$12$cZSKUXcfGfxccfOrcB3E3eSf3NuKwiw5JSFRa.EQbAruUUbDHfqbO'
            ],
            [
                'username' => 'hikmah', 
                'email' => 'hikmah@polban.ac.id', 
                'password' => '$2y$12$cZSKUXcfGfxccfOrcB3E3eSf3NuKwiw5JSFRa.EQbAruUUbDHfqbO'
            ],
            [
                'username' => 'komli', 
                'email' => 'komli@polban.ac.id', 
                'password' => '$2y$12$cZSKUXcfGfxccfOrcB3E3eSf3NuKwiw5JSFRa.EQbAruUUbDHfqbO'
            ],
            [
                'username' => 'toni', 
                'email' => 'toni@polban.ac.id', 
                'password' => '$2y$12$cZSKUXcfGfxccfOrcB3E3eSf3NuKwiw5JSFRa.EQbAruUUbDHfqbO'
            ],
            [
                'username' => 'rizz', 
                'email' => 'rizz@polban.ac.id', 
                'password' => '$2y$12$cZSKUXcfGfxccfOrcB3E3eSf3NuKwiw5JSFRa.EQbAruUUbDHfqbO'
            ],
            [
                'username' => 'razz', 
                'email' => 'razz@polban.ac.id', 
                'password' => '$2y$12$cZSKUXcfGfxccfOrcB3E3eSf3NuKwiw5JSFRa.EQbAruUUbDHfqbO'
            ],
        ]);
    }
}
