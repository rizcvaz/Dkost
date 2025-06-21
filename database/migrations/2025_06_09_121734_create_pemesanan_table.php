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
        Schema::create('pemesanan', function (Blueprint $table) {
    $table->id();
    $table->foreignId('kamar_id')->constrained('kamar')->onDelete('cascade');
    $table->unsignedBigInteger('user_id')->after('id');
    $table->string('nik')->unique();
    $table->string('nama_lengkap');
    $table->text('alamat');
    $table->string('no_hp');
    $table->string('email');
    $table->string('status')->default('pending'); // pending, dibayar, gagal
    $table->string('order_id')->nullable();       // order ID dari Midtrans
    $table->integer('jumlah_tagihan');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};
