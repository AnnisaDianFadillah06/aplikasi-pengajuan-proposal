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
            ],
            [
                'nama_kegiatan' => 'Dies Natalis',
                'tmpt_kegiatan' => 'rsg gd jtk',
                'file_proposal' => 'laraview/1735965998_Dokumen Proposal.pdf',
                'id_jenis_kegiatan' => 1,
                'id_ormawa' => 9,
                'id_pengguna' => 6,
                'id_bidang_kegiatan' => 1,
                'file_lpj' => '',
                'updated_by' => 1,
                'status' => 0,
                'status_kegiatan' => '',
                'jumlah_spj' => 2,
                'surat_berkegiatan_ketuplak' =>'laraview/1735965998_Surat Berkegiatan Ketuplak.pdf',
                'surat_pernyataan_ormawa' => 'laraview/1735965998_Surat Pernyataan Ormawa.pdf',
                'surat_peminjaman_sarpras' => 'laraview/1735965998_Surat Peminjaman Sarpras.pdf',
                'tanggal_mulai' => '2024-12-02',
                'tanggal_akhir' => '2024-12-02',
                'dana_dipa' => 100000.00,
                'dana_swadaya' => 150000.00,
                'dana_sponsor' => 200000.00,
                'pengisi_acara' => 'Keenan Inara',
                'sponsorship' => 'Daya',
                'nama_penanggung_jawab' => 'harish',
                'email_penanggun_jawab' => 'muhammad.harish.tif23@polban.ac.id',
                'poster_kegiatan' => 'laraview/1735965998_Untitled.png',
                'caption_poster' => 'ini adalah caption poster semangat!'
                ]
            
        ]);
    }
}