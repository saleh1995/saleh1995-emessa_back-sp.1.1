<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\Category;
use App\Models\Product;
use App\Models\Profile;
use App\Models\User;

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

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('product/index', [ProductController::class, 'index'])->name('product.index');
Route::get('product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
Route::get('product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::put('product/update/{id}', [ProductController::class, 'update'])->name('product.update');


Route::get('/test/{id}', function ($id) {
  // $user = User::create([
  //   'name' => 'saleh2',
  //   'email' => 'test2@email.com',
  //   'password' => 123123123,
  // ]);

  // $profile = Profile::create([
  //   'full_name' => 'saleh hayek',
  //   'phone' => '123123123123',
  //   'user_id' => 1,
  // ]);
  // $profile = Profile::findOrFail($id);
  //   dd($profile->user);



  // $category = Category::findOrFail($id);
  // dd($category->products);

  $product = Product::findOrFail($id);
  dd($product->category);
  return 'test';
});
