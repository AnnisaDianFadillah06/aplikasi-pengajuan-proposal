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
        Schema::connection('pgsql')->create('reviewer', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('username', 100);
            $table->string('role', 15);
            $table->string('email', 50);

            // Kolom tambahan
            $table->string('nama_lengkap', 150)->nullable();
            $table->string('foto_profil')->nullable(); // Path file foto
            $table->date('tanggal_bergabung')->nullable(); // Tanggal bergabung ke sistem
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('pgsql')->dropIfExists('reviewer');
    }
};
