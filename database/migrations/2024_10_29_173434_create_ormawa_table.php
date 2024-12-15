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
        Schema::connection('pgsql')->create('ormawa', function (Blueprint $table) {
            $table->increments('id_ormawa');
            $table->string('nama_ormawa', 100);
            $table->timestamps(); // Untuk created_at dan updated_at otomatis
            $table->integer('created_by')->nullable(); // Kolom created_by
            $table->integer('updated_by')->nullable(); // Kolom updated_by
            $table->string('status', 50)->default('aktif'); // Kolom status dengan default 'aktif'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('pgsql')->dropIfExists('ormawa');
    }
};