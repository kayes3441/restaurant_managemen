<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseProduct extends Model
{
    use HasFactory;
    public function purchase_product_type()
    {
        return $this->belongsTo('App\Models\PurchaseProductType');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class,'unit_id');
    }

    public function details()
    {
        return $this->hasMany(Detail::class,'product_id');
    }

}
