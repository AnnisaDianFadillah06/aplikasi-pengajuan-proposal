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
            [
                'id' => 1,
                'username' => 'prita',
                'role' => 'sekbem',
                'email' => 'prita@polban.ac.id',
                'nama_lengkap' => 'Prita Setiawan',
                'foto_profil' => 'img/reviewer/prita.jpg',
                'tanggal_bergabung' => '2022-01-15',
            ],
            [
                'id' => 2,
                'username' => 'ucup',
                'role' => 'kabem',
                'email' => 'ucup@polban.ac.id',
                'nama_lengkap' => 'Ucup Wiratama',
                'foto_profil' => 'img/reviewer/ucup.jpg',
                'tanggal_bergabung' => '2021-09-10',
            ],
            [
                'id' => 3,
                'username' => 'idoy',
                'role' => 'pembina',
                'email' => 'idoy@polban.ac.id',
                'nama_lengkap' => 'Idoy Sukardi',
                'foto_profil' => 'img/reviewer/idoy.jpg',
                'tanggal_bergabung' => '2020-05-20',
            ],
            [
                'id' => 4,
                'username' => 'hikmah',
                'role' => 'kajur',
                'email' => 'hikmah@polban.ac.id',
                'nama_lengkap' => 'Hikmah Putri',
                'foto_profil' => 'img/reviewer/hikmah.jpg',
                'tanggal_bergabung' => '2019-08-15',
            ],
            [
                'id' => 5,
                'username' => 'komli',
                'role' => 'kli',
                'email' => 'komli@polban.ac.id',
                'nama_lengkap' => 'Komli Hermawan',
                'foto_profil' => 'img/reviewer/komli.jpg',
                'tanggal_bergabung' => '2023-03-01',
            ],
            [
                'id' => 6,
                'username' => 'toni',
                'role' => 'wd3',
                'email' => 'toni@polban.ac.id',
                'nama_lengkap' => 'Toni Pratama',
                'foto_profil' => 'img/reviewer/toni.jpg',
                'tanggal_bergabung' => '2022-11-10',
            ],
        ]);
    }
}
