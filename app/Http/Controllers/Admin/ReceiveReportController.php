<?php

namespace App\Http\Controllers;

use App\Models\ReceiveAndPay;
use Illuminate\Http\Request;

class ReceiveReportController extends Controller
{
    public function receive_report_page()
    {
        $start_date =date('Y-m-d 00:00:00');
        return view('admin.report.customer_receive.customer_receive_page',
        [
            'amounts'=>$this->todayReceiveAmount($start_date),
        ]);
    }
    public function print()
    {


        $start_date =date('Y-m-d 00:00:00');
//        return $this->todayReceiveAmount($start_date);
        return view('admin.report.customer_receive.print',
            [
                'amounts'=>$this->todayReceiveAmount($start_date),
            ]);
    }
    public function receive_amount(Request $request)
    {
        $start_date=dateFormat($request->start,'Y-m-d H:i:s');
        $end_date=dateFormat($request->end,'Y-m-d H:i:s');
        $receive_amount=ReceiveAndPay::whereBetween('created_at',[$start_date,$end_date])->where('client_type','=','Customer')->with('customer')->orderBy('id','asc')->get();
//            return $receive_amount;
//            return view('admin.report.customer_receive.table',
//                [
//                    'amounts'=>$receive_amount,
//                ]);
        if ($request->type=='view') {
            return view('admin.report.customer_receive.table', [
                    'amounts'=>$receive_amount,
            ]);
        } else {
            return view('admin.report.customer_receive.print', [
                'amounts'=>$receive_amount,
                'data'=>$request
            ]);
        }
    }
    public function todayReceiveAmount($date)
    {
        $start_date      =dateFormat($date,'Y-m-d 00:00:00');
        $end_date        =dateFormat($date,'Y-m-d 23:59:59');
        $today_receive_amount=ReceiveAndPay::whereBetween('created_at',[$start_date,$end_date])->where('client_type','=','Customer')->with('customer')->orderBy('id','asc')->get();
        return $today_receive_amount;
    }
    public function receiveAmountInvoice($id)
    {
        return view('admin.report.customer_receive.invoice',
            [
                'receive_amount'=>ReceiveAndPay::find($id)
            ]);
    }
}
