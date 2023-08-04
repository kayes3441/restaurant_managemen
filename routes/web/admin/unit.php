<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UnitConversionController;
Route::post('create-unit',[UnitController::class,'create_unit'])->name('create.unit');
Route::get('manage-unit',[UnitController::class,'manage_unit'])->name('manage.unit');
Route::post('update-unit',[UnitController::class,'update_unit'])->name('update.unit');
Route::any('delete-unit',[UnitController::class,'delete_unit'])->name('delete.unit');


Route::any('get-unit-info',[UnitController::class,'unitInfo']);


Route::get('manage-unit-conversion',[UnitConversionController::class,'manage'])->name('manage.unit.conversion');
