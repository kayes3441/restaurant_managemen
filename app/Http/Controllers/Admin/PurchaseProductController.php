<?php

namespace App\Http\Controllers\Admin;

use App\Models\Detail;
use App\Models\PurchaseProduct;
use App\Models\PurchaseProductType;
use App\Models\Recipe;
use App\Models\Unit;
use Illuminate\Http\Request;

class PurchaseProductController extends Controller
{
    public function create_purchase_product(Request $request)
    {
        $validator=$request->validate([
            'purchase_product_type_id' => 'required',
            'name' => 'required',
            'unit_id' => 'required',
        ]);

        $purchase_product                             =new PurchaseProduct();
        $purchase_product->purchase_product_type_id   =$request->purchase_product_type_id;
        $purchase_product->unit_id                    =$request->unit_id;
        $purchase_product->name                       =$request->name;
        $purchase_product->save();
        $newProduct =PurchaseProduct::with('unit','purchase_product_type')->find($purchase_product->id);
        $newProduct->sl              =count(PurchaseProduct::all());
        $newProduct->status_title    =$newProduct->status ==1?'Published':'Unpublished';
        return response()->json([
            'new_product'=>$newProduct,
        ]);
    }
    public function manage_purchase_product()
    {
        return view('admin.purchase-product.manage',
            [
                'purchase_products'         =>PurchaseProduct::orderBy('id','desc')->get(),
                'purchase_product_types'    =>PurchaseProductType::all(),
                'units'                     =>Unit::all(),

            ]);
    }

    public function update_purchase_product(Request $request)
    {
        $validator=$request->validate([
            'purchase_product_type_id' => 'required',
            'name' => 'required',
            'unit_id' => 'required',
        ]);
        $purchase_product                             =PurchaseProduct::find($request->id);
        $purchase_product->purchase_product_type_id   =$request->purchase_product_type_id;
        $purchase_product->unit_id                    =$request->unit_id;
        $purchase_product->name                       =$request->name;
        $purchase_product->save();
        $edit =PurchaseProduct::with('unit','purchase_product_type')->find($request->id);
        $edit->sl                   =$request->sl;
        $edit->status_title         =$edit->status ==1?'Published':'Unpublished';
        return response()->json([
            'edit'=>$edit,
            'process'=>'edit'
        ]);
    }
    public function delete_purchase_product(Request $request)
    {
        if ($request->ajax()){
            $details=Detail::where('product_id',$request->id)->get();
            $recipe=Recipe::where('product_id',$request->id)->get();
            if(count($details) ==0 or count($recipe)==0)
            {
                PurchaseProduct::find($request->id)->delete();
                return response()->json([
                    'status'=>'success',
                    'sl'=>$request->sl,
                ]);
            }
            elseif(count($details)!=null and count($recipe)!=null){
                return "Not Success";
            }
        }
    }
}
