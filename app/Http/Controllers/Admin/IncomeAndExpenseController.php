<?php

namespace App\Http\Controllers\Admin;

use App\Models\AccountChart;
use App\Models\IncomeAndExpense;
use App\Models\Sector;
use Illuminate\Http\Request;

class IncomeAndExpenseController extends Controller
{
    public function page()
    {
        return view('admin.incomeAndExpense.add',
        [
            'sectors'=>Sector::all()
        ]);
    }

    public function getAccountName(Request $request)
    {
        $account_name=AccountChart::where('sector_id',$request->id)->get();
        return $account_name;
    }

    public function sector()
    {
        return Sector::all();
    }
    public function create(Request $request)
    {
//        return $request->all();

        $validator=$request->validate([
            'transaction_type' => 'required',
            'sector_id' => 'required',
            'account_chart_id' => 'required',
            'amount' => 'required|numeric',
        ]);
        $income_and_expense                     =new IncomeAndExpense();
        $income_and_expense->transaction_type   =$request->transaction_type;
        $income_and_expense->sector_id          =$request->sector_id;
        $income_and_expense->account_chart_id   =$request->account_chart_id;
        $income_and_expense->amount             =$request->amount;
        $income_and_expense->note               =$request->note;
        $income_and_expense->save();
        return 'success';
    }
}
