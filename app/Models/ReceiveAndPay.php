<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiveAndPay extends Model
{
    use HasFactory;
    public function customer()
    {
        return $this->belongsTo(Customer::class,'client_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'client_id');
    }
    public function BankAccount()
    {
        return $this->belongsTo(BankAccount::class,'bank_account_id');
    }
}
