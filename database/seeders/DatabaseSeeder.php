<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil seeder lain di sini
        $this->call([
            OrmawaASLISeeder::class,
            PengajuASLISeeder::class,
            MahasiswaASLISeeder::class,

            BidangKegiatanSeeder::class,
            JenisKegiatanSeeder::class,
            RolesSeeder::class,
            
            DosenSeeder::class,
            ReviewerSeeder::class,
            
            // MahasiswaSeeder::class,
            // PengajuSeeder::class,
            // OrmawaSeeder::class,
            // ProposalKegiatanSeeder::class,
            // PedomanKemahasiswaanSeeder::class,
            // SpjSeeder::class,
        ]);
    }
}