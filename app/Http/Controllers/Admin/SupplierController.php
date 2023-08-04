<?php

namespace App\Http\Controllers\Admin;

use App\Models\Purchase;
use App\Models\ReceiveAndPay;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

    public function create_supplier(Request $request)
    {
//        return $request->all();

        $validator=$request->validate([
            'name' => 'required',
            'mobile' => 'required|numeric',
            'address' => 'required',
            'initial_balance' => 'required|numeric',
        ]);
        $supplier =Supplier::supplier_new($request);
        return $supplier;


    }
    public function manage_supplier()
    {

        return view('admin.supplier.manage-supplier',
            [
                'suppliers'      =>Supplier::orderBy('id','desc')->get(),
                'supplier'       =>Supplier::all(),
            ]);
    }
    public function update_supplier(Request $request)
    {
        $validator=$request->validate([
            'name' => 'required|alpha',
            'mobile' => 'required|numeric',
            'address' => 'required',
            'initial_balance' => 'required|numeric',
        ]);
        $supplier= Supplier::supplier_update($request);
        return $supplier;
    }
    public function delete_supplier(Request $request)
    {
        if ($request->ajax())
        {
            $pay=ReceiveAndPay::where('client_type','Supplier')->where('client_id',$request->id)->get();
            $purchase=Purchase::where('purchase_type','Credit')->where('supplier_id',$request->id)->get();
            if(count($pay) ==0 or count($purchase)==0)
            {
            Supplier::find($request->id)->delete();
                return response()->json([
                    'status'=>'success',
                    'sl'=>$request->sl,
                ]);
            }
            elseif(count($pay)!=null and count($purchase)!=null){
                return "Not Success";
            }
        }
        else
            return 'Not Success';
    }


    public function supplierDetail(Request $request ,$id)
    {
        $purchases=Purchase::where('supplier_id',$id)->get();
        $payments=ReceiveAndPay::where('client_id',$id)->where('client_type','Supplier')->get();
        $result=[];
        foreach ($purchases as $value)
        {
            $item = [
                'type'=>'Purchase',
                'date'=>dateFormat($value->created_at,'Y-m-d'),
                'amount'=>$value->total_amount,
                'Paid'=>$value->pay_amount,
                'discount'=>$value->discount,
                'payment_media'=>$value->payment_media,
                'bank'=>$value->payment_media=='Bank'?$value->BankAccount->account_number:'',
            ];
            $result["$value->created_at"] = $item;
        }
        foreach ($payments as $value)
        {
            $item = [
                'type'=>'Payment',
                'date'=>dateFormat($value->created_at,'Y-m-d'),
                'amount'=>null,
                'Paid'=>$value->amount,
                'discount'=>$value->discount,
                'payment_media'=>$value->payment_media,
                'bank'=>$value->payment_media=='Bank'?$value->BankAccount->account_number:'',
            ];
            $result["$value->created_at"] = $item;
        }
//        return $result;


        return view('admin.supplier.supplier_detail',
        [
            'details'=>$result,
            'supplier'=>Supplier::find($id),
        ]);
    }

    public function invoice(Request $request ,$id)
    {
        return view('admin.supplier.invoice');
    }
}
