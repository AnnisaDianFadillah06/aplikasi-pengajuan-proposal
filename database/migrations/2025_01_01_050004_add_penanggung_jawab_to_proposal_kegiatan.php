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
            $table->string('nama_penanggung_jawab', 100)->nullable()->after('sponsorship');
            $table->string('email_penanggung_jawab', 100)->nullable()->after('nama_penanggung_jawab');
            $table->string('no_hp_penanggung_jawab', 15)->nullable()->after('email_penanggung_jawab');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::connection('pgsql')->table('proposal_kegiatan', function (Blueprint $table) {
            $table->dropColumn(['nama_penanggung_jawab', 'email_penanggung_jawab', 'no_hp_penanggung_jawab']);
        });
    }
};
