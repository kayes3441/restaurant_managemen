<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PurchaseProductController;
Route::post('create-purchase-product',[PurchaseProductController::class,'create_purchase_product'])->name('create.purchase-product');
Route::get('manage-purchase-product',[PurchaseProductController::class,'manage_purchase_product'])->name('manage.purchase-product');
Route::post('update-purchase-product',[PurchaseProductController::class,'update_purchase_product'])->name('update.purchase-product');
Route::any('delete-purchase-product',[PurchaseProductController::class,'delete_purchase_product'])->name('delete.purchase-product');

