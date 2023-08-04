<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    public function foodType()
    {
        return $this->belongsTo('App\Models\FoodType');
    }
    public function recipe(){
        return $this->hasMany(Recipe::class,'food_id');
    }
}
