<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PedomanKemahasiswaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection('pgsql')->table('pedoman_kemahasiswaan')->insert([
            [
                'nama_pedoman' => 'Pedoman Akademik 2024',
                'file_pedoman' => 'laraview/pedoman_akademik_2024.pdf',
                'status' => 1, 
            ],
            [
                'nama_pedoman' => 'Pedoman Kegiatan Mahasiswa',
                'file_pedoman' => 'laraview/pedoman_kegiatan_mahasiswa.pdf',
                'status' => 1,
            ],
            [
                'nama_pedoman' => 'Pedoman Penelitian Mahasiswa',
                'file_pedoman' => 'laraview/pedoman_penelitian_mahasiswa.pdf',
                'status' => 1,
            ]
        ]);
    }
}
