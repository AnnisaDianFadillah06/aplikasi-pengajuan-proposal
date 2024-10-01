<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proposal;

class ProposalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menambahkan data dummy ke tabel t_proposal
        Proposal::create([
            'id_proposal' => 'P001',
            'nama_kegiatan' => 'Seminar Laravel',
            'tgl_kegiatan' => '2024-12-01',
            'tgl_pengajuan' => '2024-09-20',
            'status_proposal' => 'Disetujui',
            'tmpt_kegiatan' => 'Jakarta',
            'file_proposal' => 'proposal_laravel.pdf',
            'kategori_kegiatan' => 'Seminar',
            'asal_ormawa' => 'Himpunan Mahasiswa TI',
            'id_pengguna' => 1
        ]);

        Proposal::create([
            'id_proposal' => 'P002',
            'nama_kegiatan' => 'Workshop PHP',
            'tgl_kegiatan' => '2024-11-15',
            'tgl_pengajuan' => '2024-09-18',
            'status_proposal' => 'Menunggu',
            'tmpt_kegiatan' => 'Bandung',
            'file_proposal' => 'proposal_php.pdf',
            'kategori_kegiatan' => 'Workshop',
            'asal_ormawa' => 'UKM IT',
            'id_pengguna' => 2
        ]);
    }
}
