<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BankTransactionController;
Route::get('bank-transaction-page',[BankTransactionController::class,'page'])->name('bank.transaction.page');
Route::any('get-bank-account',[BankTransactionController::class,'bankAccount']);
Route::any('create',[BankTransactionController::class,'create'])->name('create');
