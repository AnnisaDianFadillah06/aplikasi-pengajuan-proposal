<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrmawaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        $now = Carbon::now();
        DB::connection('pgsql')->table('ormawa')->insert([
            ['id_ormawa' => 0, 'nama_ormawa' => 'NON', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 1, 'nama_ormawa' => 'MPM', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 2, 'nama_ormawa' => 'BEM', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 3, 'nama_ormawa' => 'HMM', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 4, 'nama_ormawa' => 'HME', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 5, 'nama_ormawa' => 'HML', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 6, 'nama_ormawa' => 'HIMATEL', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 7, 'nama_ormawa' => 'HMTE', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 8, 'nama_ormawa' => 'HMJTK', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 9, 'nama_ormawa' => 'HIMAKOM', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 10, 'nama_ormawa' => 'HIMAS', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 11, 'nama_ormawa' => 'HMRA', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 12, 'nama_ormawa' => 'HMAK', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 13, 'nama_ormawa' => 'HIMAKAPS', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 14, 'nama_ormawa' => 'HMAN', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 15, 'nama_ormawa' => 'HIMARIS', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 16, 'nama_ormawa' => 'IMT-Aero', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 17, 'nama_ormawa' => 'UKM Robotika', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 18, 'nama_ormawa' => 'UKM Otomotif', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 19, 'nama_ormawa' => 'UKM Kewirausahaan', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 20, 'nama_ormawa' => 'UKM ELTRAS', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 21, 'nama_ormawa' => 'UKM Assalam', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 22, 'nama_ormawa' => 'UKM PMK', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 23, 'nama_ormawa' => 'UKM KMK', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 24, 'nama_ormawa' => 'UKM Kabayan', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 25, 'nama_ormawa' => 'UKM PSM', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 26, 'nama_ormawa' => 'UKM Musik Kingdom', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 27, 'nama_ormawa' => 'UKM KSR', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 28, 'nama_ormawa' => 'UKM Fellas', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 29, 'nama_ormawa' => 'UKM UKBM', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 30, 'nama_ormawa' => 'UKM UBSU', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 31, 'nama_ormawa' => 'UKM USF', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 32, 'nama_ormawa' => 'UKM Basket', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 33, 'nama_ormawa' => 'UKM Voli', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 34, 'nama_ormawa' => 'UKM Bulu Tangkis', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 35, 'nama_ormawa' => 'UKM Tenis Meja', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 36, 'nama_ormawa' => 'UKM Catur', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 37, 'nama_ormawa' => 'UKM Bela Diri', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 38, 'nama_ormawa' => 'UKM PRPG SAGA', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 39, 'nama_ormawa' => 'UKM Pramuka', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
            ['id_ormawa' => 40, 'nama_ormawa' => 'UKM Flag football', 'status' => 'aktif', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
