<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\BankTransaction;
use App\Models\Purchase;
use App\Models\ReceiveAndPay;
use Illuminate\Http\Request;
use mysql_xdevapi\Result;

class BankReportController extends Controller
{
    public function page()
    {
        $start_date=date('Y-m-d');
        return view('admin.report.bank.bank_report_page',
        [
            'previous_bank_balance'=>total_prev_bank_balance($start_date),
            'bank_reports'=>$this->todayBank($start_date)
        ]);
    }
    public function getInfoBank(Request $request)
    {
//        return $request->all();
        $start_date=dateFormat($request->start,'Y-m-d H:i:s');
        $end_date=dateFormat($request->end,'Y-m-d H:i:s');
        $purchase_withdrawal=Purchase::where('payment_media','=','Bank')->whereBetween('created_at',[$start_date,$end_date])->with('BankAccount')->orderBy('id','asc')->get();
        $receive_deposit    =ReceiveAndPay::where('client_type','Customer')->where('payment_media','Bank')->whereBetween('created_at',[$start_date,$end_date])->with('BankAccount')->orderBy('id','asc')->get();
        $payment_withdrawal =ReceiveAndPay::where('client_type','Supplier')->where('payment_media','Bank')->whereBetween('created_at',[$start_date,$end_date])->with('BankAccount')->orderBy('id','asc')->get();
        $deposit            =BankTransaction::where('type','Deposit')->whereBetween('created_at',[$start_date,$end_date])->with('BankAccount')->orderBy('id','asc')->get();
        $withdrawal         =BankTransaction::where('type','Withdrawal')->whereBetween('created_at',[$start_date,$end_date])->with('BankAccount')->orderBy('id','asc')->get();

        $result= [];
//            'purchase_withdrawal'   =>$purchase_withdrawal,
        foreach ($purchase_withdrawal as $value)
        {
            $item = [
                'id'=>$value->id,
                'type'=>'Withdrawal',
                'date'=>dateFormat($value->created_at,'Y-m-d'),
                'amount'=>$value->pay_amount,
                'account_name'=>$value->BankAccount->account_name,
                'account_number'=>$value->BankAccount->account_number,
            ];
            $result["$value->created_at"] = $item;
        }
        foreach ($receive_deposit as $value)
        {
            $item = [

                'id'=>$value->id,
                'type'=>'Deposit',
                'date'          =>dateFormat($value->created_at,'Y-m-d'),
                'amount'        =>$value->amount,
                'account_name'  =>$value->BankAccount->account_name,
                'account_number'=>$value->BankAccount->account_number,
            ];
            $result["$value->created_at"] = $item;
        }
        foreach ($payment_withdrawal as $value)
        {
            $item = [
                'id'=>$value->id,
                'type'=>'Withdrawal',
                'date'          =>dateFormat($value->created_at,'Y-m-d'),
                'amount'        =>$value->amount,
                'account_name'  =>$value->BankAccount->account_name,
                'account_number'=>$value->BankAccount->account_number,
            ];
            $result["$value->created_at"] = $item;
        }
        foreach ($deposit as $value)
        {
            $item = [
                'id'=>$value->id,
                'type'=>'Deposit',
                'date'          =>dateFormat($value->created_at,'Y-m-d'),
                'amount'        =>$value->amount,
                'account_name'  =>$value->BankAccount->account_name,
                'account_number'=>$value->BankAccount->account_number,
            ];
            $result["$value->created_at"] = $item;
        }
        foreach ($withdrawal as $value)
        {
            $item = [
                'id'=>$value->id,
                'type'=>'Withdrawal',
                'date'          =>dateFormat($value->created_at,'Y-m-d'),
                'amount'        =>$value->amount,
                'account_name'  =>$value->BankAccount->account_name,
                'account_number'=>$value->BankAccount->account_number,
            ];
            $result["$value->created_at"] = $item;
        }
        if ($request->type=='view'){

            return view('admin.report.bank.table',[
                'previous_bank_balance'=>total_prev_bank_balance($start_date),
                'bank_reports'=>$result
            ]);
        }else

            return view('admin.report.bank.print',[
                'previous_bank_balance'=>total_prev_bank_balance($start_date),
                'bank_reports'=>$result
            ]);
    }
    public function todayBank($date)
    {
        $start_date         =dateFormat($date,'Y-m-d 00:00:00');
        $end_date           =dateFormat($date,'Y-m-d 23:59:59');
        $purchase_withdrawal=Purchase::where('payment_media','=','Bank')->whereBetween('created_at',[$start_date,$end_date])->with('BankAccount')->orderBy('id','asc')->get();
        $receive_deposit    =ReceiveAndPay::where('client_type','Customer')->where('payment_media','Bank')->whereBetween('created_at',[$start_date,$end_date])->with('BankAccount')->orderBy('id','asc')->get();
        $payment_withdrawal =ReceiveAndPay::where('client_type','Supplier')->where('payment_media','Bank')->whereBetween('created_at',[$start_date,$end_date])->with('BankAccount')->orderBy('id','asc')->get();
        $deposit            =BankTransaction::where('type','Deposit')->whereBetween('created_at',[$start_date,$end_date])->with('BankAccount')->orderBy('id','asc')->get();
        $withdrawal         =BankTransaction::where('type','Withdrawal')->whereBetween('created_at',[$start_date,$end_date])->with('BankAccount')->orderBy('id','asc')->get();

        $result= [];
//            'purchase_withdrawal'   =>$purchase_withdrawal,
        foreach ($purchase_withdrawal as $value)
        {
            $item = [
                  'id'=>$value->id,
                'type'=>'Withdrawal',
                'date'=>dateFormat($value->created_at,'Y-m-d'),
                'amount'=>$value->pay_amount,
                'account_name'=>$value->BankAccount->account_name,
                'account_number'=>$value->BankAccount->account_number,
            ];
           $result["$value->created_at"] = $item;
        }
        foreach ($receive_deposit as $value)
        {
            $item = [
                  'id'=>$value->id,
                'type'=>'Deposit',
                'date'          =>dateFormat($value->created_at,'Y-m-d'),
                'amount'        =>$value->amount,
                'account_name'  =>$value->BankAccount->account_name,
                'account_number'=>$value->BankAccount->account_number,
            ];
            $result["$value->created_at"] = $item;
        }
        foreach ($payment_withdrawal as $value)
        {
            $item = [
                  'id'=>$value->id,
                'type'=>'Withdrawal',
                'date'          =>dateFormat($value->created_at,'Y-m-d'),
                'amount'        =>$value->amount,
                'account_name'  =>$value->BankAccount->account_name,
                'account_number'=>$value->BankAccount->account_number,
            ];
            $result["$value->created_at"] = $item;
        }
        foreach ($deposit as $value)
        {
            $item = [
                  'id'=>$value->id,
                'type'=>'Deposit',
                'date'          =>dateFormat($value->created_at,'Y-m-d'),
                'amount'        =>$value->amount,
                'account_name'  =>$value->BankAccount->account_name,
                'account_number'=>$value->BankAccount->account_number,
            ];
            $result["$value->created_at"] = $item;
        }
        foreach ($withdrawal as $value)
        {
            $item = [
                  'id'=>$value->id,
                'type'=>'Withdrawal',
                'date'          =>dateFormat($value->created_at,'Y-m-d'),
                'amount'        =>$value->amount,
                'account_name'  =>$value->BankAccount->account_name,
                'account_number'=>$value->BankAccount->account_number,
            ];
            $result["$value->created_at"] = $item;
        }
        return $result;
    }
    public function invoice($id)
    {
        return $id;
    }
}
