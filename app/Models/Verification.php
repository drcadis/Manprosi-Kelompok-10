<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Items;

class Verification extends Model
{
    use HasFactory;

    protected $table = 'verifications';

    protected $fillable = [
        'item_id',
        'name',                 // Ganti user_id jadi name
        'phone_number',
        'address',
        'identity_card_image',  // Tambahan foto identitas
        'proof_description',
        'proof_image',
        'status',
        'rejection_reason'
    ];

    // HAPUS fungsi user() karena sudah tidak ada relasi ke tabel users
    // public function user() { ... }

    // Relasi ke Item tetap ada
    public function item()
    {
        return $this->belongsTo(Items::class, 'item_id');
    }
}