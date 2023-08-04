<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ReceiveReportController;
Route::get('receive_report_page',[ReceiveReportController::class,'receive_report_page'])->name('receive.report.page');
Route::any('get-customer-receive-amount-by-date',[ReceiveReportController::class,'receive_amount'])->name('get.customer.receive.amount.by.date');
Route::any('get-receive-invoice/{id}',[ReceiveReportController::class,'receiveAmountInvoice'])->name('get.receive.invoice');
Route::any('print-receive-amount',[ReceiveReportController::class,'print'])->name('print.receive.amount');
