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
        Schema::connection('pgsql')->create('proposal_kegiatan', function (Blueprint $table) {
            $table->increments('id_proposal');
            $table->string('nama_kegiatan', 100);
            // $table->date('tgl_kegiatan');
            $table->string('tmpt_kegiatan');
            $table->string('file_proposal');
            $table->integer('id_jenis_kegiatan')->nullable();
            $table->integer('id_ormawa')->nullable();
            $table->integer('id_pengguna')->nullable()->index('fki_fk_pengguna');
            $table->integer('id_bidang_kegiatan')->nullable();
            $table->string('file_lpj')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('status')->nullable();
            $table->integer('status_kegiatan')->nullable();
            // $table->integer('status_lpj')->nullable();
            // $table->integer('status_approve_lpj')->nullable();
            $table->integer('status_spj')->default(0); // 0: belum mengajukan, 1: sudah mengajukan, 2: tidak memerlukan
            $table->integer('jumlah_spj')->nullable()->default(0); // Jumlah SPJ yang perlu dikumpulkan
            $table->string('link_surat_izin_ortu', 255)->nullable();
            $table->integer('jml_peserta')->nullable()->default(0);
            $table->integer('jml_panitia')->nullable()->default(0);
        });
        
        Schema::connection('pgsql')->create('lpj', function (Blueprint $table) {
            $table->increments('id_lpj');
            $table->unsignedInteger('id_ormawa');
            $table->string('file_lpj');
            $table->string('file_sptb');
            $table->string('file_spj');
            $table->integer('jenis_lpj'); // 1: LPJ 60%, 2: LPJ 100%
            $table->timestamp('tgl_upload')->nullable()->useCurrent();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('status_lpj');
            
            $table->foreign('id_ormawa')->references('id_ormawa')->on('ormawa')->onDelete('cascade');
        });
        
        Schema::connection('pgsql')->create('spj', function (Blueprint $table) {
            $table->increments('id_spj');
            $table->unsignedInteger('id_proposal');
            $table->integer('spj_ke')->nullable();
            $table->string('file_sptb');
            $table->string('file_spj');
            $table->string('dokumen_berita_acara')->nullable(); // Untuk dokumen berita acara
            $table->string('gambar_bukti_spj')->nullable(); // Untuk gambar bukti pemberian SPJ
            $table->string('caption_video')->nullable(); // Untuk caption video
            $table->string('video_kegiatan')->nullable();
            $table->integer('status')->nullable();
            $table->timestamp('tgl_upload')->nullable()->useCurrent();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->foreign('id_proposal')->references('id_proposal')->on('proposal_kegiatan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('pgsql')->dropIfExists('spj');
        Schema::connection('pgsql')->dropIfExists('lpj');
        Schema::connection('pgsql')->dropIfExists('proposal_kegiatan');
    }
};
