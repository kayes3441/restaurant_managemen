<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    private static $supplier;

    public static function supplier_new($request)
    {
        self::$supplier                             =new Supplier();
        self::$supplier->name                       =$request->name;
        self::$supplier->mobile                     =$request->mobile;
        self::$supplier->address                    =$request->address;
        self::$supplier->initial_balance            =$request->initial_balance;
        self::$supplier->balance_title              =$request->balance_title;
        self::$supplier->save();
        self::$supplier->sl               = count(Supplier::all());
        self::$supplier->status_title     = self::$supplier->status ==1?'Published':'Unpublished';
        return  self::$supplier;

    }
    public static function supplier_update($request)
    {
        self::$supplier                             =Supplier::find($request->id);
        self::$supplier->name                       =$request->name;
        self::$supplier->mobile                     =$request->mobile;
        self::$supplier->address                    =$request->address;
        self::$supplier->initial_balance            =$request->initial_balance;
        self::$supplier->balance_title              =$request->balance_title;
        self::$supplier->save();
        self::$supplier->sl               = count(Supplier::all());
        self::$supplier->status_title     = self::$supplier->status ==1?'Published':'Unpublished';
        return  self::$supplier;
    }
//
    public function purchase()
    {
        return $this->hasMany(Purchase::class,'supplier_id');
    }
    public function payment()
    {
        return $this->hasMany(ReceiveAndPay::class,'client_id');
    }
}
