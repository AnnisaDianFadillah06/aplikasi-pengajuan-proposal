<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisKegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection('pgsql')->table('jenis_kegiatan')->insert([
            ['id_jenis_kegiatan' => 1, 'nama_jenis_kegiatan' => 'Penalaran dan Keilmuan'],
            ['id_jenis_kegiatan' => 2, 'nama_jenis_kegiatan' => 'Pengabdian'],
            ['id_jenis_kegiatan' => 3, 'nama_jenis_kegiatan' => 'Peminatan'],
        ]);
    }
}
