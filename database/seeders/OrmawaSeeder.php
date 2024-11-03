<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrmawaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection('pgsql')->table('ormawa')->insert([
            ['id_ormawa' => 1, 'nama_ormawa' => 'MPM'],
            ['id_ormawa' => 2, 'nama_ormawa' => 'BEM'],
            ['id_ormawa' => 3, 'nama_ormawa' => 'HMM'],
            ['id_ormawa' => 4, 'nama_ormawa' => 'HME'],
            ['id_ormawa' => 5, 'nama_ormawa' => 'HML'],
            ['id_ormawa' => 6, 'nama_ormawa' => 'HIMATEL'],
            ['id_ormawa' => 7, 'nama_ormawa' => 'HMTE'],
            ['id_ormawa' => 8, 'nama_ormawa' => 'HMJTK'],
            ['id_ormawa' => 9, 'nama_ormawa' => 'HIMAKOM'],
            ['id_ormawa' => 10, 'nama_ormawa' => 'HIMAS'],
            ['id_ormawa' => 11, 'nama_ormawa' => 'HMRA'],
            ['id_ormawa' => 12, 'nama_ormawa' => 'HMAK'],
            ['id_ormawa' => 13, 'nama_ormawa' => 'HIMAKAPS'],
            ['id_ormawa' => 14, 'nama_ormawa' => 'HMAN'],
            ['id_ormawa' => 15, 'nama_ormawa' => 'HIMARIS'],
            ['id_ormawa' => 16, 'nama_ormawa' => 'IMT-Aero'],
            ['id_ormawa' => 17, 'nama_ormawa' => 'UKM Robotika'],
            ['id_ormawa' => 18, 'nama_ormawa' => 'UKM Otomotif'],
            ['id_ormawa' => 19, 'nama_ormawa' => 'UKM Kewirausahaan'],
            ['id_ormawa' => 20, 'nama_ormawa' => 'UKM ELTRAS'],
            ['id_ormawa' => 21, 'nama_ormawa' => 'UKM Assalam'],
            ['id_ormawa' => 22, 'nama_ormawa' => 'UKM PMK'],
            ['id_ormawa' => 23, 'nama_ormawa' => 'UKM KMK'],
            ['id_ormawa' => 24, 'nama_ormawa' => 'UKM Kabayan'],
            ['id_ormawa' => 25, 'nama_ormawa' => 'UKM PSM'],
            ['id_ormawa' => 26, 'nama_ormawa' => 'UKM Musik Kingdom'],
            ['id_ormawa' => 27, 'nama_ormawa' => 'UKM KSR'],
            ['id_ormawa' => 28, 'nama_ormawa' => 'UKM Fellas'],
            ['id_ormawa' => 29, 'nama_ormawa' => 'UKM UKBM'],
            ['id_ormawa' => 30, 'nama_ormawa' => 'UKM UBSU'],
            ['id_ormawa' => 31, 'nama_ormawa' => 'UKM USF'],
            ['id_ormawa' => 32, 'nama_ormawa' => 'UKM Basket'],
            ['id_ormawa' => 33, 'nama_ormawa' => 'UKM Voli'],
            ['id_ormawa' => 34, 'nama_ormawa' => 'UKM Bulu Tangkis'],
            ['id_ormawa' => 35, 'nama_ormawa' => 'UKM Tenis Meja'],
            ['id_ormawa' => 36, 'nama_ormawa' => 'UKM Catur'],
            ['id_ormawa' => 37, 'nama_ormawa' => 'UKM Bela Diri'],
            ['id_ormawa' => 38, 'nama_ormawa' => 'UKM PRPG SAGA'],
            ['id_ormawa' => 39, 'nama_ormawa' => 'UKM Pramuka'],
            ['id_ormawa' => 40, 'nama_ormawa' => 'UKM Flag football'],
        ]);
    }
}
