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
            $table->integer('status_lpj')->nullable();
            $table->integer('status_approve_lpj')->nullable();
            $table->integer('status_spj')->default(0); // 0: belum mengajukan, 1: sudah mengajukan, 2: tidak memerlukan
        });

        Schema::connection('pgsql')->create('lpj', function (Blueprint $table) {
            $table->increments('id_lpj');
            $table->unsignedInteger('id_proposal');
            $table->string('file_lpj');
            $table->timestamp('tgl_upload')->nullable()->useCurrent();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->foreign('id_proposal')->references('id_proposal')->on('proposal_kegiatan')->onDelete('cascade');
        });

        Schema::connection('pgsql')->create('spj', function (Blueprint $table) {
            $table->increments('id_spj');
            $table->unsignedInteger('id_proposal');
            $table->string('file_spj');
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
