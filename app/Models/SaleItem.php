<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;

    public function food(){
        return $this->belongsTo(Food::class,'food_id');
    }
    public function recipe(){
        return $this->hasMany(Recipe::class,'food_id');
    }

}
