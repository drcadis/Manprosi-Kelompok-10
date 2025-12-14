<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Items;

class Kategori extends Model
{
    protected $table = 'kategori';
    public function items()
    {
        return $this->hasMany(Items::class);
    }
}
