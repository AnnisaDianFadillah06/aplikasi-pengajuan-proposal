<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection('users')->table('mahasiswa')->insert([
            'username' => Str::random(10),
            'email' => Str::random(10) . '@polban.ac.id',
            'password' => bcrypt('password'),
        ]);
    }
}
