<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    private static $bank;

    public static function bank_new($request)
    {
        self::$bank              =new Bank();
        self::$bank->name        =$request->name;
        self::$bank->code        =$request->code;
        self::$bank->save();
    }
    public static function bank_update($request)
    {
        self::$bank              =Bank::find($request->id);
        self::$bank->name        =$request->name;
        self::$bank->code        =$request->code;
        self::$bank->save();
    }
}
