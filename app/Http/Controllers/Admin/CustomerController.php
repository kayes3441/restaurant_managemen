<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use App\Models\ReceiveAndPay;
use App\Models\Sale;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function create_customer(Request $request)
    {
        $validator=$request->validate([
            'name' => 'required',
            'mobile' => 'required|numeric',
            'address' => 'required',
            'initial_balance' => 'required|numeric',
        ]);

        $customer                   = new Customer();
        $customer->name             = $request->name;
        $customer->mobile           = $request->mobile;
        $customer->address          = $request->address;
        $customer->initial_balance  = $request->initial_balance;
        $customer->balance_title    = $request->balance_title;
        $customer->status           = 1;
        $customer->save();
        $customer->sl               = count(Customer::all());
        $customer->status_title     = $customer->status ==1?'Published':'Unpublished';
        return $customer;

    }
    public function manage_customer()
    {
        return view('admin.customer.manage-customer',
            [
                'customers'      =>Customer::orderBy('id','desc')->get(),
                'customer'       =>Customer::all(),
            ]);
    }
    public function update_customer(Request $request)
    {
//        return $request->all();
        $validator=$request->validate([
            'name' => 'required|alpha',
            'mobile' => 'required|numeric',
            'address' => 'required',
            'initial_balance' => 'required|numeric',
        ]);
        $customer                   =Customer::find($request->id);
        $customer->name             =$request->name;
        $customer->mobile           =$request->mobile;
        $customer->address          =$request->address;
        $customer->initial_balance  =$request->initial_balance;
        $customer->balance_title    =$request->balance_title;
        $customer->save();
        $customer->sl               =$request->sl;
        $customer->status_title     =$customer->status ==1?'Published':'Unpublished';
        return response()->json($customer);
    }
    public function delete_customer(Request $request)
    {
        if ($request->ajax()){
            $receive=ReceiveAndPay::where('client_type','Customer')->where('client_id',$request->id)->get();
            $sale=Sale::where('sale_type','Credit')->where('customer_id',$request->id)->get('customer_id');
            if(count($receive) ==0 or count($sale)==0)
            {
                Customer::find($request->id)->delete();
                return response()->json([
                    'status'=>'success',
                    'sl'=>$request->sl,
                ]);
            }
            elseif(count($receive)!=null and count($sale)!=null){
                return "Not Success";
            }
        }
    }
    public function details($id)
    {
        $sales=Sale::where('sale_type','Credit')->where('customer_id',$id)->get();
        $receive=ReceiveAndPay::where('client_type','Customer')->where('client_id',$id)->get();
        $result=[];
        foreach ($sales as $value)
        {
            $item = [
                'type'=>'Sale',
                'date'=>dateFormat($value->created_at,'Y-m-d'),
                'receivable'=>$value->subtotal,
                'received'=>null,
                'discount'=>$value->discount,
                'payment_media'=>'Cash',
                'bank'=>null,
            ];
            $result["$value->created_at"] = $item;
        }
        foreach ($receive as $value)
        {
            $item = [
                'type'=>'Receive',
                'date'=>dateFormat($value->created_at,'Y-m-d'),
                'receivable'=>null,
                'received'=>$value->amount,
                'discount'=>$value->discount,
                'payment_media'=>$value->payment_media,
                'bank'=>$value->payment_media=='Bank'?$value->BankAccount->account_number:'',
            ];
            $result["$value->created_at"] = $item;
        }

        return view('admin.customer.customer_details',
        [
            'details'=>$result,
            'customer'=>Customer::find($id),
        ]);
    }
}
