<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReceiveAndPayController;

Route::get('receiveAndPay-page',[ReceiveAndPayController::class,'receiveAndPayPage'])->name('receiveAndPay.page');
Route::any('get-customer',[ReceiveAndPayController::class,'customerId']);
Route::any('get-supplier',[ReceiveAndPayController::class,'supplierId']);
Route::any('get-customer-id',[ReceiveAndPayController::class,'getCustomerId']);
Route::any('get-supplier-id',[ReceiveAndPayController::class,'getSupplierId']);
Route::any('get-bank-account',[ReceiveAndPayController::class,'getBankAccount']);

Route::any('create-receive-and-pay',[ReceiveAndPayController::class,'create'])->name('create.receive.and.pay');
