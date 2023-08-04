<?php

namespace App\Http\Controllers\Admin;

use App\Models\PurchaseProduct;
use App\Models\Unit;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function manage()
    {
//        return PurchaseProduct::all();
        return view('admin.report.stock.manage-stock',
        [
            'products'=>PurchaseProduct::all()
        ]);
    }

}
