<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SaleController;

Route::get('add-sale',[SaleController::class,'addSale'])->name('add.sale');
Route::post('cart',[SaleController::class,'cart'])->name('cart');
Route::get('get-food-id-by-code',[SaleController::class,'getFoodIdByCode']);
//Route::get('get-food-id-by-food-type',[SaleController::class,'getFood']);
Route::post('create-sale',[SaleController::class,'create'])->name('create.sale');

Route::any('customer-id',[SaleController::class,'customerId']);

Route::any('add-to-cart',[SaleController::class,'addToCart']);
Route::any('add-to-cart-by-code',[SaleController::class,'addToCartByCode']);
Route::any('update-cart',[SaleController::class,'updateCart']);
Route::any('remove-cart',[SaleController::class,'removeCart'])->name('remove.cart');


Route::any('invoice-sale/{id}',[SaleController::class,'invoice'])->name('invoice.sale');
