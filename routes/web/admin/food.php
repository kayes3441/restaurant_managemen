<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;

Route::get('manage-food',[FoodController::class,'manageFood'])->name('manage.food');
//Route::post('create-food',[FoodController::class,'create'])->name('create.food');
Route::post('edit-food',[FoodController::class,'edit'])->name('edit.food');
Route::any('delete-food',[FoodController::class,'delete'])->name('delete.food');


Route::any('single-food-recipe/{id}',[
    'uses'=>'App\Http\Controllers\FoodController@singleFoodRecipe',
    'as'=>'single-food-recipe'
]);

Route::any('delete-food',[
    'uses'=>'App\Http\Controllers\FoodController@deleteFood',
    'as'=>'delete-food'
]);
Route::any('status-food',[
    'uses'=>'App\Http\Controllers\FoodController@statusFood',
    'as'=>'status-food'
]);
