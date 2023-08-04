<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransAndlaborCostReportController;

Route::get('trans-and-labor-cost-page',[TransAndlaborCostReportController::class,'page'])->name('trans.and.labor.cost.page');
Route::any('trans-and-labor-cost-by-date',[TransAndlaborCostReportController::class,'cost_by_date'])->name('trans.and.labor.cost.by.date');
Route::any('trans-and-labor-invoice/{id}',[TransAndlaborCostReportController::class,'invoice'])->name('trans.and.labor.invoice');

