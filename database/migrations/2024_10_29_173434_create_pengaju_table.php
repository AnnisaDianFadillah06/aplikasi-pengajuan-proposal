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
        Schema::connection('pgsql')->create('pengaju', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 100);
            $table->string('email', 50);

            // Kolom tambahan
            $table->string('foto_profil')->nullable(); // Path file foto
            $table->date('tanggal_bergabung')->nullable(); // Tanggal bergabung ke sistem
            $table->unsignedBigInteger('id_ormawa'); // Foreign key ke tabel ormawa
            $table->integer('status')->default(1); // Kolom status, default aktif (1)

            // foreign key ke tabel ormawa
            $table->foreign('id_ormawa')->references('id_ormawa')->on('ormawa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('pgsql')->dropIfExists('pengaju');
    }
};