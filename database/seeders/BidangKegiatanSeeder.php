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
            [
                'id_bidang_kegiatan' => 1, 
                'nama_bidang_kegiatan' => 'proker',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => null,
                'updated_by' => null
            ],
            [
                'id_bidang_kegiatan' => 2, 
                'nama_bidang_kegiatan' => 'pergerakan',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => null,
                'updated_by' => null
            ],
            // [
            //     'id_bidang_kegiatan' => 4, 
            //     'nama_bidang_kegiatan' => 'lpj',
            //     'status' => 'tidak aktif',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            //     'created_by' => null,
            //     'updated_by' => null
            // ],
        ]);
    }
}