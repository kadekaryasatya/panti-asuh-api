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
            $table->foreignId('jenis_program_id')->constrained('jenis_programs')->onDelete('cascade')->onUpdate('cascade');
            $table->string('judul');
            $table->string('jadwal');
            $table->text('deskripsi');
            $table->string('gambar_thumbnail');
            $table->string('status')->default('pending');
            $table->string('nama');
            $table->string('email');
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
