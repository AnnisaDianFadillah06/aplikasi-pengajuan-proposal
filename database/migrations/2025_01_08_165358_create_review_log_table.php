<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql')->create('review_log', function (Blueprint $table) {
            $table->id('id_review_log'); // Primary key
            $table->unsignedBigInteger('id_proposal'); // Foreign key ke proposal_kegiatan
            $table->unsignedBigInteger('id_reviewer'); // Foreign key ke reviewer
            $table->enum('review_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamp('review_date')->nullable(); // Tanggal review dilakukan
            $table->date('deadline_review'); // Batas waktu review
            $table->text('review_notes')->nullable(); // Catatan dari reviewer
            $table->timestamps(); // created_at dan updated_at

            // Foreign key constraints
            $table->foreign('id_proposal')->references('id_proposal')->on('proposal_kegiatan')->onDelete('cascade');
            $table->foreign('id_reviewer')->references('id')->on('reviewer')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review_log');
    }
}
