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
        Schema::create('pengajuan_sewa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // Relasi ke tabel users
            $table->foreignId('kamar_id')->constrained()->onDelete('cascade'); // Relasi ke tabel kamar
            $table->string('nik')->unique();
            $table->string('nama_lengkap');
            $table->text('alamat');
            $table->string('no_hp');
            $table->string('email');
            $table->date('tanggal_mulai');
            $table->date('tanggal_akhir')->nullable();
            $table->string('status')->default('pending'); // pending, disetujui, ditolak
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_sewa');
    }
};
