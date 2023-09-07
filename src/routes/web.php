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
Route::controller('App\Http\Controllers\ReviewController')->group(function (): void {
    Route::get('/review/create', 'create')->name('review.create');
    Route::get('/list', 'listAll')->name('review.list');
    Route::delete('/review/{id}/delete', 'delete')->name('review.delete');
    Route::post('/store', 'store')->name('review.store'); 
});
Route::controller('App\Http\Controllers\HomeController')->group(function (): void {
    Route::get('/', 'index')->name('home.index');
});
Route::controller('App\Http\Controllers\AdminPageController')->group(function (): void {
    Route::get('/admin', 'index')->name('admin.index');
});

