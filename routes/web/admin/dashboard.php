<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/',[DashboardController::class,'dashboard'])->name('dashboard');
