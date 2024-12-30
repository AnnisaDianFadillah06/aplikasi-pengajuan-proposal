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
            $table->string('surat_kesediaan_pendampingan')->nullable();
            $table->string('surat_peminjaman_sarpras')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_akhir')->nullable();
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
        });
    }
    
};
