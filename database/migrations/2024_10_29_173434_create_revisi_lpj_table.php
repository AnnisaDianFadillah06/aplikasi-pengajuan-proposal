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
        Schema::connection('pgsql')->create('revisi_lpj', function (Blueprint $table) {
            $table->increments('id_revisi');
            $table->text('catatan_revisi')->nullable();
            $table->string('status_revisi', 50);
            $table->timestamp('tgl_revisi')->nullable()->useCurrent();
            $table->integer('id_lpj')->nullable();
            $table->integer('id_dosen')->nullable()->index('revisi_lpj_id_dosen_idx');
            
            $table->foreign('id_lpj')->references('id_lpj')->on('lpj')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('pgsql')->dropIfExists('revisi_file');
    }
};
