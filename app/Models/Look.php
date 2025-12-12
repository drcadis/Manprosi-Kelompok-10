<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Look extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $fillable = [
        'nama_barang',
        'foto_barang',
        'lokasi',
        'tanggal',
        'tipe',
    ];
}