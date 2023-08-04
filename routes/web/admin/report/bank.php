<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BankReportController;
Route::get('bank-report-page',[BankReportController::class,'page'])->name('bank.report.page');
Route::any('get-info-bank',[BankReportController::class,'getInfoBank'])->name('get.info.bank');
Route::get('bank-report-invoice/{id}',[BankReportController::class,'invoice'])->name('bank.report.invoice');
