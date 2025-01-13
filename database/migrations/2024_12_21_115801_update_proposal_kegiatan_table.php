<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::connection('pgsql')->table('proposal_kegiatan', function (Blueprint $table) {
            $table->string('surat_berkegiatan_ketuplak')->nullable();
            $table->string('surat_pernyataan_ormawa')->nullable();
            $table->string('surat_peminjaman_sarpras')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_akhir')->nullable();
            $table->decimal('dana_dipa', 15, 2)->nullable()->default(0)->after('jml_panitia'); // Dana DIPA Polban
            $table->decimal('dana_swadaya', 15, 2)->nullable()->default(0)->after('dana_dipa'); // Dana Swadaya
            $table->decimal('dana_sponsor', 15, 2)->nullable()->default(0)->after('dana_swadaya'); // Dana Sponsor
            $table->string('pengisi_acara', 255)->nullable()->after('dana_sponsor'); // Pengisi Acara/Narasumber/Juri
            $table->string('sponsorship', 255)->nullable()->after('pengisi_acara'); // Sponsorship
            $table->string('media_partner', 255)->nullable()->after('sponsorship'); // Media Partner
            $table->string('qr_code_path', 255)->nullable(); 
            $table->string('proposal_url_path', 255)->nullable();
        });
    }
    
    public function down()
    {
        Schema::connection('pgsql')->table('proposal_kegiatan', function (Blueprint $table) {
            $table->dropColumn('surat_berkegiatan_ketuplak');
            $table->dropColumn('surat_pernyataan_ormawa');
            $table->dropColumn('surat_kesediaan_pendampingan');
            $table->dropColumn('surat_peminjaman_sarpras');
            $table->dropColumn('tanggal_mulai');
            $table->dropColumn('tanggal_akhir');
            $table->dropColumn('dana_dipa');
            $table->dropColumn('dana_swadaya');
            $table->dropColumn('dana_sponsor');
            $table->dropColumn('pengisi_acara');
            $table->dropColumn('sponsorship');
            $table->dropColumn('media_partner');
        });
    }
    
};
