<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SupplierController;

Route::post('create-supplier',[SupplierController::class,'create_supplier'])->name('create.supplier');
Route::get('manage-supplier',[SupplierController::class,'manage_supplier'])->name('manage.supplier');
Route::post('update-supplier',[SupplierController::class,'update_supplier'])->name('update.supplier');
Route::any('delete-supplier',[SupplierController::class,'delete_supplier'])->name('delete.supplier');



Route::any('supplier-detail/{id}',[SupplierController::class,'supplierDetail'])->name('supplier.detail');

Route::any('invoice/{id}',[SupplierController::class,'invoice'])->name('invoice');
