<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection('pgsql')->table('proposal_kegiatan', function (Blueprint $table) {
            $table->foreign(['id_jenis_kegiatan'], 'fk_jenis_kegiatan')->references(['id_jenis_kegiatan'])->on('jenis_kegiatan')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['id_ormawa'], 'fk_ormawa')->references(['id_ormawa'])->on('ormawa')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['id_pengguna'], 'fk_pengguna')->references(['id'])->on('pengaju')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_bidang_kegiatan'], 'fk_bidang_kegiatan')->references(['id'])->on('bidang_kegiatan')->onUpdate('no action')->onDelete('cascade'); // Aturan ketika bidang kegiatan dihapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('pgsql')->table('proposal_kegiatan', function (Blueprint $table) {
            $table->dropForeign('fk_jenis_kegiatan');
            $table->dropForeign('fk_ormawa');
            $table->dropForeign('fk_pengguna');
            $table->dropForeign('fk_bidang_kegiatan');
        });
    }
};
