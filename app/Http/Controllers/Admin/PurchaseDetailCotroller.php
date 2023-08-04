<?php

namespace App\Http\Controllers\Admin;

use App\Models\PurchaseProduct;
use App\Models\Unit;
use Illuminate\Http\Request;

class PurchaseDetailCotroller extends Controller
{
    public function add_purchase_detail()
    {
        return view('admin.purchase-detail.add-purchase-detail',
        [
            'products'=>PurchaseProduct::all(),
            'units'=>Unit::all()
        ]);
    }
}
