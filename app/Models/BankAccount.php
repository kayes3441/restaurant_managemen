<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;
//    private static $bank_account;
//    public static function saveBasicInfo($bank_account,$request)
//    {
//        $bank_account->bank_id          =($request->bank_id);
//        $bank_account->account_name     =$request->account_name;
//        $bank_account->account_number   =$request->account_number;
//        $bank_account->contact_number   =$request->contact_number;
//        $bank_account->initial_balance  =$request->initial_balance;
//        $bank_account->balance_title    =$request->balance_title;
//        $bank_account->branch_address   =$request->branch_address;
//        $bank_account->status           =1;
//        $bank_account->save();
//        $bank_account->sl               = count(BankAccount::all());
//        $bank_account->status_title     = $bank_account->status ==1?'Published':'Unpublished';
//        return $bank_account;
//    }
//    public static function bank_account_new($request)
//    {
//        self::$bank_account              =new BankAccount();
//        return BankAccount::saveBasicInfo(self::$bank_account,$request);
//    }
//    public static function bank_account_update($request)
//    {
//        self::$bank_account =BankAccount::find($request->id);
//        BankAccount::saveBasicInfo(self::$bank_account,$request);
//    }
    public function bank()
    {
        return $this->belongsTo(Bank::class,'bank_id');
    }

    public function transactions(){
        return $this->hasMany(BankTransaction::class,'account_id');
    }

}
