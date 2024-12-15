<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JenisKegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        DB::connection('pgsql')->table('jenis_kegiatan')->insert([
            ['id_jenis_kegiatan' => 1, 'nama_jenis_kegiatan' => 'Penalaran dan Keilmuan', 'created_at' => $now, 'updated_at' => $now],
            ['id_jenis_kegiatan' => 2, 'nama_jenis_kegiatan' => 'Pengabdian', 'created_at' => $now, 'updated_at' => $now],
            ['id_jenis_kegiatan' => 3, 'nama_jenis_kegiatan' => 'Peminatan', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}