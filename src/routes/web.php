<?php

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

Route::controller('App\Http\Controllers\HomeController')->group(function () {
    Route::get('/', 'index')->name("home.index");
});
Route::controller('App\Http\Controllers\AdminPageController')->group(function () {
    Route::get('/admin', 'index')->name("admin.index");
});