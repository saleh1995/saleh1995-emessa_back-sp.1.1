<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductControllerApi;
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




Route::post('/product/store', [ProductControllerApi::class, 'store']);
Route::get('/product/index', [ProductControllerApi::class, 'index']);
Route::get('/product/show/{id}', [ProductControllerApi::class, 'show']);