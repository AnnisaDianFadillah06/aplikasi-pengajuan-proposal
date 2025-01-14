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
        Schema::connection('pgsql')->table('revisi_file', function (Blueprint $table) {
            $table->foreign(['id_proposal'], 'fk_proposal')->references(['id_proposal'])->on('proposal_kegiatan')->onUpdate('no action')->onDelete('cascade');
            // $table->foreign(['id_dosen'], 'fk_reviewer/dosen')->references(['id'])->on('reviewer')->onUpdate('no action')->onDelete('no action');
            $table->foreign('id_dosen')->references('id_role')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('pgsql')->table('revisi_file', function (Blueprint $table) {
            $table->dropForeign('fk_proposal');
            $table->dropForeign('fk_reviewer/dosen');
        });
    }
};
