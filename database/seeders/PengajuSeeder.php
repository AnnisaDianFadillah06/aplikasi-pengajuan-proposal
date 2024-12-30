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
                'email' => 'El-Pengaju@polban.ac.id',
                'nama_lengkap' => 'Eliana Pengaju',
                'foto_profil' => 'img/el-pengaju.jpg',
                'tanggal_bergabung' => '2023-01-10',
                'nama_ormawa' => 'Himpunan Mahasiswa Komputer',
                'nim' => '231511021',
                'id_ormawa' => 1,
            ],
            [
                'id' => 2,
                'username' => 'Yanto',
                'email' => 'yanto@polban.ac.id',
                'nama_lengkap' => 'Yanto Suprapto',
                'foto_profil' => 'img/yanto.jpg',
                'tanggal_bergabung' => '2023-02-15',
                'nama_ormawa' => 'Himpunan Mahasiswa Jurusan Teknik Kimia',
                'nim' => '231511020',
                'id_ormawa' => 1,
            ],
            [
                'id' => 3,
                'username' => 'Angel',
                'email' => 'angel@polban.ac.id',
                'nama_lengkap' => 'Yanto Suprapto',
                'foto_profil' => 'img/yanto.jpg',
                'tanggal_bergabung' => '2023-02-15',
                'nama_ormawa' => 'Himpunan Mahasiswa Jurusan Teknik Kimia',
                'nim' => '231511020',
                'id_ormawa' => 1,
            ],
            [
                'id' => 4,
                'username' => 'Dhea',
                'email' => 'dhea@polban.ac.id',
                'nama_lengkap' => 'Yanto Suprapto',
                'foto_profil' => 'img/yanto.jpg',
                'tanggal_bergabung' => '2023-02-15',
                'nama_ormawa' => 'Himpunan Mahasiswa Jurusan Teknik Kimia',
                'nim' => '231511020',
                'id_ormawa' => 1,
            ],
            [
                'id' => 5,
                'username' => 'Dian',
                'email' => 'dian@polban.ac.id',
                'nama_lengkap' => 'Yanto Suprapto',
                'foto_profil' => 'img/yanto.jpg',
                'tanggal_bergabung' => '2023-02-15',
                'nama_ormawa' => 'Himpunan Mahasiswa Jurusan Teknik Kimia',
                'nim' => '231511020',
                'id_ormawa' => 1,
            ],
            [
                'id' => 6,
                'username' => 'Harish',
                'email' => 'muhammad.harish.tif23@polban.ac.id',
                'nama_lengkap' => 'Yanto Suprapto',
                'foto_profil' => 'img/yanto.jpg',
                'tanggal_bergabung' => '2023-02-15',
                'nama_ormawa' => 'Himpunan Mahasiswa Jurusan Teknik Kimia',
                'nim' => '231511020',
                'id_ormawa' => 9,
            ],
            [
                'id' => 7,
                'username' => 'Elroy',
                'email' => 'elroy@polban.ac.id',
                'nama_lengkap' => 'Yanto Suprapto',
                'foto_profil' => 'img/yanto.jpg',
                'tanggal_bergabung' => '2023-02-15',
                'nama_ormawa' => 'Himpunan Mahasiswa Jurusan Teknik Kimia',
                'nim' => '231511020',
                'id_ormawa' => 2,
            ],
        ]);
    }
}