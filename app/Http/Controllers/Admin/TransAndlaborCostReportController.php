<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;

class TransAndlaborCostReportController extends Controller
{
    public function page()
    {
        $start_date =date('Y-m-d 00:00:00');
        return view('admin.report.trans&labor_cost.trans&labor_cost_page',
        [
            'all_cost'=>$this->todayCost($start_date)
        ]);
    }
    public function cost_by_date(Request $request)
    {
        $start_date =dateFormat($request->start,'Y-m-d H:i:s');
        $end_date   =dateFormat($request->end,'Y-m-d 23:59:59');
        $cost=Purchase::whereBetween('created_at',[$start_date,$end_date])->orderBy('id','asc')->get();
        if ($request->type=='view'){
            return view('admin.report.trans&labor_cost.table',
                [
                    'all_cost'=>$cost
                ]);
        }else
            return view('admin.report.trans&labor_cost.print',
                [
                    'all_cost'=>$cost
                ]);
    }

    public function todayCost($date)
    {
        $start_date =dateFormat($date,'Y-m-d 00:00:00');
        $end_date   =dateFormat($date,'Y-m-d 23:59:59');
        $today_cost=Purchase::whereBetween('created_at',[$start_date,$end_date])->orderBy('id','asc')->get();
        return $today_cost;
    }
    public function invoice($id){
        return view('admin.report.trans&labor_cost.invoice',
            [
                'all_cost'=>Purchase::find($id)
            ]);
    }

}
//->where('labor_cost','!=',0,)->andWhere('transport_cost','!=',0)
