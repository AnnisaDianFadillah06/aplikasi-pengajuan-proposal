<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection('users')->table('dosen')->insert([
            [
                'username' => 'prita', 
                'email' => 'prita@polban.ac.id', 
                'password' => bcrypt('linakscore')
            ],
            [
                'username' => 'idoy', 
                'email' => 'idoy@polban.ac.id', 
                'password' => bcrypt('linakscore')
            ],
            [
                'username' => 'hikmah', 
                'email' => 'hikmah@polban.ac.id', 
                'password' => bcrypt('linakscore')
            ],
            [
                'username' => 'komli', 
                'email' => 'komli@polban.ac.id', 
                'password' => bcrypt('linakscore')
            ],
            [
                'username' => 'toni', 
                'email' => 'toni@polban.ac.id', 
                'password' => bcrypt('linakscore')
            ],

            // akun real kajur
            [
                'username' => 'luthfi', 
                'email' => 'luthfi-mm@polban.ac.id', 
                'password' => bcrypt('*Polban1101')
            ],
            [
                'username' => 'amaldi', 
                'email' => 'amaldi@polban.ac.id', 
                'password' => bcrypt('*Polban1102')
            ],
            [
                'username' => 'akangarman', 
                'email' => 'akangarman@polban.ac.id', 
                'password' => bcrypt('*Polban1103')
            ],
            [
                'username' => 'wahyumursanto', 
                'email' => 'wahyu.mursanto@polban.ac.id', 
                'password' => bcrypt('*Polban1104')
            ],
            [
                'username' => 'hepiludiyati', 
                'email' => 'hepi.ludiyati@polban.ac.id', 
                'password' => bcrypt('*Polban1105')
            ],
            [
                'username' => 'shoeryashoelarta', 
                'email' => 'shoerya.shoelarta@polban.ac.id', 
                'password' => bcrypt('*Polban1106')
            ],
            [
                'username' => 'yadhi', 
                'email' => 'yadhi@polban.ac.id', 
                'password' => bcrypt('*Polban1107')
            ],
            [
                'username' => 'iwansetiawan', 
                'email' => 'iwan.setiawan@polban.ac.id', 
                'password' => bcrypt('*Polban1108')
            ],
            [
                'username' => 'rivansutrisno', 
                'email' => 'rivan.sutrisno@polban.ac.id', 
                'password' => bcrypt('*Polban1109')
            ],
            [
                'username' => 'linameilinda', 
                'email' => 'lina.meilinda@polban.ac.id', 
                'password' => bcrypt('*Polban1110')
            ],

            // Akun KLI
            [
                'username' => 'kli', 
                'email' => 'KLI@polban.ac.id', 
                'password' => bcrypt('*Polban1111')
            ],

            // Akun Wadir3
            [
                'username' => 'wadir3', 
                'email' => 'wadir3@polban.ac.id', 
                'password' => bcrypt('*Polban1112')
            ],
            [
                'username' => 'publikasikemahasiswaan', 
                'email' => 'publikasikemahasiswaan@polban.ac.id', 
                'password' => bcrypt('*Polban1113')
            ],
            
        ]);
    }
}
