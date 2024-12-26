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
        Schema::connection('pgsql')->create('roles', function (Blueprint $table) {
            $table->id('id_role'); // Primary key
            $table->string('role', 50)->unique(); // Nama role harus unik
            $table->timestamps(); // Timestamps untuk mencatat waktu pembuatan dan perubahan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('pgsql')->dropIfExists('roles');
    }
};

