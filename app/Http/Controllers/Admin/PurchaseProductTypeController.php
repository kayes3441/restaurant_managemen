<?php

namespace App\Http\Controllers\Admin;

use App\Models\PurchaseProduct;
use App\Models\PurchaseProductType;
use Illuminate\Http\Request;

class PurchaseProductTypeController extends Controller
{
    public function manage()
    {
        return view('admin.purchase-product-type.manage',
            [
                'purchase_product_types'=>PurchaseProductType::orderBy('id','asc')->get()
            ]);
    }
    public function create(Request $request)
    {
        if ($request->ajax()){
            if (isset($request->id))
            {

                $purchase_product_type_edit                  =PurchaseProductType::find($request->id);
                $purchase_product_type_edit->name            =$request->name;
                $purchase_product_type_edit->status          =1;
                $purchase_product_type_edit->save();
                $purchase_product_type_edit->sl             =$request->sl;
                $purchase_product_type_edit->status_title   =$purchase_product_type_edit->status ==1?'Published':'Unpublished';
                return response()->json([
                    'purchase_product_type_edit'=>$purchase_product_type_edit,
                    'process'=>'edit'
                ]);
            }
            else{
                $purchase_product_type                  =new PurchaseProductType();
                $purchase_product_type->name            =$request->name;
                $purchase_product_type->status          =1;
                $purchase_product_type->save();
                $purchase_product_type->sl              =count(PurchaseProductType::all());
                $purchase_product_type->status_title    =$purchase_product_type->status ==1?'Published':'Unpublished';
                return response()->json([
                    'purchase_product_type'=>$purchase_product_type,
                    'process'=>'add'
                ]);
            }
        }
        else
            return 'Not Success';
    }

    public function delete(Request $request)
    {

        $product=PurchaseProduct::where('purchase_product_type_id',$request->id)->get();
        if (count($product)==0)
        {
            PurchaseProductType::find($request->id)->delete();
            return view('admin.accountChart.table',
                [
                    'purchase_product_types'=>PurchaseProductType::orderBy('id','asc')->get(),

                ]);
        }
        else
            return 'Not Success';
    }
}
