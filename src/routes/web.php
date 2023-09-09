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
// Route::controller('App\Http\Controllers\User\ReviewController')->group(function (): void {
//     Route::get('/review/create', 'create')->name('review.create');
//     Route::get('/list', 'listAll')->name('review.list');
//     Route::delete('/review/{id}/delete', 'delete')->name('review.delete');
//     Route::post('/store', 'store')->name('review.store'); 

//     //test
//     Route::get('/products/{id}', 'create')->name('review.create');
// });

//User Routes without auth
Route::controller('App\Http\Controllers\HomeController')->group(function (): void {
    Route::get('/', 'index')->name('home.index');
});
Route::controller('App\Http\Controllers\User\ProductController')->group(function (): void {
    Route::get('/products', 'index')->name('product.index');
    Route::delete('products/{id}/delete', 'delete')->name('product.delete');
    Route::get('/products/{id}', 'show')->name('product.show');
});
Route::controller('App\Http\Controllers\ImageController')->group(function (): void {
    Route::get('/image', 'index')->name('image.index');
    Route::post('/image/save', 'save')->name('image.save');
});

//User Routes WITH auth
Route::middleware('auth')->group(function () {
    Route::controller('App\Http\Controllers\User\UserController')->group(function (): void {
        Route::get('/my-account', 'index')->name('user.account');
        Route::get('/my-account/update', 'index')->name('user.account.update');
    });
    Route::controller('App\Http\Controllers\User\OrderController')->group(function (): void {
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
        // Route::get('admin/products', 'index')->name('admin.product.index');
        // Route::get('admin/products/create', 'create')->name('admin.product.create');
    });
    Route::controller('App\Http\Controllers\Admin\AdminProductController')->group(function (): void {
        Route::get('/admin/products', 'index')->name('admin.products');
        Route::get('/admin/products/create', 'create')->name('admin.product.create');
        Route::post('/admin/products/store', 'store')->name('admin.product.store');
        Route::get('/admin/products/{id}/edit', 'edit')->name('admin.product.edit');
        Route::delete('/admin/products/{id}/delete', 'delete')->name('admin.product.delete');
    });
});
Auth::routes();
