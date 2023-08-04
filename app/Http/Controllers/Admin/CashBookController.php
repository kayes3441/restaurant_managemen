<?php

namespace App\Http\Controllers\Admin;

use App\Models\BankTransaction;
use App\Models\IncomeAndExpense;
use App\Models\ReceiveAndPay;
use App\Models\Sale;
use Illuminate\Http\Request;

class CashBookController extends Controller
{
    public function cashbook()
    {
        $start_date =date('Y-m-d 00:00:00');
        $end_date   =date('Y-m-d 23:59:59');
        return view('admin.report.cashbook.cashbookPage',[
            'previous_cash'=>$this->previous_cash($start_date),
            'sale_cash'=>Sale::whereBetween('created_at',[$start_date,$end_date])->where('sale_type','=','Cash')->orderBy('id','desc')->get()->sum('totalPayable'),
            'bank_withdraw' => BankTransaction::whereBetween('created_at',[$start_date,$end_date])->where('type','=','Withdrawal')->orderBy('id','asc')->get()->sum('amount'),
            'receive' => ReceiveAndPay::whereBetween('created_at',[$start_date,$end_date])->where('client_type','=','Customer')->orderBy('id','asc')->get()->sum('amount'),
            'income' => IncomeAndExpense::whereBetween('created_at',[$start_date,$end_date])->where('transaction_type','=','Income')->orderBy('id','asc')->get()->sum('amount'),
        //Expense Amount
            'sale_due' => Sale::whereBetween('created_at',[$start_date,$end_date])->where('sale_type','=','Credit')->orderBy('id','desc')->get()->sum('amount'),
            'pay' => ReceiveAndPay::whereBetween('created_at',[$start_date,$end_date])->where('client_type','=','Supplier')->orderBy('id','asc')->get()->sum('amount'),
            'bank_deposite' => BankTransaction::whereBetween('created_at',[$start_date,$end_date])->where('type','=','Deposit')->orderBy('id','asc')->get()->sum('amount'),
            'expanse' => IncomeAndExpense::whereBetween('created_at',[$start_date,$end_date])->where('transaction_type','=','Expanse')->orderBy('id','asc')->get()->sum('amount'),
        ]);
    }
    public function cashbookInfo(Request $request)
    {
        $start_date =dateFormat($request->start,'Y-m-d H:i:s');
        $previous_cash=$this->previous_cash($start_date);
        $end_date   =dateFormat($request->end,'Y-m-d 23:59;59');
        $sale_cash = Sale::whereBetween('created_at',[$start_date,$end_date])->where('sale_type','=','Cash')->orderBy('id','desc')->get()->sum('totalPayable');
//           $purchase = Purchase::whereBetween('created_at',[$start_date,$end_date])->orderBy('id','desc')->get();
        $bank_withdraw = BankTransaction::whereBetween('created_at',[$start_date,$end_date])->where('type','=','Withdrawal')->orderBy('id','asc')->get()->sum('amount');
        $receive = ReceiveAndPay::whereBetween('created_at',[$start_date,$end_date])->where('client_type','=','Customer')->orderBy('id','asc')->get()->sum('amount');
        $income = IncomeAndExpense::whereBetween('created_at',[$start_date,$end_date])->where('transaction_type','=','Income')->orderBy('id','asc')->get()->sum('amount');

        //Expense Amount
        $sale_due = Sale::whereBetween('created_at',[$start_date,$end_date])->where('sale_type','=','Credit')->orderBy('id','desc')->get()->sum('amount');
        $pay = ReceiveAndPay::whereBetween('created_at',[$start_date,$end_date])->where('client_type','=','Supplier')->orderBy('id','asc')->get()->sum('amount');
        $bank_deposite = BankTransaction::whereBetween('created_at',[$start_date,$end_date])->where('type','=','Deposit')->orderBy('id','asc')->get()->sum('amount');
        $expanse = IncomeAndExpense::whereBetween('created_at',[$start_date,$end_date])->where('transaction_type','=','Expanse')->orderBy('id','asc')->get()->sum('amount');


        if ($request->type=='view'){
            return view('admin.report.cashbook.table',[
                'previous_cash'=>$previous_cash,
                'sale_cash'=>$sale_cash,
//               'purchase'=>$purchase,
                'receive'=>$receive,
//               'supplierPay'=>$pay,
                'bank_withdraw'=>$bank_withdraw,
                'income'=>$income,

                //Expanse Amount
                'pay'=>$pay,
                'sale_due'=>$sale_due,
                'bank_deposite'=>$bank_deposite,
                'expanse'=>$expanse
            ]);
        }
        else
            return view('admin.report.cashbook.print',[
                'previous_cash'=>$previous_cash,
                'sale_cash'=>$sale_cash,
//               'purchase'=>$purchase,
                'receive'=>$receive,
//               'supplierPay'=>$pay,
                'bank_withdraw'=>$bank_withdraw,
                'income'=>$income,

                //Expanse Amount
                'pay'=>$pay,
                'sale_due'=>$sale_due,
                'bank_deposite'=>$bank_deposite,
                'expanse'=>$expanse,

                 'start_date'=>$request->start,
                 'end_date'=>$request->end,
            ]);

    }
    public function previous_cash($date)
    {
        $start_date =dateFormat($date,'Y-m-d 00:00:00');
        $sale_cash = Sale::where('created_at','<',$start_date)->where('sale_type','=','Cash')->orderBy('id','desc')->get()->sum('totalPayable');
//           $purchase = Purchase::whereBetween('created_at',[$start_date,$end_date])->orderBy('id','desc')->get();
        $bank_withdraw = BankTransaction::where('created_at','<',$start_date)->where('type','=','Withdrawal')->orderBy('id','asc')->get()->sum('amount');

        $receive = ReceiveAndPay::where('created_at','<',$start_date)->where('client_type','=','Customer')->orderBy('id','asc')->get()->sum('amount');
        $income = IncomeAndExpense::where('created_at','<',$start_date)->where('transaction_type','=','Income')->orderBy('id','asc')->get()->sum('amount');
        $total_receive=$sale_cash+$bank_withdraw+$receive+$income;

        //Expense Amount
        $sale_due = Sale::where('created_at','<',$start_date)->where('sale_type','=','Credit')->orderBy('id','desc')->get()->sum('amount');
        $pay = ReceiveAndPay::where('created_at','<',$start_date)->where('client_type','=','Supplier')->orderBy('id','asc')->get()->sum('amount');
        $bank_deposite = BankTransaction::where('created_at','<',$start_date)->where('type','=','Deposit')->orderBy('id','asc')->get()->sum('amount');
        $expanse = IncomeAndExpense::where('created_at','<',$start_date)->where('transaction_type','=','Expanse')->orderBy('id','asc')->get()->sum('amount');
        $total_expanse=$sale_due+$pay+$bank_deposite+$expanse;

        $cash=$total_receive-$total_expanse;
        return $cash;
    }
}
