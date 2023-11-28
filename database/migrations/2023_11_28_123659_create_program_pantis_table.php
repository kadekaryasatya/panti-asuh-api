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
        Schema::create('program_pantis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jenis_program_id');
            $table->string('judul');
            $table->string('jadwal');
            $table->text('deskripsi');
            $table->string('gambar_thumbnail');

            $table->foreign('jenis_program_id')->references('id')->on('jenis_programs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_pantis');
    }
};
