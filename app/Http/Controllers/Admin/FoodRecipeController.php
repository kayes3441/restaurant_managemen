<?php

namespace App\Http\Controllers;

use App\Models\Detail;

use App\Models\Food;
use App\Models\PurchaseProduct;
use App\Models\PurchaseProductType;
use App\Models\Recipe;
use App\Models\Unit;
use Illuminate\Http\Request;

class FoodRecipeController extends Controller
{
    public function foodRecipe()
    {
        return view('admin.food-recipe.add-recipe',
        [
            'products'=>PurchaseProduct::all(),
            'product_types'=>PurchaseProductType::all(),
        ]);
    }
    public function productId()
    {
        $product_type_id=$_GET['id'];
        $product_id=PurchaseProduct::where('purchase_product_type_id',$product_type_id)->get();
        return response()->json( $product_id);
    }
//    public function foodId(Request $request)
//    {
//        if ($request->ajax()){
//            return Food::find($request->id);
//        }
//        else
//            return 'Not Success';
//    }
    public function productIdDetail()
    {
        $product_id=$_GET['id'];
        $product_detail=Detail::where('product_id',$product_id)->with('unit')->get();
        return response()->json( $product_detail);
    }
    public function create(Request $request)
    {
        //return $request->all();
        $food                        =new Food();
        $food->food_name            =$request->food_name;
        $food->code                 =$request->code;
        $food->price                =$request->price;
        $food->save();

        foreach ($request->product_id as $key=>$value)
        {
            $recipe                                 = new Recipe();
            $recipe['food_id']                      =$food->id;
            $recipe['product_id']                   =$value;
            $recipe['purchase_product_type_id']     =$request->product_type_id[$key];
            $recipe['quantity']                     =$request->quantity[$key];
            $recipe['unit_name']                    =$request->unit_name[$key];
            $recipe->save();
        }
        return redirect()->back()->with('message','Food Recipe Info create Successfully');
    }
    public function unitId(Request $request)
    {
        if ($request->ajax()){
            $unitInfo=Unit::find($request->id);
            return $unitInfo;
        }
    }

    public function editFoodRecipe($id)
    {
        return view('admin.food.edit',
            [
                'food'=>Food::find($id),
                'recipes'=>Recipe::where('food_id',$id)->with('rawMaterial')->get(),
                'count'=>count(Recipe::where('food_id',$id)->get()),
                'products'=>PurchaseProduct::all(),
                'product_types'=>PurchaseProductType::all(),
            ]);
    }

    public function deleteRecipe(Request $request)
    {
        Recipe::find($request->id)->delete();
//        return view('admin.food.list',
//        [
//            'recipes'=>Recipe::orderBy('id','asc')->get(),
//            'products'=>PurchaseProduct::all(),
//            'product_types'=>PurchaseProductType::all(),
//        ]);
    }
    public function updateRecipe(Request $request,$id){

//        return $request->all();
        $food                        =Food::find($id);
        $food->food_name             =$request->food_name;
        $food->code                  =$request->code;
        $food->price                 =$request->price;
        $food->save();

        $recipes=Recipe::where('food_id',$id)->delete();
//        foreach ($recipes as $key=>$value){
//            $recipe                   =Recipe::find($value->id);
//            $recipe['product_id']     =$request->update_product_id[$key];
//            $recipe['quantity']       =$request->update_quantity[$key];
//            $recipe['unit_name']      =$request->update_unit_name[$key];
//            $recipe->save();
//        }
        if ($request->product_id !=null)
        {
            foreach ($request->product_id as $key=>$value)
            {
                $recipe                                 =new Recipe();
                $recipe['food_id']                      =$id;
                $recipe['product_id']                   =$value;
                $recipe['purchase_product_type_id']     =$request->product_type_id[$key];
                $recipe['quantity']                     =$request->quantity[$key];
                $recipe['unit_name']                    =$request->unit_name[$key];
                $recipe->save();
            }
        }
        return redirect()->back()->with('message','Food Recipe Update Successfully');
    }

}
