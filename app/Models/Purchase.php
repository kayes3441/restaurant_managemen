<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }
    public function BankAccount()
    {
        return $this->belongsTo(BankAccount::class,'bank_account_id');
    }
    public function details()
    {
        return $this->hasMany(Detail::class,'purchase_id');
    }
}
