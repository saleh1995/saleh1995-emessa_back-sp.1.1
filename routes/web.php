<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


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

Route::get('/', [HomeController::class, 'index']);


Route::prefix('/product')->group(function(){
    Route::get('/index', [ProductController::class, 'index']);
    Route::get('/store', [ProductController::class, 'store']);
    Route::get('/update', [ProductController::class, 'update']);
    Route::get('/delete', [ProductController::class, 'delete']);
});



