<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\BankTransaction;
use App\Models\Purchase;
use App\Models\ReceiveAndPay;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{

    public function create_bank_account(Request $request)
    {
        $validator=$request->validate([
            'bank_id' => 'required',
            'account_name' => 'required',
            'account_number' => 'required',
            'contact_number' => 'required|numeric',
            'branch_address' => 'required',
            'initial_balance' => 'required|numeric',
        ]);
        $bank_account                   = new BankAccount();
        $bank_account->bank_id          = $request->bank_id;
        $bank_account->account_name     = $request->account_name;
        $bank_account->account_number   = $request->account_number;
        $bank_account->contact_number   = $request->contact_number;
        $bank_account->initial_balance  = $request->initial_balance;
        $bank_account->balance_title    = $request->balance_title;
        $bank_account->branch_address   = $request->branch_address;
        $bank_account->status           =1;
        $bank_account->save();
        $newAccount=BankAccount::with('bank')->find($bank_account->id);
        $newAccount->sl               = count(BankAccount::all());
        $newAccount->status_title     = $bank_account->status ==1?'Published':'Unpublished';
        return response()->json([
            'account'=>$newAccount,
            'process'=>'add'
        ]);


    }
    public function manage_bank_account()
    {

        return view('admin.bank-account.manage-bank-account',
            [
                'bank_accounts'=>BankAccount::orderBy('id','desc')->get(),
                'banks'=>Bank::all()
            ]);
    }
    public function update_bank_account(Request $request)
    {
        $validator=$request->validate([
            'bank_id' => 'required',
            'account_name' => 'required',
            'account_number' => 'required',
            'contact_number' => 'required|numeric',
            'branch_address' => 'required',
            'initial_balance' => 'required|numeric',
        ]);
        $bank_account                   = BankAccount::find($request->id);
        $bank_account->bank_id          = $request->bank_id;
        $bank_account->account_name     = $request->account_name;
        $bank_account->account_number   = $request->account_number;
        $bank_account->contact_number   = $request->contact_number;
        $bank_account->initial_balance  = $request->initial_balance;
        $bank_account->balance_title    = $request->balance_title;
        $bank_account->branch_address   = $request->branch_address;
        $bank_account->save();
        $editAccount=BankAccount::with('bank')->find($request->id);
        $editAccount->sl               = $request->sl;
        $editAccount->status_title     = $editAccount->status ==1?'Published':'Unpublished';
        return response()->json([
            'editAccount'=>$editAccount,
            'process'=>'edit'
        ]);
    }
    public function delete_bank_account(Request $request)
    {
//        if ($request->ajax())
//        {
//            BankAccount::find($request->id)->delete();
//            return 'Success';
//        }
//        else
//            return 'Not Success';

        if ($request->ajax()){
            $purchase=Purchase::where('payment_media','Bank')->where('bank_account_id',$request->id)->get();
            $receive=ReceiveAndPay::where('payment_media','Bank')->where('bank_account_id',$request->id)->get();
            $transaction=BankTransaction::where('account_id',$request->id)->get();
            if(count($purchase) ==0 or count($receive)==0 or count($transaction)==0)
            {
                BankAccount::find($request->id)->delete();
                return response()->json([
                    'status'=>'success',
                    'sl'=>$request->sl,
                ]);
            }
            elseif(count($purchase)!=null and count($receive)!=null and count($transaction)!=null) {
                return "Not Success";
            }
        }
    }
    public function details($id)
    {
        $purchase_withdrawal=Purchase::where('payment_media','=','Bank')->where('bank_account_id',$id)->with('BankAccount')->orderBy('id','asc')->get();
        $receive_deposit    =ReceiveAndPay::where('client_type','Customer')->where('payment_media','Bank')->where('bank_account_id',$id)->with('BankAccount')->orderBy('id','asc')->get();
        $payment_withdrawal =ReceiveAndPay::where('client_type','Supplier')->where('payment_media','Bank')->where('bank_account_id',$id)->with('BankAccount')->orderBy('id','asc')->get();
        $deposit            =BankTransaction::where('type','Deposit')->where('account_id',$id)->with('BankAccount')->orderBy('id','asc')->get();
        $withdrawal         =BankTransaction::where('type','Withdrawal')->where('account_id',$id)->with('BankAccount')->orderBy('id','asc')->get();

        $result= [];
//            'purchase_withdrawal'   =>$purchase_withdrawal,
        foreach ($purchase_withdrawal as $value)
        {
            $item = [
                'id'=>$value->id,
                'type'=>'Purchase',
                'category'=>'Withdrawal',
                'date'=>dateFormat($value->created_at,'Y-m-d'),
                'amount'=>$value->pay_amount,
            ];
            $result["$value->created_at"] = $item;
        }
        foreach ($receive_deposit as $value)
        {
            $item = [
                'id'=>$value->id,
                'type'=>'Receive',
                'category'=>'Deposit',
                'date'          =>dateFormat($value->created_at,'Y-m-d'),
                'amount'        =>$value->amount,
            ];
            $result["$value->created_at"] = $item;
        }
        foreach ($payment_withdrawal as $value)
        {
            $item = [
                'id'=>$value->id,
                'type'=>'Payment',
                'category'=>'Withdrawal',
                'date'          =>dateFormat($value->created_at,'Y-m-d'),
                'amount'        =>$value->amount,
            ];
            $result["$value->created_at"] = $item;
        }
        foreach ($deposit as $value)
        {
            $item = [
                'id'=>$value->id,
                'type'=>'Deposit',
                'category'=>'Deposit',
                'date'          =>dateFormat($value->created_at,'Y-m-d'),
                'amount'        =>$value->amount,

            ];
            $result["$value->created_at"] = $item;
        }
        foreach ($withdrawal as $value)
        {
            $item = [
                'id'=>$value->id,
                'type'=>'Withdrawal',
                'category'=>'Withdrawal',
                'date'          =>dateFormat($value->created_at,'Y-m-d'),
                'amount'        =>$value->amount,

            ];
            $result["$value->created_at"] = $item;
        }
        //return $result;
        return view('admin.bank-account.bank_detail',
        [
            'details'=>$result,
            'account'=>BankAccount::find($id),
        ]);
    }
}
