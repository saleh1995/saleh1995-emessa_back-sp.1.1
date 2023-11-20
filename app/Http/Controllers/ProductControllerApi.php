<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductControllerApi extends Controller
{
    use ApiResponseTrait;



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
}
