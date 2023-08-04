<?php

namespace App\Http\Controllers;

use App\Models\IncomeAndExpense;
use Illuminate\Http\Request;

class ExpanseReportController extends Controller
{
    public function page()
    {
        $start_date=date('Y-m-d 00:00:00');
        return view('admin.report.expanse.expanse_page',
        [
            'expanses'=>$this->today_expanse($start_date)
        ]);
    }
    public function expanseByDate(Request $request)
    {
        $start_date=dateFormat($request->start,'Y-m-d H:i:s');
        $end_date=dateFormat($request->end,'Y-m-d H:i:s');
        $expanse=IncomeAndExpense::whereBetween('created_at',[$start_date,$end_date])->where('transaction_type','Expense')->with(['sector','accountChart'])->orderBy('id','asc')->get();
//            return $expanse;
        if ($request->type=='view'){
            return view('admin.report.expanse.table',
                [
                    'expanses'=>$expanse
                ]);
        }
        else
            return view('admin.report.expanse.print',
                [
                    'expanses'=>$expanse
                ]);
    }
    public function today_expanse($date)
    {
        $start_date =dateFormat($date,'Y-m-d 00:00:00');
        $end_date   =dateFormat($date,'Y-m-d 23:59:59');
        $today_expanse=IncomeAndExpense::whereBetween('created_at',[$start_date,$end_date])->where('transaction_type','Expense')->with(['sector','accountChart'])->orderBy('id','asc')->get();
        return $today_expanse;
    }
    public function invoice($id)
    {
        return view('admin.report.expanse.invoice',
            [
                'expanse'=>IncomeAndExpense::find($id)
            ]);
    }
}
