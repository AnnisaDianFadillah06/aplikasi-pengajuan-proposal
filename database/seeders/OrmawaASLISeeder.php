<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrmawaASLISeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        DB::connection('pgsql')->table('ormawa')->insert([
            ['id_ormawa' => 1, 'nama_ormawa' => 'MPM', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 2, 'nama_ormawa' => 'BEM', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 3, 'nama_ormawa' => 'HMJ Teknik Sipil', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 4, 'nama_ormawa' => 'HMJ Teknik Mesin', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 5, 'nama_ormawa' => 'HMJ Teknik Elektro', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 6, 'nama_ormawa' => 'HMJ Teknik Kimia', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 7, 'nama_ormawa' => 'HMJ Teknik Komputer dan Informatika', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 8, 'nama_ormawa' => 'HMJ Teknik Refrigerasi dan Tata Udara', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 9, 'nama_ormawa' => 'HMJ Teknik Konversi Energi', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 10, 'nama_ormawa' => 'HMJ Akuntansi', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 11, 'nama_ormawa' => 'HMJ Administrasi Niaga', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 12, 'nama_ormawa' => 'HMJ Bahasa Inggris', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 13, 'nama_ormawa' => 'UKM Robotika', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 14, 'nama_ormawa' => 'UKM Otomotif', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 15, 'nama_ormawa' => 'UKM Kewirausahaan', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 16, 'nama_ormawa' => 'UKM ELTRAS', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 17, 'nama_ormawa' => 'UKM Assalam', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 18, 'nama_ormawa' => 'UKM PMK', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 19, 'nama_ormawa' => 'UKM KMK', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 20, 'nama_ormawa' => 'UKM Kabayan', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 21, 'nama_ormawa' => 'UKM PSM', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 22, 'nama_ormawa' => 'UKM Musik dan Teater', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 23, 'nama_ormawa' => 'UKM UKBM', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 24, 'nama_ormawa' => 'UKM UBSU', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 25, 'nama_ormawa' => 'UKM USF', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 26, 'nama_ormawa' => 'UKM Basket', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 27, 'nama_ormawa' => 'UKM Voli', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 28, 'nama_ormawa' => 'UKM Bulutangkis', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 29, 'nama_ormawa' => 'UKM Catur', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 30, 'nama_ormawa' => 'UKM Bela Diri', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 31, 'nama_ormawa' => 'UKM PRPG SAGA', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 32, 'nama_ormawa' => 'UKM KSR PMI', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 33, 'nama_ormawa' => 'UKM Pramuka', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 34, 'nama_ormawa' => 'UKM Fellas', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
