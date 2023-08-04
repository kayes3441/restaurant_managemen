<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\BankTransaction;
use Illuminate\Http\Request;

class BankTransactionController extends Controller
{
    public function page()
    {
        return view('admin.bankTransaction.add');
    }
    public function bankAccount()
    {
        $bankAccount=BankAccount::all();
        return $bankAccount;
    }

    public function create(Request $request)
    {
//        return $request->all();

        //withdraw ==debit
        $validator=$request->validate([
            'account_id' => 'required',
            'type' => 'required',
            'amount' => 'required|numeric',
        ]);

        $transaction                =new BankTransaction();
        $transaction->account_id    =$request->account_id;
        $transaction->type          =$request->type;
        $transaction->amount        =$request->amount;
        $transaction->note          =$request->note;
        $transaction->input_date    =$request->input_date;
        $transaction->save();
        return 'success';
    }
}
