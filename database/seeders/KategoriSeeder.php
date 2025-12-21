<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        // DB::table('kategori')->truncate(); 

        $kategori = [
            ['nama_kategori' => 'Elektronik'],
            ['nama_kategori' => 'Dokumen Penting (KTP/KTM/SIM)'],
            ['nama_kategori' => 'Tas & Dompet'],
            ['nama_kategori' => 'Kunci Kendaraan'],
            ['nama_kategori' => 'Pakaian & Aksesoris'],
            ['nama_kategori' => 'Lain-lain'],
        ];

        // Masukkan ke tabel 'kategori'
        DB::table('kategori')->insert($kategori);
    }
}