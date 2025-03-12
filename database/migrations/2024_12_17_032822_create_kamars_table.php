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
        Schema::create('kamars', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_kamar');      // Kolom nomor kamar
            $table->string('fasilitas');        // Kolom fasilitas
            $table->integer('lantai');          // Kolom lantai
            $table->string('ukuran_kamar');     // Kolom ukuran kamar
            $table->integer('harga');           // Kolom harga
            $table->string('status');           // Kolom status (misalnya: kosong, terisi)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};
