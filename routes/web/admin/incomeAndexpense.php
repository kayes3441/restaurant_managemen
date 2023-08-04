<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\IncomeAndExpenseController;

Route::get('income-and-expanse-page',[IncomeAndExpenseController::class,'page'])->name('income.and.expanse');

Route::any('get-account-name-by-sector-id',[IncomeAndExpenseController::class,'getAccountName']);

Route::any('get-sector',[IncomeAndExpenseController::class,'sector']);

Route::any('create-income-or-expanse',[IncomeAndExpenseController::class,'create'])->name('create.income.or.expanse');
