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
        Schema::create('t_proposal', function (Blueprint $table) {
            $table->id();
            $table->string('id_proposal','15')->unique();
            $table->string('nama_kegiatan', '50');
            $table->date('tgl_kegiatan');
            $table->date('tgl_pengajuan');
            $table->string('status_proposal', '50');
            $table->string('tmpt_kegiatan', '50');
            $table->string('file_proposal', '70');
            $table->string('kategori_kegiatan', '50');
            $table->string('asal_ormawa', '50');
            $table->integer('id_pengguna', '15');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_proposal');
    }
};
