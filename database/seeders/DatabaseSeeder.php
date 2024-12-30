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
            BidangKegiatanSeeder::class,  // Seeder untuk tabel 'roles'
            DosenSeeder::class,
            JenisKegiatanSeeder::class,
            MahasiswaSeeder::class,
            OrmawaSeeder::class,
            RolesSeeder::class,
            ReviewerSeeder::class,
            PengajuSeeder::class,
            ProposalKegiatanSeeder::class,
            PedomanKemahasiswaanSeeder::class,
        ]);
    }
}