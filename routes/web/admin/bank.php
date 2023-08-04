<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BankController;

Route::get('add-bank',[BankController::class,'add_bank'])->name('add.bank');
Route::post('create-bank',[BankController::class,'create_bank'])->name('create.bank');
Route::get('manage-bank',[BankController::class,'manage_bank'])->name('manage.bank');

Route::post('update-bank',[BankController::class,'update_bank'])->name('update.bank');
Route::any('delete-bank',[BankController::class,'delete_bank'])->name('delete.bank');
