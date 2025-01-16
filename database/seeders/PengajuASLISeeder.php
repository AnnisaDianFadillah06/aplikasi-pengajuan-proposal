<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengajuASLISeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection('pgsql')->table('pengaju')->insert([
            [
                'username' => 'MPM',
                'email' => 'MPM@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 1,
            ],
            [
                'username' => 'BEM',
                'email' => 'BEM@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 2,
            ],
            [
                'username' => 'HMJ Teknik Sipil',
                'email' => 'HMJTS@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 3,
            ],
            [
                'username' => 'HMJ Teknik Mesin',
                'email' => 'HMJTM@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 4,
            ],
            [
                'username' => 'HMJ Teknik Elektro',
                'email' => 'HMJTE@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 5,
            ],
            [
                'username' => 'HMJ Teknik Kimia',
                'email' => 'HMJTK@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 6,
            ],
            [
                'username' => 'HMJ Teknik Komputer dan Informatika',
                'email' => 'HMJTKI@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 7,
            ],
            [
                'username' => 'HMJ Teknik Refrigerasi dan Tata Udara',
                'email' => 'HMJTRA@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 8,
            ],
            [
                'username' => 'HMJ Teknik Konversi Energi',
                'email' => 'HMJTKE@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 9,
            ],
            [
                'username' => 'HMJ Akuntansi',
                'email' => 'HMJTA@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 10,
            ],
            [
                'username' => 'HMJ Administrasi Niaga',
                'email' => 'HMJAN@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 11,
            ],
            [
                'username' => 'HMJ Bahasa Inggris',
                'email' => 'HMJBI@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 12,
            ],
            [
                'username' => 'UKM Robotika',
                'email' => 'UKM-ROBOTIKA@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 13,
            ],
            [
                'username' => 'UKM Otomotif',
                'email' => 'UKM-OTOMOTIF@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 14,
            ],
            [
                'username' => 'UKM Kewirausahaan',
                'email' => 'UKM-WIRUS@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 15,
            ],
            [
                'username' => 'UKM ELTRAS',
                'email' => 'UKM-ELTRAS@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 16,
            ],
            [
                'username' => 'UKM Assalam',
                'email' => 'UKM-ASSALAM@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 17,
            ],
            [
                'username' => 'UKM PMK',
                'email' => 'UKM-PMK@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 18,
            ],
            [
                'username' => 'UKM KMK',
                'email' => 'UKM-KMK@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 19,
            ],
            [
                'username' => 'UKM Kabayan',
                'email' => 'UKM-KABAYAN@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 20,
            ],
            [
                'username' => 'UKM PSM',
                'email' => 'UKM-PSM@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 21,
            ],
            [
                'username' => 'UKM Musik dan Teater',
                'email' => 'UKM-MUSKING@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 22,
            ],
            [
                'username' => 'UKM UKBM',
                'email' => 'UKM-UKBM@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 23,
            ],
            [
                'username' => 'UKM UBSU',
                'email' => 'UKM-UBSU@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 24,
            ],
            [
                'username' => 'UKM Sepakbola & Futsal',
                'email' => 'UKM-USF@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 25,
            ],
            [
                'username' => 'UKM Bola Basket',
                'email' => 'UKM-BASKET@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 26,
            ],
            [
                'username' => 'UKM Bola Voli',
                'email' => 'UKM-VOLLY@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 27,
            ],
            [
                'username' => 'UKM Bulutangkis',
                'email' => 'UKM-BULUTANGKIS@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 28,
            ],
            [
                'username' => 'UKM Catur',
                'email' => 'UKM-CATUR@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 29,
            ],
            [
                'username' => 'UKM Bela Diri',
                'email' => 'UKM-BELADIRI@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 30,
            ],
            [
                'username' => 'UKM SAGA',
                'email' => 'UKM-SAGA@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 31,
            ],
            [
                'username' => 'UKM KSR PMI',
                'email' => 'UKM-KSR@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 32,
            ],
            [
                'username' => 'UKM Pramuka',
                'email' => 'UKM-PRAMUKA@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 33,
            ],
            [
                'username' => 'UKM Fellas',
                'email' => 'UKM-FELLAS@polban.ac.id',
                'foto_profil' => '',
                'tanggal_bergabung' => '2025-01-15',
                'id_ormawa' => 34,
            ],
        ]);
    }
}