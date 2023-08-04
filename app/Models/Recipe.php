<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    public function rawMaterial(){
        return $this->belongsTo(PurchaseProduct::class,'product_id');
    }
}
