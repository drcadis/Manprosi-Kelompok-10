<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $fillable = [
        'nama_barang',
        'deskripsi',
        'foto_barang',
        'lokasi',
        'tanggal',
        'tanggal_ditemukan',
        'tipe',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'tanggal_ditemukan' => 'date',
    ];
}