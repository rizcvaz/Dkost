<?php

// database/migrations/xxxx_xx_xx_create_kamar_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('kamar', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_kamar');
            $table->text('fasilitas');
            $table->string('lantai');
            $table->string('ukuran_kamar');
            $table->decimal('harga', 10, 2);
            $table->enum('status', ['Tersedia', 'Terisi'])->default('Tersedia');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('kamar');
    }
};

