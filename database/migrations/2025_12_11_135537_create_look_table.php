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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->text('deskripsi')->nullable();
            $table->string('foto_barang')->nullable();
            $table->string('lokasi');
            $table->date('tanggal');
            $table->date('tanggal_ditemukan')->nullable();
            $table->enum('tipe', ['kehilangan', 'temuan'])->default('kehilangan');
            $table->enum('status', ['hilang', 'ditemukan', 'diklaim'])->default('hilang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
