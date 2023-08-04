<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ExpanseReportController;
Route::get('expanse_page',[ExpanseReportController::class,'page'])->name('expanse.page');
Route::any('expanse-by-date',[ExpanseReportController::class,'expanseByDate'])->name('expanse.by.date');
Route::any('expanse-invoice/{id}',[ExpanseReportController::class,'invoice'])->name('expanse.invoice');
