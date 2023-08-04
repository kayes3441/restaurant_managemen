<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SaleReportController;
Route::get('cash-sale-page',[SaleReportController::class,'cashSalePage'])->name('cash.sale.page');
Route::any('get-cash-sale-info-by-date',[SaleReportController::class,'cashSaleByDate'])->name('get.cash.sale.info.by.date');
Route::any('cash-sale-invoice/{id}',[SaleReportController::class,'cashInvoice'])->name('cash.sale.invoice');



//Credit Sale

Route::get('credit-sale-page',[SaleReportController::class,'creditSalePage'])->name('credit.sale.page');
Route::any('get-credit-sale-info-by-date',[SaleReportController::class,'creditSaleByDate'])->name('get.credit.sale.info.by.date');
Route::any('credit-sale-invoice/{id}',[SaleReportController::class,'creditInvoice'])->name('credit.sale.invoice');
