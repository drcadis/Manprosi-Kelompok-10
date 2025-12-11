<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // Jika nama tabel Anda BUKAN 'items', hapus komentar di bawah dan sesuaikan:
    // protected $table = 'nama_tabel_anda';

    // Izinkan semua kolom untuk diisi/diupdate
    protected $guarded = [];
}