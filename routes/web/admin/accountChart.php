<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AccountChartController;
Route::get('account-chart-page',[AccountChartController::class,'accountChartPage'])->name('account-chart.page');
Route::post('create-account-chart',[AccountChartController::class,'create'])->name('create.account-chart');



Route::any('delete-accountChart',[AccountChartController::class,'deleteAccountChart']);
