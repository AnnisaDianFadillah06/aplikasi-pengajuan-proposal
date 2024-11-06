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
        Schema::connection('pgsql')->create('revisi_file', function (Blueprint $table) {
            $table->increments('id_revisi');
            $table->text('catatan_revisi');
            $table->string('status_revisi', 50);
            $table->timestamp('tgl_revisi')->nullable()->useCurrent();
            $table->integer('id_proposal')->nullable();
            $table->integer('id_dosen')->nullable()->index('fki_fk_reviewer/dosen');
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
