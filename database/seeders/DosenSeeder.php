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
                'id' => 1, 
                'username' => 'prita', 
                'email' => 'prita@polban.ac.id', 
                'password' => '$2y$12$cZSKUXcfGfxccfOrcB3E3eSf3NuKwiw5JSFRa.EQbAruUUbDHfqbO'
            ],
            [
                'id' => 2, 
                'username' => 'ucup', 
                'email' => 'ucup@polban.ac.id', 
                'password' => '$2y$12$cZSKUXcfGfxccfOrcB3E3eSf3NuKwiw5JSFRa.EQbAruUUbDHfqbO'
            ],
            [
                'id' => 3, 
                'username' => 'idoy', 
                'email' => 'idoy@polban.ac.id', 
                'password' => '$2y$12$cZSKUXcfGfxccfOrcB3E3eSf3NuKwiw5JSFRa.EQbAruUUbDHfqbO'
            ],
            [
                'id' => 4, 
                'username' => 'hikmah', 
                'email' => 'hikmah@polban.ac.id', 
                'password' => '$2y$12$cZSKUXcfGfxccfOrcB3E3eSf3NuKwiw5JSFRa.EQbAruUUbDHfqbO'
            ],
            [
                'id' => 5, 
                'username' => 'komli', 
                'email' => 'komli@polban.ac.id', 
                'password' => '$2y$12$cZSKUXcfGfxccfOrcB3E3eSf3NuKwiw5JSFRa.EQbAruUUbDHfqbO'
            ],
            [
                'id' => 6, 
                'username' => 'toni', 
                'email' => 'toni@polban.ac.id', 
                'password' => '$2y$12$cZSKUXcfGfxccfOrcB3E3eSf3NuKwiw5JSFRa.EQbAruUUbDHfqbO'
            ],
            [
                'id' => 7, 
                'username' => 'rizz', 
                'email' => 'rizz@polban.ac.id', 
                'password' => '$2y$12$cZSKUXcfGfxccfOrcB3E3eSf3NuKwiw5JSFRa.EQbAruUUbDHfqbO'
            ],
            [
                'id' => 8, 
                'username' => 'razz', 
                'email' => 'razz@polban.ac.id', 
                'password' => '$2y$12$cZSKUXcfGfxccfOrcB3E3eSf3NuKwiw5JSFRa.EQbAruUUbDHfqbO'
            ],
        ]);
    }
}
