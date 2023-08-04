<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\StockController;

Route::get('manage-stock',[StockController::class,'manage'])->name('manage.stock');
