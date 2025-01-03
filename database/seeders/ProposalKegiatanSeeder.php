<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProposalKegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection('pgsql')->table('proposal_kegiatan')->insert([
            [
                'nama_kegiatan' => 'Seminar Laravel',
                'tanggal_mulai' => '2024-12-01',
                'tmpt_kegiatan' => 'Jakarta',
                'file_proposal' => 'laraview/proposal_laravel.pdf',
                'id_jenis_kegiatan' => 1,
                'id_ormawa' => 2,
                'id_pengguna' => 1,
                'id_bidang_kegiatan' => 2,
                'file_lpj' => '',
                'updated_by' => 2,
                'status' => 1,    
                'status_kegiatan' => 1,  
            ],
            [
                'nama_kegiatan' => 'Seminar PostgreSQL',
                'tanggal_mulai' => '2024-12-02',
                'tmpt_kegiatan' => 'Bandung',
                'file_proposal' => 'laraview/proposal_postgresql.pdf',
                'id_jenis_kegiatan' => 2,
                'id_ormawa' => 2,
                'id_pengguna' => 2,
                'id_bidang_kegiatan' => 2,
                'file_lpj' => '',
                'updated_by' => 3,
                'status' => 1,
                'status_kegiatan' => 2,  
            ]
            
        ]);
    }
}