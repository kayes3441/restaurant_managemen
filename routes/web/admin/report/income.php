<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\IncomeReportController;
Route::get('income_page',[IncomeReportController::class,'page'])->name('income.report.page');
Route::any('get-other-income-by-date',[IncomeReportController::class,'incomeByDate'])->name('get.other.income.by.date');
Route::any('income-invoice/{id}',[IncomeReportController::class,'invoice'])->name('income.invoice');
