<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaASLISeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection('users')->table('mahasiswa')->insert([
            [
                'username' => 'MPM',
                'email' => 'MPM@polban.ac.id',
                'password' => bcrypt('*Polban2501#')
            ],
            [
                'username' => 'BEM',
                'email' => 'BEM@polban.ac.id',
                'password' => bcrypt('*Polban2502#')
            ],
            [
                'username' => 'HMJ Teknik Sipil',
                'email' => 'HMJTS@polban.ac.id',
                'password' => bcrypt('*Polban2503#')
            ],
            [
                'username' => 'HMJ Teknik Mesin',
                'email' => 'HMJTM@polban.ac.id',
                'password' => bcrypt('*Polban2504#')
            ],
            [
                'username' => 'HMJ Teknik Elektro',
                'email' => 'HMJTE@polban.ac.id',
                'password' => bcrypt('*Polban2505#')
            ],
            [
                'username' => 'HMJ Teknik Kimia',
                'email' => 'HMJTK@polban.ac.id',
                'password' => bcrypt('*Polban2506#')
            ],
            [
                'username' => 'HMJ Teknik Komputer dan Informatika',
                'email' => 'HMJTKI@polban.ac.id',
                'password' => bcrypt('*Polban2507#')
            ],
            [
                'username' => 'HMJ Teknik Refrigerasi dan Tata Udara',
                'email' => 'HMJTRA@polban.ac.id',
                'password' => bcrypt('*Polban2508#')
            ],
            [
                'username' => 'HMJ Teknik Konversi Energi',
                'email' => 'HMJTKE@polban.ac.id',
                'password' => bcrypt('*Polban2509#')
            ],
            [
                'username' => 'HMJ Akuntansi',
                'email' => 'HMJA@polban.ac.id',
                'password' => bcrypt('*Polban2510#')
            ],
            [
                'username' => 'HMJ Administrasi Niaga',
                'email' => 'HMJAN@polban.ac.id',
                'password' => bcrypt('*Polban2511#')
            ],
            [
                'username' => 'HMJ Bahasa Inggris',
                'email' => 'HMJBI@polban.ac.id',
                'password' => bcrypt('*Polban2512#')
            ],
            [
                'username' => 'UKM Robotika',
                'email' => 'UKM-ROBOTIKA@polban.ac.id',
                'password' => bcrypt('*Polban2513#')
            ],
            [
                'username' => 'UKM Otomotif',
                'email' => 'UKM-OTOMOTIF@polban.ac.id',
                'password' => bcrypt('*Polban2514#')
            ],
            [
                'username' => 'UKM Kewirausahaan',
                'email' => 'UKM-VIRUS@polban.ac.id',
                'password' => bcrypt('*Polban2515#')
            ],
            [
                'username' => 'UKM ELTRAS',
                'email' => 'UKM-ELTRAS@polban.ac.id',
                'password' => bcrypt('*Polban2516#')
            ],
            [
                'username' => 'UKM Assalam',
                'email' => 'UKM-ASSALAM@polban.ac.id',
                'password' => bcrypt('*Polban2517#')
            ],
            [
                'username' => 'UKM PMK',
                'email' => 'UKM-PMK@polban.ac.id',
                'password' => bcrypt('*Polban2518#')
            ],
            [
                'username' => 'UKM KMK',
                'email' => 'UKM-KMK@polban.ac.id',
                'password' => bcrypt('*Polban2519#')
            ],
            [
                'username' => 'UKM Kabayan',
                'email' => 'UKM-KABAYAN@polban.ac.id',
                'password' => bcrypt('*Polban2520#')
            ],
            [
                'username' => 'UKM PSM',
                'email' => 'UKM-PSM@polban.ac.id',
                'password' => bcrypt('*Polban2521#')
            ],
            [
                'username' => 'UKM Musik dan Teater',
                'email' => 'UKM-MUSKING@polban.ac.id',
                'password' => bcrypt('*Polban2522#')
            ],
            [
                'username' => 'UKM UKBM',
                'email' => 'UKM-UKBM@polban.ac.id',
                'password' => bcrypt('*Polban2523#')
            ],
            [
                'username' => 'UKM UBSU',
                'email' => 'UKM-UBSU@polban.ac.id',
                'password' => bcrypt('*Polban2524#')
            ],
            [
                'username' => 'UKM Sepakbola & Futsal',
                'email' => 'UKM-USF@polban.ac.id',
                'password' => bcrypt('*Polban2525#')
            ],
            [
                'username' => 'UKM Bola Basket',
                'email' => 'UKM-BASKET@polban.ac.id',
                'password' => bcrypt('*Polban2526#')
            ],
            [
                'username' => 'UKM Bola Voli',
                'email' => 'UKM-VOLLY@polban.ac.id',
                'password' => bcrypt('*Polban2527#')
            ],
            [
                'username' => 'UKM Bulutangkis',
                'email' => 'UKM-BULUTANGKIS@polban.ac.id',
                'password' => bcrypt('*Polban2528#')
            ],
            [
                'username' => 'UKM Catur',
                'email' => 'UKM-CATUR@polban.ac.id',
                'password' => bcrypt('*Polban2529#')
            ],
            [
                'username' => 'UKM Bela Diri',
                'email' => 'UKM-BELADIRI@polban.ac.id',
                'password' => bcrypt('*Polban2530#')
            ],
            [
                'username' => 'UKM SAGA',
                'email' => 'UKM-SAGA@polban.ac.id',
                'password' => bcrypt('*Polban2531#')
            ],
            [
                'username' => 'UKM KSR PMI',
                'email' => 'UKM-KSR@polban.ac.id',
                'password' => bcrypt('*Polban2532#')
            ],
            [
                'username' => 'UKM Pramuka',
                'email' => 'UKM-PRAMUKA@polban.ac.id',
                'password' => bcrypt('*Polban2533#')
            ],
            [
                'username' => 'UKM Fellas',
                'email' => 'UKM-FELLAS@polban.ac.id',
                'password' => bcrypt('*Polban2534#')
            ],
    
        ]);
    }
}
