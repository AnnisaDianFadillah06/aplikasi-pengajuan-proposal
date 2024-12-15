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
        Schema::connection('pgsql')->create('proposal_tokens', function (Blueprint $table) {
            $table->id(); // ID auto-increment
            $table->unsignedBigInteger('proposal_id'); // ID proposal yang terkait
            $table->string('token', 64)->unique(); // Token unik
            $table->timestamps(); // created_at, updated_at

            // Menambahkan foreign key untuk proposal_id
            $table->foreign('proposal_id')
                  ->references('id_proposal')->on('proposal_kegiatan')
                  ->onDelete('cascade'); // Jika proposal dihapus, token juga dihapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('pgsql')->dropIfExists('proposal_tokens');
    }
};
