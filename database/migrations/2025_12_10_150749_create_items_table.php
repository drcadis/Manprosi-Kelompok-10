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
        // Menyimpan ID user yang memposting barang (opsional, sesuaikan kebutuhan)
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
        $table->string('name'); // Nama Barang
        $table->text('description')->nullable(); // Deskripsi
        $table->string('location')->nullable(); // Lokasi ditemukan/hilang
        $table->date('date_found')->nullable(); // Tanggal ditemukan
        
        // Status barang: misal 'lost', 'found', 'returned'
        $table->enum('status', ['lost', 'found', 'returned'])->default('lost'); 
        
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
