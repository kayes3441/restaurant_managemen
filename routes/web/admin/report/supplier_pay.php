<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentReportController;
Route::get('payment_report_page',[PaymentReportController::class,'payment_page'])->name('supplier_pay.report.page');
Route::any('get-supplier-payment-by-date',[PaymentReportController::class,'payment_amount'])->name('get-supplier-payment-by-date');
Route::any('get-supplier-payment-invoice/{id}',[PaymentReportController::class,'paymentInvoice'])->name('get-supplier-payment-invoice');

