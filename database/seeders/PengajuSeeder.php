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
            ],
        ]);
    }
}