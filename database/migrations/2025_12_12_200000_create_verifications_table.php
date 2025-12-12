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
    Schema::create('verifications', function (Blueprint $table) {
        $table->id();
        
        // 1. Relasi HANYA ke Barang (Item)
        // user_id KITA HAPUS
        $table->foreignId('item_id')->constrained()->onDelete('cascade'); 
        
        // 2. Data Diri Manual (Input Sendiri)
        $table->string('name');             // Nama Lengkap (Baru)
        $table->string('phone_number');     // No HP/WA
        $table->text('address');            // Alamat
        $table->string('identity_card_image'); // Foto KTP/KTM (Wajib untuk validasi)
        
        // 3. Bukti Kepemilikan
        $table->text('proof_description');  // Deskripsi ciri unik
        $table->string('proof_image');      // Foto bukti barang
        
        // 4. Status
        $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        $table->string('rejection_reason')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifications');
    }
};
