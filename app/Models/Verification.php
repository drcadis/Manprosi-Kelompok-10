<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    use HasFactory;

    protected $table = 'verifications';

    protected $fillable = [
        'user_id',
        'item_id',
        'proof_description',
        'status',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Item (Barang)
    public function item()
    {
        // Asumsi nama model barangmu adalah Item
        return $this->belongsTo(Item::class); 
    }
}