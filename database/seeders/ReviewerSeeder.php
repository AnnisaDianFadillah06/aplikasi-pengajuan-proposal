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
                'id_ormawa' => 2, // Referensi ke id_role di tabel ormawa
                'email' => 'prita@polban.ac.id',
                'nama_lengkap' => 'Prita Setiawan',
                'foto_profil' => 'img/reviewer/prita.jpg',
                'tanggal_bergabung' => '2022-01-15',
            ],
            [
                'username' => 'idoy',
                'id_role' => 2, // Referensi ke id_role di tabel roles
                'id_ormawa' => 7,
                'email' => 'idoy@polban.ac.id',
                'nama_lengkap' => 'Idoy Sukardi',
                'foto_profil' => 'img/reviewer/idoy.jpg',
                'tanggal_bergabung' => '2020-05-20',
            ],
            [
                'username' => 'hikmah',
                'id_role' => 3, // Referensi ke id_role di tabel roles
                'id_ormawa' => 7,
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
            
            // akun real kajur
            [
                'username' => 'luthfi',
                'id_role' => 3, 
                'id_ormawa' => 3,
                'email' => 'luthfi-mm@polban.ac.id',
                'nama_lengkap' => 'Luthfi',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-30',
            ],
            [
                'username' => 'amaldi',
                'id_role' => 3, 
                'id_ormawa' => 4,
                'email' => 'amaldi@polban.ac.id',
                'nama_lengkap' => 'Amaldi',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-30',
            ],
            [
                'username' => 'akangarman',
                'id_role' => 3, 
                'id_ormawa' => 8,
                'email' => 'akangarman@polban.ac.id',
                'nama_lengkap' => 'akangarman',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-30',
            ],
            [
                'username' => 'wahyumursanto',
                'id_role' => 3, 
                'id_ormawa' => 9,
                'email' => 'wahyu.mursanto@polban.ac.id',
                'nama_lengkap' => 'Wahyu Mursanto',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-30',
            ],
            [
                'username' => 'hepiludiyati',
                'id_role' => 3, 
                'id_ormawa' => 5,
                'email' => 'hepi.ludiyati@polban.ac.id',
                'nama_lengkap' => 'Hepi Ludiyati',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-30',
            ],
            [
                'username' => 'shoeryashoelarta',
                'id_role' => 3, 
                'id_ormawa' => 6,
                'email' => 'shoerya.shoelarta@polban.ac.id',
                'nama_lengkap' => 'Shoerya Shoelarta',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-30',
            ],
            [
                'username' => 'yadhi',
                'id_role' => 3, 
                'id_ormawa' => 7,
                'email' => 'yadhi@polban.ac.id',
                'nama_lengkap' => 'Yadhi',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-30',
            ],
            [
                'username' => 'iwansetiawan',
                'id_role' => 3, 
                'id_ormawa' => 10,
                'email' => 'iwan.setiawan@polban.ac.id',
                'nama_lengkap' => 'Iwan Setiawan',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-30',
            ],
            [
                'username' => 'rivansutrisno',
                'id_role' => 3, 
                'id_ormawa' => 11,
                'email' => 'rivan.sutrisno@polban.ac.id',
                'nama_lengkap' => 'Rivan Sutrisno',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-30',
            ],
            [
                'username' => 'linameilinda',
                'id_role' => 3, 
                'id_ormawa' => 12,
                'email' => 'lina.meilinda@polban.ac.id',
                'nama_lengkap' => 'Lina Meilinda',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-30',
            ],
            
            //Akun KLI
            [
                'username' => 'kli',
                'id_role' => 4, 
                'id_ormawa' => 0,
                'email' => 'KLI@polban.ac.id',
                'nama_lengkap' => 'KLI',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-30',
            ],

            //Akun Wadir3
            [
                'username' => 'wadir3',
                'id_role' => 5, 
                'id_ormawa' => 0,
                'email' => 'wadir3@polban.ac.id',
                'nama_lengkap' => 'KLI',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-30',
            ],
            [
                'username' => 'publikasikemahasiswaan',
                'id_role' => 5, 
                'id_ormawa' => 0,
                'email' => 'publikasikemahasiswaan@polban.ac.id',
                'nama_lengkap' => 'Publikasi Kemahasiswaan',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-30',
            ],

        ]);
    }
}
