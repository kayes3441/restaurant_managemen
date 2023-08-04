<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CustomerController;

Route::post('create-customer',[CustomerController::class,'create_customer'])->name('create.customer');
Route::get('manage-customer',[CustomerController::class,'manage_customer'])->name('manage.customer');
Route::post('update-customer',[CustomerController::class,'update_customer'])->name('update.customer');
Route::any('delete-customer',[CustomerController::class,'delete_customer'])->name('delete.customer');
Route::any('customer-details/{id}',[CustomerController::class,'details'])->name('customer.details');
