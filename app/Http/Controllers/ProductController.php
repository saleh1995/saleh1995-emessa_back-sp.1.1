<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Product::create([
        //     'name' => 'product1',
        //     'price' => 100,
        //     'description' => 'some random text',
        //     'category_id' => 1,
        // ]);

        // $product = new Product();
        // $product->name = 'product 3';
        // $product->price = 103;
        // $product->description = 'description 3';
        // $product->category_id = 1;

        // $product->save();

        $products = Product::all();

        // dd($products);

        return view('product.index', compact('products'));
    }


    public function delete($id){
        $product = Product::findOrFail($id);

        $product->delete();

        return back();
    }
}
