<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PurchaseController;

Route::get('add-purchase',[PurchaseController::class,'add_purchase'])->name('add.purchase');
Route::get('manage-purchase',[PurchaseController::class,'manage_purchase'])->name('manage.purchase');
//Route::get('get-all-product-info',[PurchaseController::class,'productInfo']);
Route::get('get-supplier-id',[PurchaseController::class,'supplierId'])->name('supplier.id');
Route::get('get-product-id-by-product-type',[PurchaseController::class,'productId']);
Route::post('create-purchase',[PurchaseController::class,'create'])->name('create.purchase');

Route::any('purchase-invoice/{id}',[PurchaseController::class,'invoice'])->name('purchase.invoice');

Route::get('get-unit-info',[PurchaseController::class,'unitId']);
Route::get('get-product-info',[PurchaseController::class,'productInfo']);
