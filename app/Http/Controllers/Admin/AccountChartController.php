<?php

namespace App\Http\Controllers;

use App\Models\AccountChart;
use App\Models\IncomeAndExpense;
use App\Models\Sector;
use Illuminate\Http\Request;

class AccountChartController extends Controller
{
    public function accountChartPage()
    {
        return view('admin.accountChart.manage',
        [
            'accountCharts'=>AccountChart::all(),
            'sectors'=>Sector::all()
        ]);
    }
    public function create(Request $request)
    {
        $validator=$request->validate([
            'account_name' => 'required',
            'mobile' => 'required|numeric',
        ]);
        if ($request->ajax()){
            if (isset($request->id)) {
                if ($request->sector_id =='new'){

                    $sector =new Sector();
                    $sector->sector_name =$request->sector_name;
                    $sector->save();
                    $accountChartEdit  =AccountChart::find($request->id);
                    $accountChartEdit->sector_id    =$sector->id;
                    $accountChartEdit->account_name =$request->account_name;
                    $accountChartEdit->account_type =$request->account_type;
                    $accountChartEdit->mobile =$request->mobile;
                    $accountChartEdit->address =$request->address;
                    $accountChartEdit->status          =1;
                    $accountChartEdit->save();

                }
                else
                {
                    $accountChartEdit                   = AccountChart::find($request->id);
                    $accountChartEdit->sector_id        =$request->sector_id;
                    $accountChartEdit->account_name     =$request->account_name;
                    $accountChartEdit->account_type     =$request->account_type;
                    $accountChartEdit->mobile           =$request->mobile;
                    $accountChartEdit->address          =$request->address;
                    $accountChartEdit->status           =1;
                    $accountChartEdit->save();
                }
                $editAccountChart=AccountChart::with('sector')->find($request->id);
                $editAccountChart->sl              =count(AccountChart::all());
                $editAccountChart->status_title    =$editAccountChart->status ==1?'Published':'Unpublished';
                return response()->json([
                    'accountChartEdit'=>$editAccountChart,
                    'process'=>'edit'
                ]);

            }
            else
            {
                if ($request->sector_id =='new'){
                    $sector =new Sector();
                    $sector->sector_name =$request->sector_name;
                    $sector->save();
                    $accountChart= new AccountChart();
                    $accountChart->sector_id    =$sector->id;
                    $accountChart->account_name =$request->account_name;
                    $accountChart->account_type =$request->account_type;
                    $accountChart->mobile =$request->mobile;
                    $accountChart->address =$request->address;
                    $accountChart->status          =1;
                    $accountChart->save();

                }
                else
                {
                    $accountChart= new AccountChart();
                    $accountChart->sector_id    =$request->sector_id;
                    $accountChart->account_name =$request->account_name;
                    $accountChart->account_type =$request->account_type;
                    $accountChart->mobile =$request->mobile;
                    $accountChart->address =$request->address;
                    $accountChart->status          =1;
                    $accountChart->save();
                }
                $newAccountChart=AccountChart::with('sector')->find($accountChart->id);
                $newAccountChart->sl              =count(AccountChart::all());
                $newAccountChart->status_title    =$accountChart->status ==1?'Published':'Unpublished';
                return response()->json([
                    'accountChart'=>$newAccountChart,
                    'process'=>'add'
                ]);
            }

        }

        else
            return 'Not Success';
//            return $request->all();
    }

    public function deleteAccountChart(Request $request )
    {
        $incomeAndExpanse=IncomeAndExpense::where('account_chart_id',$request->id)->get('account_chart_id');
        if (count($incomeAndExpanse)==0)
        {
            AccountChart::find($request->id)->delete();
            return view('admin.accountChart.table',
                [
                    'accountCharts'=>AccountChart::orderBy('id','asc')->get(),

                ]);
        }
        else
            return 'Not Success';

    }
}
