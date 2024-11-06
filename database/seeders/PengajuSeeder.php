<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengajuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection('pgsql')->table('pengaju')->insert([
            [
                'id' => 1, 
                'username' => 'El-Pengaju', 
                'email' => 'prita@polban.ac.id', 
            ],
            [
                'id' => 2, 
                'username' => 'Yanto', 
                'email' => 'yanto@polban.ac.id', 
            ],
        ]);
    }
}