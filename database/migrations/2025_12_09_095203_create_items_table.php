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
        Schema::create('kategori', function (Blueprint $table) {
            $table->id();                      
            $table->string('nama_kategori');                      
            $table->timestamps();
        });

        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('no_telp');
            $table->string('nama_barang');
            $table->string('foto_barang')->nullable();
            $table->string('lokasi');
            $table->date('tanggal');
            $table->foreignId('id_kategori')
            ->constrained('kategori')
            ->onDelete('cascade');
            $table->string('deskripsi');
            $table->enum('tipe_laporan', ['Kehilangan Barang', 'Kehilangan Pemilik']);
            $table->enum('status_barang', ['Belum Ditemukan', 'Telah Ditemukan'])->default('Belum Ditemukan');            
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
