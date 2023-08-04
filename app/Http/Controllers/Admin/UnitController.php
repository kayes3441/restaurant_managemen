<?php

namespace App\Http\Controllers\Admin;

use App\Models\PurchaseProduct;
use App\Models\Unit;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;

class UnitController extends Controller
{

    public function create_unit(Request $request)
    {
        $validator=$request->validate([
            'name' => 'required',
            'code' => 'required|numeric',
        ]);
        if ($request->ajax()){
            $unit = new Unit();
            $unit->name         = $request->name;
            $unit->code         = $request->code;
            $unit->description  = $request->description;
            $unit->status       = 1;
            $unit->save();
            $unit->sl           =count(Unit::all());
            $unit->status_title =$unit->status ==1?'Published':'Unpublished';
            return $unit;
        }
        else
            return 'Not Success';
    }
    public function manage_unit()
    {
        return view('admin.unit.manage-unit',
        [
            'units'=>Unit::orderBy('id','asc')->get()
        ]);
    }
    public function update_unit(Request $request)
    {
        $validator=$request->validate([
            'name' => 'required',
            'code' => 'required|numeric',
        ]);
        $unit               =Unit::find($request->id);
        $unit->name         = $request->name;
        $unit->code         = $request->code;
        $unit->description  = $request->description;
        $unit->save();
        $unit->sl           =$request->sl;
        $unit->status_title =$unit->status ==1?'Published':'Unpublished';
        return response()->json($unit);
    }
    public function delete_unit(Request $request)
    {

        if ($request->ajax()){
            $purchaseUnit_id=PurchaseProduct::where('unit_id',$request->id)->get('unit_id');
            if(count($purchaseUnit_id) ==0)
            {
                Unit::find($request->id)->delete();
                return response()->json([
                    'status'=>'success',
                    'sl'=>$request->sl,
                ]);
            }
            elseif(count($purchaseUnit_id)!=null){
                return "Not Success";
            }
        }
    }

    public function unitInfo(Request $request)
    {
        if ($request->ajax())
        {
            return Unit::find($request->id);
        }
    }
}
