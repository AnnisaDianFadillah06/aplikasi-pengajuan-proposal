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
        Schema::connection('pgsql')->create('pengguna', function (Blueprint $table) {
            $table->increments('id_pengguna');
            $table->string('nama_pengguna', 100);
            $table->string('email', 100)->unique('pengguna_email_key');
            $table->string('password');
            $table->integer('id_role')->nullable();
            $table->integer('id_mhs')->nullable();
            $table->integer('id_dosen')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('pgsql')->dropIfExists('pengguna');
    }
};
