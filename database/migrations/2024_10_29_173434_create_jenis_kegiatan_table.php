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
        Schema::connection('pgsql')->create('jenis_kegiatan', function (Blueprint $table) {
            $table->increments('id_jenis_kegiatan');
            $table->string('nama_jenis_kegiatan', 100);
            $table->string('status', 50)->default('aktif'); // Kolom status dengan default 'aktif'
            $table->timestamps(); // Untuk created_at dan updated_at otomatis
            $table->integer('created_by')->nullable(); // Kolom created_by
            $table->integer('updated_by')->nullable(); // Kolom updated_by
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('pgsql')->dropIfExists('jenis_kegiatan');
    }
};
