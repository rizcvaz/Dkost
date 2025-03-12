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
    Schema::create('penghunis', function (Blueprint $table) {
        $table->id();
        $table->string('nama'); // Nama penghuni
        $table->string('nik');  // NIK penghuni
        $table->string('alamat'); // Alamat penghuni
        $table->string('no_hp'); // Nomor HP penghuni
        $table->string('email')->unique(); // Email penghuni
        $table->foreignId('kamar_id')->constrained()->onDelete('cascade'); // Relasi ke kamar
        $table->enum('status', ['aktif', 'non-aktif']); // Status penghuni
        $table->timestamps();
    });
}

};
