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
        Schema::create('penghunis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kamar_id');
            $table->string('nik');
            $table->string('nama_lengkap');
            $table->text('alamat');
            $table->string('no_hp');
            $table->string('email');
            $table->string('status')->default('Aktif');
            $table->timestamps();

    $table->foreign('kamar_id')->references('id')->on('kamar')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penghunis');
    }
};
