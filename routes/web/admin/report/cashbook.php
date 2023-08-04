<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CashBookController;

Route::get('cashbook-report',[CashBookController::class,'cashbook'])->name('cashbook.report');
Route::any('cashbook-info',[CashBookController::class,'cashbookInfo'])->name('cashbook.info');
//Route::get(,[CashBookController::class,'findData']);
