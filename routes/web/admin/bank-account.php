<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BankAccountController;

Route::post('create-bank-account',[BankAccountController::class,'create_bank_account'])->name('create.bank-account');
Route::get('manage-bank-account',[BankAccountController::class,'manage_bank_account'])->name('manage.bank-account');

Route::post('update-bank-account',[BankAccountController::class,'update_bank_account'])->name('update.bank-account');
Route::any('delete-bank-account',[BankAccountController::class,'delete_bank_account'])->name('delete.bank-account');

Route::any('bank-details/{id}',[BankAccountController::class,'details'])->name('bank.details');
