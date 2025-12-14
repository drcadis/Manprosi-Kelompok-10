<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;

class Items extends Model
{
    use HasFactory;

    protected $table = 'items';
    protected $fillable = [
        'nama',
        'no_telp',
        'nama_barang',
        'foto_barang',
        'lokasi',
        'tanggal',
        'id_kategori',
        'deskripsi',
        'tipe_laporan',
        'status_barang',
    ];
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }


}