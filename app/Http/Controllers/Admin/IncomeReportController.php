<?php

namespace App\Http\Controllers;

use App\Models\IncomeAndExpense;
use Illuminate\Http\Request;

class IncomeReportController extends Controller
{
    public function page()
    {
        $start_date=date('Y-m-d 00:00:00');
        return view('admin.report.income.income_page',
            [
                'incomes'=>$this->today_income($start_date)
            ]);
    }
    public function incomeByDate(Request $request)
    {
        $start_date=dateFormat($request->start,'Y-m-d H:i:s');
        $end_date=dateFormat($request->end,'Y-m-d H:i:s');
        $income=IncomeAndExpense::whereBetween('created_at',[$start_date,$end_date])->where('transaction_type','Income')->with(['sector','accountChart'])->orderBy('id','asc')->get();
//            return $expanse;
       if ($request->type=='view'){
           return view('admin.report.income.table',
               [
                   'incomes'=>$income
               ]);
       }else
           return view('admin.report.income.print',
               [
                   'incomes'=>$income
               ]);
    }
    public function today_income($date)
    {
        $start_date =dateFormat($date,'Y-m-d 00:00:00');
        $end_date   =dateFormat($date,'Y-m-d 23:59:59');
        $today_income=IncomeAndExpense::whereBetween('created_at',[$start_date,$end_date])->where('transaction_type','Income')->with(['sector','accountChart'])->orderBy('id','asc')->get();
        return $today_income;
    }

    public function invoice($id)
    {
        return view('admin.report.income.invoice',
            [
                'income'=>IncomeAndExpense::find($id)
            ]);
    }
}
