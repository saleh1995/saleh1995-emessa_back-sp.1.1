<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Resources\ProductResource;

class ProductControllerApi extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $products = Product::all();

        $productsResource = ProductResource::collection($products);

        return $this->apiResponse($productsResource, 'all products');
    }

    public function show($id)
    {
        try{
            $product = Product::findOrFail($id);
            $productResource = ProductResource::make($product);
            return response($productResource, 200);
        }
        catch(Exception $e){
            return response('not found', 404);
        }
    }

    public function store(Request $request)
    {
        // receive data
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id'
        ]);

        // process data
        $product = Product::create([
            'name' => $request->name,
            'price' =>  $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        //return response
        return $this->apiResponse(ProductResource::make($product), 'product added successfully!', 404);
    }

    public function tags($id){
        $product = Product::with('tags')->findOrFail($id);

        return response()->json($product, 200);
    }

    public function addTags(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
        ]);
        // dd($request->all());
        $product = Product::find($request->product_id);
        $product->tags()->syncWithoutDetaching($request->tags);

        return response()->json($product, 200);
    }
}
