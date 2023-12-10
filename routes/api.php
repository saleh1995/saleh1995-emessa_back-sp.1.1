<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\CategoryControllerApi;
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

Route::post('login', [ApiAuthController::class, 'login']);
Route::post('register', [ApiAuthController::class, 'register']);
Route::post('logout', [ApiAuthController::class, 'logout'])->middleware('auth:sanctum');


Route::prefix('product')->middleware(['auth:sanctum'])->group(function () {
  Route::post('/store', [ProductControllerApi::class, 'store']);
  Route::get('/index', [ProductControllerApi::class, 'index']);
  Route::get('/show/{id}', [ProductControllerApi::class, 'show']);
  Route::get('/{id}/tags', [ProductControllerApi::class, 'tags']);
  Route::post('/add-tags', [ProductControllerApi::class, 'addTags']);
});


Route::apiResource('/category', CategoryControllerApi::class);