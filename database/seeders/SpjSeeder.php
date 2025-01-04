<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpjSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection('pgsql')->table('spj')->insert([
            [
                'id_proposal' => 3,
                'spj_ke' => 1,
                'file_sptb' => 'laraview/1735966858_Dokumen Proposal.pdf',
                'file_spj' => 'laraview/1735966858_Surat Berkegiatan Ketuplak.pdf',
                'dokumen_berita_acara' => 'laraview/1735966858_Surat Peminjaman Sarpras.pdf',
                'gambar_bukti_spj' => 'laraview/1735966858_Untitled.png',
                'caption_video' => 'video vlog',
                'video_kegiatan' => 'laraview/1735966858_Modern gaming Youtube intro card ‐ Made with Clipchamp.mp4',
                'status' => 0,
                'tgl_upload' => '2025-01-04 05:00:58',
                'updated_by' => 1,
                ]
            
        ]);
    }
}