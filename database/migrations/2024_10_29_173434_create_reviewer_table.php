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
            $table->increments('id');
            $table->string('username', 100);
            // $table->string('role', 15);
            $table->unsignedBigInteger('id_role'); // Foreign key ke tabel roles
            $table->string('email', 50);
            $table->unsignedBigInteger('id_ormawa'); // Foreign key ke tabel ormawa

            // Kolom tambahan
            $table->string('nama_lengkap', 150)->nullable();
            $table->string('foto_profil')->nullable(); // Path file foto
            $table->date('tanggal_bergabung')->nullable(); // Tanggal bergabung ke sistem
            $table->integer('status')->default(1); // Kolom status, default aktif (1)

            // Foreign key constraint
            $table->foreign('id_role')->references('id_role')->on('roles')->onDelete('cascade');
            $table->foreign('id_ormawa')->references('id_ormawa')->on('ormawa')->onDelete('cascade');
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
