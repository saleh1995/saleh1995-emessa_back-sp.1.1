<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\Category;
use App\Models\Product;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\App;

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

// Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/', function () {
  return 'home page';
})->middleware(['test:super-admin', 'auth']);



Route::get('/test', function () {
  return response()->json('hello form json', 200);
})->name('test');



Route::get('product/index', [ProductController::class, 'index'])->name('product.index');
Route::get('product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
Route::get('product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
Route::put('product/update/{product}', [ProductController::class, 'update'])->name('product.update');

Route::resource('category', CategoryController::class);
Route::get('category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/translate', function () {
  return view('translate');
});


Route::get('/switch', function () {
  $lang = session('locale');

  if ($lang == 'ar') {
    $lang = 'en';
  } else {
    $lang = 'ar';
  }

  session()->put('locale', $lang);
  App::setLocale($lang);

  

  return redirect()->back();
})->name('switch.lang');
