<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::group(['namespace' => 'Admin','prefix'=>'admin','as'=>'admin.',],function (){

    Route::get('/login-form',[AdminController::class,'loginForm'])->name('login-form');
    Route::post('/login',[AdminController::class,'login'])->name('login');
    Route::get('/reset-password-form',[AdminController::class,'resetPasswordForm'])->name('reset-password-form');
    Route::post('/reset-password',[AdminController::class,'resetPassword'])->name('reset-password');
    Route::get('/update-reset-password-form/{token}',[AdminController::class,'updateResetPasswordForm'])->name('update-reset-password-form');
    Route::post('/update-reset-password',[AdminController::class,'updateResetPassword'])->name('update-reset-password');

    Route::group(['middleware'=>'admin',],function (){
        // Route::get('/dashboard',[AdminDashboardController::class,'index'])->name('dashboard');
        // Route::get('/logout',[AdminController::class,'logout'])->name('logout');

        // Route::controller(CategoryController::class)->group(function (){
        //     Route::get('/category/index','index')->name('category.index');
        //     Route::post('/category/create','create')->name('category.create');
        // });

        
    });

});
