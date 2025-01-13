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
                'username' => 'prita',
                'id_role' => 1, // Referensi ke id_role di tabel roles
                'id_ormawa' => 0, // Referensi ke id_role di tabel ormawa
                'email' => 'prita@polban.ac.id',
                'nama_lengkap' => 'Prita Setiawan',
                'foto_profil' => 'img/reviewer/prita.jpg',
                'tanggal_bergabung' => '2022-01-15',
            ],
            [
                'username' => 'ucup',
                'id_role' => 1, // Referensi ke id_role di tabel roles
                'id_ormawa' => 2,
                'email' => 'ucup@polban.ac.id',
                'nama_lengkap' => 'Ucup Wiratama',
                'foto_profil' => 'img/reviewer/ucup.jpg',
                'tanggal_bergabung' => '2021-09-10',
            ],
            [
                'username' => 'idoy',
                'id_role' => 2, // Referensi ke id_role di tabel roles
                'id_ormawa' => 9,
                'email' => 'idoy@polban.ac.id',
                'nama_lengkap' => 'Idoy Sukardi',
                'foto_profil' => 'img/reviewer/idoy.jpg',
                'tanggal_bergabung' => '2020-05-20',
            ],
            [
                'username' => 'rizz',
                'id_role' => 2, // Referensi ke id_role di tabel roles
                'id_ormawa' => 3,
                'email' => 'rizz@polban.ac.id',
                'nama_lengkap' => 'Rizz saputra',
                'foto_profil' => 'img/reviewer/idoy.jpg',
                'tanggal_bergabung' => '2020-05-20',
            ],
            [
                'username' => 'razz',
                'id_role' => 2, // Referensi ke id_role di tabel roles
                'id_ormawa' => 9,
                'email' => 'razz@polban.ac.id',
                'nama_lengkap' => 'Rizz saputra',
                'foto_profil' => 'img/reviewer/idoy.jpg',
                'tanggal_bergabung' => '2020-05-20',
            ],
            [
                'username' => 'hikmah',
                'id_role' => 3, // Referensi ke id_role di tabel roles
                'id_ormawa' => 2,
                'email' => 'hikmah@polban.ac.id',
                'nama_lengkap' => 'Hikmah Putri',
                'foto_profil' => 'img/reviewer/hikmah.jpg',
                'tanggal_bergabung' => '2019-08-15',
            ],
            [
                'username' => 'komli',
                'id_role' => 4, // Referensi ke id_role di tabel roles
                'id_ormawa' => 0,
                'email' => 'komli@polban.ac.id',
                'nama_lengkap' => 'Komli Hermawan',
                'foto_profil' => 'img/reviewer/komli.jpg',
                'tanggal_bergabung' => '2023-03-01',
            ],
            [
                'username' => 'toni',
                'id_role' => 5, // Referensi ke id_role di tabel roles
                'id_ormawa' => 0,
                'email' => 'toni@polban.ac.id',
                'nama_lengkap' => 'Toni Pratama',
                'foto_profil' => 'img/reviewer/toni.jpg',
                'tanggal_bergabung' => '2022-11-10',
            ],
        ]);
    }
}
