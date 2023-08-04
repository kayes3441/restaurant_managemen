<?php

namespace App\Http\Controllers;

use App\Models\FoodType;
use Illuminate\Http\Request;

class FoodTypeController extends Controller
{
    public function manage()
    {
        return view('admin.food-type.manage-food-type',
        [
            'food_types'=>FoodType::orderBy('id','desc')->get()
        ]);
    }

    public function create(Request $request)
    {
        if ($request->ajax()){
            $food_type        =new FoodType();
            $food_type->name  =$request->name;
            $food_type->save();
            return 'Success';
        }
        else
            return 'Not Success';
    }
    public function update(Request $request)
    {
        if ($request->ajax()){
            $food_type        =FoodType::find($request->id);
            $food_type->name  =$request->name;
            $food_type->save();

            return 'Success';
        }
        else
            return 'Not Success';
    }
    public function delete(Request $request)
    {
        if ($request->ajax()){
            FoodType::find($request->id)->delete();

            return 'Success';
        }
        else
            return 'Not Success';
    }
}
