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
                'username' => 'El-Pengaju',
                'email' => 'El-Pengaju@polban.ac.id',
                'foto_profil' => 'img/el-pengaju.jpg',
                'tanggal_bergabung' => '2023-01-10',
                'id_ormawa' => 1,
            ],
            [
                'username' => 'Yanto',
                'email' => 'yanto@polban.ac.id',
                'foto_profil' => 'img/yanto.jpg',
                'tanggal_bergabung' => '2023-02-15',
                'id_ormawa' => 1,
            ],
            [
                'username' => 'Angel',
                'email' => 'angel@polban.ac.id',
                'foto_profil' => 'img/yanto.jpg',
                'tanggal_bergabung' => '2023-02-15',
                'id_ormawa' => 1,
            ],
            [
                'username' => 'Dhea',
                'email' => 'dhea@polban.ac.id',
                'foto_profil' => 'img/yanto.jpg',
                'tanggal_bergabung' => '2023-02-15',
                'id_ormawa' => 1,
            ],
            [
                'username' => 'Dian',
                'email' => 'dian@polban.ac.id',
                'foto_profil' => 'img/yanto.jpg',
                'tanggal_bergabung' => '2023-02-15',
                'id_ormawa' => 1,
            ],
            [
                'username' => 'Harish',
                'email' => 'muhammad.harish.tif23@polban.ac.id',
                'foto_profil' => 'img/yanto.jpg',
                'tanggal_bergabung' => '2023-02-15',
                'id_ormawa' => 9,
            ],
            [
                'username' => 'Elroy',
                'email' => 'elroy@polban.ac.id',
                'foto_profil' => 'img/yanto.jpg',
                'tanggal_bergabung' => '2023-02-15',
                'id_ormawa' => 2,
            ],
        ]);
    }
}