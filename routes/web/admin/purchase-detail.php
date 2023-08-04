<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PurchaseDetailCotroller;
Route::get('add-purchase-detail',[PurchaseDetailCotroller::class,'add_purchase_detail'])->name('add.purchase-detail');
