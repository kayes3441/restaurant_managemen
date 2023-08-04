<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleReportController extends Controller
{
    public function cashSalePage()
    {
        $start_date =date('Y-m-d 00:00:00');
        return view('admin.report.cash_sale.cash_sale_page',
            [
                'cash_sales'=>$this->todaySale($start_date),
            ]);
    }

    public function cashSaleByDate(Request $request)
    {
        $start_date =dateFormat($request->start,'Y-m-d H:i:s');
        $end_date   =dateFormat($request->end,'Y-m-d 23:59:59');
        $cash_sale  =Sale::whereBetween('created_at',[$start_date,$end_date])->where('sale_type','=','Cash')->orderBy('id','asc')->get();
        //return $credit_purchase;
       if ($request->type=='view'){
           return view('admin.report.cash_sale.table',
               [
                   'cash_sales'=>$cash_sale,
               ]);
       }else
           return view('admin.report.cash_sale.print',
               [
                   'cash_sales'=>$cash_sale,
               ]);
    }
    public function todaySale($date)
    {
        $start_date      =dateFormat($date,'Y-m-d 00:00:00');
        $end_date        =dateFormat($date,'Y-m-d 23:59:59');
        $today_sale      =Sale::whereBetween('created_at',[$start_date,$end_date])->where('sale_type','=','Cash')->orderBy('id','asc')->get();
        return $today_sale;

    }

    public function cashInvoice($id)
    {
        return view('admin.report.cash_sale.invoice',
        [
           'sale'=>Sale::find($id)
        ]);
    }


//Credit Sale................

    public function creditSalePage()
    {
        $start_date =date('Y-m-d 00:00:00');
        return view('admin.report.credit_sale.credit_sale_page',
            [
                'credit_sales'=>$this->todayCreditSale($start_date),
            ]);
    }

    public function creditSaleByDate(Request $request)
    {

        $start_date =dateFormat($request->start,'Y-m-d H:i:s');
        $end_date   =dateFormat($request->end,'Y-m-d 23:59:59');
        $credit_sale  =Sale::whereBetween('created_at',[$start_date,$end_date])->where('sale_type','=','Credit')->with('customer')->orderBy('id','asc')->get();
        if ($request->type=='view'){
            return view('admin.report.credit_sale.table',
                [
                    'credit_sales'=>$credit_sale,
                ]);
        }else
            return view('admin.report.credit_sale.print',
                [
                    'credit_sales'=>$credit_sale,
                ]);
    }
    public function todayCreditSale($date)
    {
        $start_date      =dateFormat($date,'Y-m-d 00:00:00');
        $end_date        =dateFormat($date,'Y-m-d 23:59:59');
        $today_sale      =Sale::whereBetween('created_at',[$start_date,$end_date])->where('sale_type','=','Credit')->with('customer')->orderBy('id','asc')->get();
        return $today_sale;
    }
    public function creditInvoice($id)
    {
        return view('admin.report.credit_sale.invoice',
            [
                'sale'=>Sale::find($id)
            ]);
    }
}
