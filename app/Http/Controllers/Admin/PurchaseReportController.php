<?php

namespace App\Http\Controllers\Admin;

use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseReportController extends Controller
{
    public function page()
    {
        $start_date =date('Y-m-d 00:00:00');
//        $end_date   =date('Y-m-d 23:59:59');
        return view('admin.report.purchase_report.purchase_report_page',
            [
                'credit_purchases'=>$this->credit_purchase($start_date)
            ]);
    }

    public function getPurchaseInfo(Request $request)
    {
        $start_date=dateFormat($request->start,'Y-m-d H:i:s');
        $end_date=dateFormat($request->end,'Y-m-d 23:59:59');
        $credit_purchase=Purchase::whereBetween('created_at',[$start_date,$end_date])->where('purchase_type','=','Credit')->with('supplier')->orderBy('id','desc')->get();
        //return $credit_purchase;
        if ($request->type =='view')
        {
            return view('admin.report.purchase_report.table',
                [
                    'credit_purchases'=>$credit_purchase,
                ]);
        }
        else{
            return view('admin.report.purchase_report.print',
                [
                    'credit_purchases'=>$credit_purchase,
                ]);
        }
    }
    public function credit_purchase($date)
    {
        $start_date      =dateFormat($date,'Y-m-d 00:00:00');
        $end_date        =dateFormat($date,'Y-m-d 23:59:59');
        $credit_purchase =Purchase::whereBetween('created_at',[$start_date,$end_date])->where('purchase_type','=','Credit')->with('supplier')->orderBy('id','desc')->get();
        return $credit_purchase;
    }
    public function creditPurchaseInvoice($id)
    {
        return view('admin.report.purchase_report.invoice',
            [
                'purchase'=>Purchase::where('id',$id)->with('details')->first()
            ]);
    }



    //cash Purchase

    public function cash_purchase_page()
    {
        $start_date =date('Y-m-d 00:00:00');
        $end_date   =date('Y-m-d 23:59:59');
//        return $this->credit_purchase($start_date);
        return view('admin.report.cash_purchase.cash_purchase_page',
            [
                'cash_purchases'=>$this->cash_purchase($start_date)
            ]);
    }
    public function getCashPurchaseInfo(Request $request)
    {
        $start_date=dateFormat($request->start,'Y-m-d H:i:s');
        $end_date=dateFormat($request->end,'Y-m-d 23:59:59');
        $cash_purchase=Purchase::whereBetween('created_at',[$start_date,$end_date])->where('purchase_type','Debit')->orderBy('id','desc')->get();
        //return $credit_purchase;
        if ($request->type =='view')
        {
            return view('admin.report.cash_purchase.table',
                [
                    'cash_purchases'=>$cash_purchase,
                ]);
        }
        else{
            return view('admin.report.cash_purchase.print',
                [
                    'cash_purchases'=>$cash_purchase,
                ]);
        }
    }

    public function cash_purchase($date)
    {
        $start_date      =dateFormat($date,'Y-m-d 00:00:00');
        $end_date        =dateFormat($date,'Y-m-d 23:59:59');
        $cash_purchase =Purchase::whereBetween('created_at',[$start_date,$end_date])->where('purchase_type','Debit')->orderBy('id','desc')->get();
        return $cash_purchase;
    }

    public function cashPurchaseInvoice($id)
    {
        return view('admin.report.cash_purchase.invoice',
            [
                'purchase'=>Purchase::find($id)
            ]);
    }

}
