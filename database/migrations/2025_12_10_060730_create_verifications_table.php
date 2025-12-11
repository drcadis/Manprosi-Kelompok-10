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
    Schema::create('verifications', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // User yang mengklaim
        $table->unsignedBigInteger('item_id'); // Barang yang diklaim
        $table->text('proof_description'); // Deskripsi bukti (misal: "Ada stiker di belakang HP")
        $table->string('status')->default('pending'); // pending, approved, rejected
        $table->timestamps();

        // Foreign keys (Opsional, pastikan tabel users dan items sudah ada)
        // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        // $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
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
