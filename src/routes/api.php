<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', fn (Request $request) => $request->user());
Route::controller('App\Http\Controllers\Api\ProductController')->group(function (): void {
    Route::get('/products', 'allProducts')->name('api.all');
    Route::get('/products/{id}', 'productById')->name('api.id');
    Route::get('/accessories', 'allAccessories')->name('api.accesories');
    Route::get('/bases', 'allBases')->name('api.bases');

});

