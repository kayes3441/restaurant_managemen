<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodRecipeController;
Route::get('food-recipe',[FoodRecipeController::class,'foodRecipe'])->name('food.recipe');
Route::get('get-product-id-by-product-type',[FoodRecipeController::class,'productId'])->name('get-all-product');
Route::post('create-food-recipe',[FoodRecipeController::class,'create'])->name('create.food-recipe');
//Route::get('get-food-id',[FoodRecipeController::class,'foodId']);
Route::any('get-product-detail',[FoodRecipeController::class,'productIdDetail']);

Route::any('get-unit-info',[FoodRecipeController::class,'unitId']);
Route::any('get-product-info',[FoodRecipeController::class,'productInfo']);

Route::any('edit-food-recipe/{id}',[
    'uses'=>'App\Http\Controllers\FoodRecipeController@editFoodRecipe',
    'as'=>'edit-food-recipe'
]);
Route::any('update-recipe/{id}',[
    'uses'=>'App\Http\Controllers\FoodRecipeController@updateRecipe',
    'as'=>'update-recipe'
]);
Route::any('delete-recipe',[
    'uses'=>'App\Http\Controllers\FoodRecipeController@deleteRecipe',
    'as'=>'delete-recipe'
]);
