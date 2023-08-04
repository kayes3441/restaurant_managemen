<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function receiveAmount()
    {
        return $this->hasMany(ReceiveAndPay::class,'client_id');
    }
    public function sale()
    {
        return $this->hasMany(Sale::class,'customer_id');
    }

}
