<?php

namespace App\Http\Controllers\Admin;

use App\Models\BankTransaction;
use App\Models\Detail;
use App\Models\Purchase;
use App\Models\ReceiveAndPay;
use App\Models\Sale;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\CashBookController;

class BalanceSummaryController extends Controller
{
    public function BalanceSummaryPage()
    {
        $start_date =date('Y-m-d 00:00:00');
        $end_date=date('Y-m-d 23:59:59');
//        return total_stock($end_date);
        $cash = new CashBookController();
        $current_cash=$cash->previous_cash($start_date);
        $bank_balance = total_bank_balance($start_date);
//        return $bank_balance;
        return view('admin.report.balance_summary.balance_summary_page',
        [
            'current_cash'=>$current_cash,
            'bank_balance'=>$bank_balance,
            'receive' => ReceiveAndPay::where('created_at','<',$start_date)->where('client_type','=','Customer')->orderBy('id','asc')->get()->sum('amount'),
            'stock'=>total_stock($start_date),
            'payment'=> ReceiveAndPay::where('created_at','<',$start_date)->where('client_type','=','Supplier')->orderBy('id','asc')->get()->sum('amount')
        ]);
    }

    public function getInfoByDate(Request $request)
    {
        $start_date =dateFormat($request->start,'Y-m-d H:i:s');
        $end_date   =dateFormat($request->end,'Y-m-d 23:59:59');
        $today_date=date('Y-m-d 00:00:00');

        $deposit_amount=BankTransaction::where('type','Deposit')->whereBetween('created_at',[$start_date,$end_date])->sum('amount');
        $withdraw_amount=BankTransaction::where('type','Withdrawal')->whereBetween('created_at',[$start_date,$end_date])->sum('amount');
        $purchase_amount=Purchase::where('payment_media','Bank')->whereBetween('created_at',[$start_date,$end_date])->get()->sum('pay_amount');
        $payment=ReceiveAndPay::where('client_type','Supplier')->where('payment_media','Bank')->whereBetween('created_at',[$start_date,$end_date])->with('BankAccount')->get()->sum('amount');
        $receive=ReceiveAndPay::where('client_type','Customer')->where('payment_media','Bank')->whereBetween('created_at',[$start_date,$end_date])->with('BankAccount')->get()->sum('amount');
        $current_balance=$deposit_amount-$withdraw_amount-$purchase_amount-$payment+$receive;

        $stock_today      =total_stock($today_date);
        $stock_start_date =total_stock($start_date);
//        return $stock_start_date;
        $stock=abs($stock_today-$stock_start_date);
//        return $stock;


        $cash = new CashBookController();
        $current_cash=$cash->previous_cash($start_date);
        $receive = ReceiveAndPay::whereBetween('created_at',[$start_date,$end_date])->where('client_type','=','Customer')->orderBy('id','asc')->get()->sum('amount');
        //stock  baki ache ...
        $payment= ReceiveAndPay::whereBetween('created_at',[$start_date,$end_date])->where('client_type','=','Supplier')->orderBy('id','asc')->get()->sum('amount');
//        return $payment;

       if ($request->type=='view'){
           return view('admin.report.balance_summary.table',
               [
                   'current_cash'=>$current_cash,
                   'bank_balance'=>$current_balance,
                   'receive' => $receive,
                   'stock'=>$stock,
                   'payment'=>$payment,
               ]);
       }else
           return view('admin.report.balance_summary.print',
               [
                   'current_cash'=>$current_cash,
                   'bank_balance'=>$current_balance,
                   'receive' => $receive,
                   'stock'=>$stock,
                   'payment'=>$payment,
                   'start_date'=>$request->start,
                   'end_date'=>$request->end,
               ]);

    }


}
