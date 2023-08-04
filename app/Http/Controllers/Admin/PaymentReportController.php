<?php

namespace App\Http\Controllers\Admin;

use App\Models\ReceiveAndPay;
use Illuminate\Http\Request;

class PaymentReportController extends Controller
{
    public function payment_page()
    {
        $start_date =date('Y-m-d 00:00:00');
        return view('admin.report.supplier_payment.supplier_pay',
            [
                'amounts'=>$this->todayPaymentAmount($start_date),
            ]);
    }
    public function payment_amount(Request $request)
    {
        $start_date=dateFormat($request->start,'Y-m-d H:i:s');
        $end_date=dateFormat($request->end,'Y-m-d H:i:s');
        $payment_amount=ReceiveAndPay::whereBetween('created_at',[$start_date,$end_date])->where('client_type','=','Supplier')->with('supplier')->orderBy('id','asc')->get();
//            return $receive_amount;
        if ($request->type=='view'){
            return view('admin.report.supplier_payment.table',
                [
                    'amounts'=>$payment_amount,
                ]);
        }
        else
            return view('admin.report.supplier_payment.print',
                [
                    'amounts'=>$payment_amount,
                ]);
    }
    public function todayPaymentAmount($date)
    {
        $start_date      =dateFormat($date,'Y-m-d 00:00:00');
        $end_date        =dateFormat($date,'Y-m-d 23:59:59');
        $today_payment_amount=ReceiveAndPay::whereBetween('created_at',[$start_date,$end_date])->where('client_type','=','Supplier')->with('supplier')->orderBy('id','asc')->get();
        return $today_payment_amount;
    }

    public function paymentInvoice($id){
        return view('admin.report.supplier_payment.invoice',
        [
            'supplier_payment'=>ReceiveAndPay::find($id)
        ]);
    }
}
