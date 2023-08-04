<?php

namespace App\Http\Controllers\Admin;

use App\Models\Food;
use App\Models\FoodType;
use App\Models\PurchaseProduct;
use App\Models\PurchaseProductType;
use App\Models\Recipe;
use App\Models\SaleItem;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function manageFood()
    {
        return view('admin.food.manage-food',
        [
            'foods'     =>Food::orderBy('id','desc')->get(),
        ]);
    }
    public function delete(Request $request)
    {
        if ($request->ajax()){
            Food::find($request->id)->delete();
            return 'Success';
        }
        else
            return 'Not Success';
    }

    public function singleFoodRecipe($id){
         $items = Recipe::where([
            'food_id'=>$id
        ])->get();
        $result = [];
        foreach ($items as $value){
            $item= [
                'name'=>$value->rawMaterial->name,
                'quantity'=>$value->quantity,
                'unit'=>$value->unit_name,
          ];
            $result["$value->id"] = $item;
        }
        return view('admin.food.detail',
        [
            'items'=>$result,
            'food'=>Food::find($id),
        ]);
    }
    public function deleteFood(Request $request)
    {
        $sale_item=SaleItem::where('food_id',$request->id)->get('food_id');
        if (count($sale_item)==0)
        {
            $food =Food::find($request->id)->delete();
            $recipes=Recipe::where('food_id',$request->id)->get();
            foreach ($recipes as $key=>$value) {
                $recipe = Recipe::find($value->id)->delete();
            }
            return view('admin.food.table',
                [
                    'foods'     =>Food::orderBy('id','desc')->get(),
                ]);
        }
        else
            return "Not Success";


    }
    public function statusFood(Request $request){
        $food=Food::find($request->id);
        $recipes=Recipe::where('food_id',$request->id)->get();
        if ($request->status ==1)
        {
            $food->status = 2;
            $food->save();
            foreach ($recipes as $key=>$value) {
                $recipe = Recipe::find($value->id);
                $recipe->status=2;
                $recipe->save();
            }
        }
        else
        {
            $food->status = 1;
            $food->save();
            foreach ($recipes as $key=>$value) {
                $recipe = Recipe::find($value->id);
                $recipe->status=1;
                $recipe->save();
            }
        }
        return view('admin.food.table',[
            'foods'     =>Food::orderBy('id','desc')->get(),
        ]);

    }
}
