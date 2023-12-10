<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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

    public function create()
    {
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        // $type = $request->file('image')->getClientOriginalExtension();
        $name = $request->file('image')->getClientOriginalName();
        // $mime = $request->file('image')->getMimeType();
        // $size = $request->file('image')->getSize();

        $newName =  time() . rand(1, 10000) . uniqid() . '_' . $name;
        $databaseName = 'images/' . $newName;
        $request->file('image')->move('images', $newName);
        
        // process data
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image' => $databaseName,
        ]);

        // return response
        return back()->with('success', 'product added successfully!');
    }

    public function edit(Product $product)
    {
        // $product = Product::findOrFail($id);
        
        return view('product.edit', compact('product'));
        
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|max:255|string',
            'price' => ['required', 'numeric'],
            'description' => ['required', 'string'],
            'image' => 'required|image',
        ]);

        // $imagePath = Storage::disk('public')->put('image', $request->file('image'));
        


        // $product = Product::findOrFail($id);

        if(Storage::exists($product->image)){
            Storage::delete($product->image);
        };

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $request->file('image')->store('images'),
        ]);

        return redirect()->route('product.index')->with('success', 'the product has been updated successfully!');
    }

    public function delete($id){
        $product = Product::findOrFail($id);

        $product->delete();

        return back();
    }
}
