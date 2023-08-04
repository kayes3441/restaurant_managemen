<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PurchaseReportController;
Route::get('purchase_report_page',[PurchaseReportController::class,'page'])->name('purchase.report.page');
Route::any('get-purchase-info-by-date',[PurchaseReportController::class,'getPurchaseInfo'])->name('get.purchase.info.by.date');
Route::any('credit-purchase-invoice/{id}',[PurchaseReportController::class,'creditPurchaseInvoice'])->name('credit.purchase.invoice');

//Cash purchase.....
Route::get('cash_purchase_report_page',[PurchaseReportController::class,'cash_purchase_page'])->name('cash.purchase.report.page');
Route::any('get-cash_purchase-info-by-date',[PurchaseReportController::class,'getCashPurchaseInfo'])->name('get.cash.purchase.info.by.date');
Route::any('cash-purchase-invoice/{id}',[PurchaseReportController::class,'cashPurchaseInvoice'])->name('cash.purchase.invoice');
