<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BalanceSummaryController;
Route::get('balance-summary-page',[BalanceSummaryController::class,'BalanceSummaryPage'])->name('balance.summary.page');
Route::any('get-info',[BalanceSummaryController::class,'getInfoByDate'])->name('get.info');
