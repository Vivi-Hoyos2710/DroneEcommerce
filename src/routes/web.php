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
Route::controller('App\Http\Controllers\User\ProductController')->group(function (): void {
    Route::get('/products', 'index')->name('product.index');
    Route::get('/products/{id}', 'show')->name('product.show');
});

Route::controller('App\Http\Controllers\User\ShoppingCartController')->group(function (): void {
    Route::get('/cart', 'index')->name('cart.index');
    Route::get('/cart/delete', 'delete')->name('cart.delete');
    Route::post('/cart/add/{id}', 'add')->name('cart.add');
});

//User Routes WITH auth
Route::middleware('auth')->group(function (): void {
    Route::controller('App\Http\Controllers\User\SettingsController')->group(function (): void {
        Route::get('/my-account', 'index')->name('user.account');
        Route::put('/my-account/update', 'update')->name('user.account.update');

    });
    Route::controller('App\Http\Controllers\User\ShoppingCartController')->group(function (): void {
        Route::post('/cart/purchase', 'purchase')->name('cart.purchase');
    });
    Route::controller('App\Http\Controllers\User\OrderController')->group(function (): void {
        Route::get('/my-account/orders', 'index')->name('user.orders');
        Route::get('/my-account/orders/location', 'locate')->name('user.orders.locate');
    });


});

//Admin Routes
Route::middleware('admin')->group(function (): void {
    Route::controller('App\Http\Controllers\Admin\AdminPageController')->group(function (): void {
        Route::get('/admin', 'index')->name('admin.index');
    });
    Route::controller('App\Http\Controllers\Admin\AdminOrderController')->group(function (): void {
        Route::get('/admin/orders', 'index')->name('admin.orders');
        Route::delete('/admin/orders/{id}/delete', 'delete')->name('admin.orders.delete');
        Route::get('/admin/orders/{id}/show', 'show')->name('admin.orders.show');
        // Route::get('admin/products', 'index')->name('admin.product.index');
        Route::get('admin/orders/create', 'create')->name('admin.product.create');
    });
    Route::controller('App\Http\Controllers\Admin\AdminProductController')->group(function (): void {
        Route::get('/admin/products', 'index')->name('admin.products');
        Route::get('/admin/products/create', 'create')->name('admin.product.create');
        Route::post('/admin/products/store', 'store')->name('admin.product.store');
        Route::get('/admin/products/{id}/edit', 'edit')->name('admin.product.edit');
        Route::post('/admin/products/{id}/update', 'update')->name('admin.product.update');
        Route::delete('/admin/products/{id}/delete', 'delete')->name('admin.product.delete');
    });
});
Auth::routes();
