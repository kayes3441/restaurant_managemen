<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Customer;
use App\Models\ReceiveAndPay;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ReceiveAndPayController extends Controller
{
    public function receiveAndPayPage()
    {
        return view('admin.receiveAndPay.add');
    }
    public function customerId()
    {
        return Customer::all();
    }
    public function supplierId()
    {
        return Supplier::all();
    }
    public function getCustomerId(Request $request)
    {

        if ($request->ajax()){
            $customerId=Customer::find($request->id);
            $balance = customerBalanceCal($request->id);
            $customerId->result = $balance;
            return $customerId;
        }
    }
    public function getSupplierId(Request $request)
    {

        if ($request->ajax()){
            $supplierId=Supplier::find($request->id);
            $payable_balance=supplierBalanceCal($request->id);
            $supplierId->result = $payable_balance;
            return $supplierId;
        }
    }

    public function getBankAccount()
    {
        return BankAccount::all();
    }

    public function create(Request $request)
    {
        $validator=$request->validate([
            'client_type' => 'required',
            'client_id' => 'required',
            'amount' => 'required|numeric',
        ]);
        if ($request->payment_media=="Bank")
        {
            $validator=$request->validate([
                'bank_account_id' => 'required',
            ]);
        }
        $receive_pay=new ReceiveAndPay();
        $receive_pay->client_type       =$request->client_type;
        $receive_pay->client_id         =$request->client_id;
        $receive_pay->past_balance      =$request->past_balance;
        $receive_pay->balance_title     =$request->balance_title;
        $receive_pay->amount            =$request->amount;
        $receive_pay->payment_media     =$request->payment_media;
        $receive_pay->bank_account_id   =$request->bank_account_id;
        $receive_pay->discount          =$request->discount;
        $receive_pay->new_balance       =$request->new_balance;
        $receive_pay->new_balance_title =$request->new_balance_title;
        $receive_pay->save();
        return 'success';
    }


}
