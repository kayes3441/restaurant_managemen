<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankTransaction extends Model
{
    use HasFactory;

    public function BankAccount()
    {
        return $this->belongsTo(BankAccount::class,'account_id');
    }
}
