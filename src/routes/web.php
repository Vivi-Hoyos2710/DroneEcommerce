<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//User Routes without auth
Route::controller('App\Http\Controllers\HomeController')->group(function (): void {
    Route::get('/', 'index')->name('home.index');
});
//User Routes WITH auth
Route::middleware('auth')->group(function (){
    Route::controller('App\Http\Controllers\UserController')->group(function (): void {
        Route::get('/my-account', 'index')->name('user.account');
        Route::get('/my-account/update', 'index')->name('user.account.update');
        
    });
    Route::controller('App\Http\Controllers\OrderController')->group(function (): void {
        Route::get('/my-account/orders', 'index')->name('user.orders');
        
    });
    
});

//Admin Routes
Route::middleware('admin')->group(function () {
    Route::controller('App\Http\Controllers\Admin\AdminPageController')->group(function (): void {
        Route::get('/admin', 'index')->name('admin.index');
    });
    Route::controller('App\Http\Controllers\Admin\AdminOrderController')->group(function (): void {
        Route::get('/admin/orders', 'index')->name('admin.orders');
        Route::delete('/admin/orders/{id}/delete', 'delete')->name('admin.orders.delete');
        Route::get('/admin/orders/{id}/show', 'show')->name('admin.orders.show');
        
    });
});
Auth::routes();