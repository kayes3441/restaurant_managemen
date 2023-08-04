<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PurchaseProductTypeController;
Route::post('create-product-type',[PurchaseProductTypeController::class,'create'])->name('create.product.type');
Route::get('manage',[PurchaseProductTypeController::class,'manage'])->name('manage');
Route::get('detail',[PurchaseProductTypeController::class,'detail'])->name('detail');
Route::get('edit',[PurchaseProductTypeController::class,'edit'])->name('edit');
Route::post('update',[PurchaseProductTypeController::class,'update'])->name('update');
Route::any('delete',[PurchaseProductTypeController::class,'delete'])->name('delete');

