<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection('pgsql')->table('reviewer')->insert([
            ['id' => 1, 'username' => 'prita', 'role' => 'sekbem', 'email' => 'prita@polban.ac.id'],
            ['id' => 2, 'username' => 'ucup', 'role' => 'kabem', 'email' => 'ucup@polban.ac.id'],
            ['id' => 3, 'username' => 'idoy', 'role' => 'pembina', 'email' => 'idoy@polban.ac.id'],
            ['id' => 4, 'username' => 'hikmah', 'role' => 'kajur', 'email' => 'hikmah@polban.ac.id'],
            ['id' => 5, 'username' => 'komli', 'role' => 'kli', 'email' => 'komli@polban.ac.id'],
            ['id' => 6, 'username' => 'toni', 'role' => 'wd3', 'email' => 'tommy@polban.ac.id'],
        ]);
    }
}
