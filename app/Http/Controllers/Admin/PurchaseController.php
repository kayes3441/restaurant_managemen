<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Detail;
use App\Models\Purchase;
use App\Models\PurchaseProduct;
use App\Models\PurchaseProductType;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function add_purchase()
    {
//        return view('admin.purchase.invoice');
        return view('admin.purchase.add-purchase',
        [
            'suppliers'=>Supplier::all(),
            'product_types'=>PurchaseProductType::all(),
            'products'=>PurchaseProduct::all(),
            'units'=>Unit::all(),
            'bank_accounts'=>BankAccount::all(),
        ]);
    }
    public function manage_purchase()
    {
        return view('admin.purchase.manage-purchase',
        [
            'suppliers'=>Supplier::all(),
            'product_types'=>PurchaseProductType::all(),
            'products'=>PurchaseProduct::all(),
            'units'=>Unit::all(),
            'bank_accounts'=>BankAccount::all(),
        ]);
    }
    public function supplierId(Request $request)
    {
        if ($request->ajax()){

            $supplier= Supplier::find($request->id);
            $current_balance=supplierBalanceCal($request->id);
            $supplier->balance=$current_balance;
            return $supplier;
        }
        else
            return 'Not Success';
    }
    public function productId()
    {
        $product_type_id=$_GET['id'];
        $product_id=PurchaseProduct::where('purchase_product_type_id',$product_type_id)->get();
        return response()->json( $product_id);
    }
    public function create(Request $request)
    {
        $validator=$request->validate([
            'invoice_number' => 'required',
            'labor_cost' => 'required|numeric',
            'transport_cost' => 'required|numeric',
            'product_id'=>'required',
            'quantity'=>'required',
            'unit_id'=>'required',
            'price'=>'required',
        ]);
        if ($request->purchase_type == "Credit")
        {
            $validator=$request->validate([
                'supplier_id' => 'required',
            ]);
        }
        if ($request->payment_media=="Bank")
        {
            $validator=$request->validate([
                'bank_account_id' => 'required',
                'bank_payment_id' => 'required',
            ]);
        }

        $purchase                    =new Purchase();
        $purchase->purchase_type     =$request->purchase_type;
        $purchase->name              =$request->name;
        $purchase->mobile            =$request->mobile;
        $purchase->supplier_id       =$request->supplier_id;
        $purchase->total_amount      =$request->total_amount;
        $purchase->pay_amount        =$request->pay_amount;
        $purchase->payment_media     =$request->payment_media;
        $purchase->bank_account_id   =$request->bank_account_id;
        $purchase->bank_payment_id   =$request->bank_payment_id;
        $purchase->invoice_number    =$request->invoice_number;
        $purchase->labor_cost        =$request->labor_cost;
        $purchase->transport_cost    =$request->transport_cost;
        $purchase->save();

        foreach ($request->product_id as $key=>$value)
        {
            $detail                   = new Detail();
            $detail['purchase_id']    = $purchase->id;
            $detail['product_id']     =$value;
            $detail['quantity']       =$request->quantity[$key];
            $detail['unit_id']        =$request->unit_id[$key];
            $detail['price']          =$request->price[$key];
            $detail['sub_total']      =$request->sub_total[$key];
            $detail->save();
        }
        return redirect('/purchase-invoice/'."$purchase->id");

    }
    public function invoice($id)
    {
        return view('admin.purchase.invoice',[
            'purchase'=>Purchase::find($id)
        ]);
    }
    public function productInfo(Request $request)
    {
        $productInfo=PurchaseProduct::with('unit')->where('id',$request->id)->first();
        return $productInfo;
    }
}
