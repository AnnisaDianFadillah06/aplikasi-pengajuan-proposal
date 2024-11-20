<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BidangKegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection('pgsql')->table('bidang_kegiatan')->insert([
            ['id' => 1, 'nama_bidang_kegiatan' => 'proker'],
            ['id' => 2, 'nama_bidang_kegiatan' => 'pergerakan'],
            ['id' => 3, 'nama_bidang_kegiatan' => 'lainnya'],
            ['id' => 4, 'nama_bidang_kegiatan' => 'lpj'],
        ]);
    }
}
