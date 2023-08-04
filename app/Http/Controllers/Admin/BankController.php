<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\BankAccount;
use Illuminate\Http\Request;

class BankController extends Controller
{

    public function create_bank(Request $request)
    {
        if ($request->ajax())
        {
            Bank::bank_new($request);
            return 'Success';
        }
        else
            return 'Not Success';
    }
    public function manage_bank()
    {
        return view('admin.bank.manage-bank',
            [
                'banks'=>Bank::orderBy('id','desc')->get()
            ]);
    }
    public function update_bank(Request $request)
    {
//        $bank = Bank::find($request->id);
//        return dateFormat($bank->created_at,'Y-m-d H:i:s');
//        $bank = Bank::whereBetween('created_at',[$start,$end])->get();
        if ($request->ajax()){
            Bank::bank_update($request);
            return 'Success';
        }
        return 'Not Success';
    }
    public function delete_bank(Request $request)
    {
       if ($request->ajax())
       {
           $bank_account=BankAccount::where('bank_id',$request->id)->get();
           if (count($bank_account)==0)
           {
               Bank::find($request->id)->delete();
               return 'Success';
           }
           elseif(count($bank_account)!=null) {
               return "Not Success";
           }

       }
    }
}
