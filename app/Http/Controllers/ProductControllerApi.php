<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use App\Events\ProductEvent;
use Illuminate\Http\Request;
use App\Jobs\CreateProductJob;
use App\Mail\ProductCreatedMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Redis;
use App\Http\Resources\ProductResource;
use App\Notifications\ProductCreatedNotification;
use Illuminate\Support\Facades\Cache;

class ProductControllerApi extends Controller
{
    use ApiResponseTrait;

    public function index()
    {

        $cachedProduct = Cache::get('products');
        // $cachedProduct = Redis::get('product_' . $id);


        if (isset($cachedProduct)) {
            $products = json_decode($cachedProduct, FALSE);

            return response()->json([
                'status_code' => 200,
                'message' => 'Fetched from cache',
                'data' => $products,
            ]);
        } else {
            $products = $products = Product::all();
            // Redis::set('product_' . $id, $product);
            Cache::forever('products', $products);

            return response()->json([
                'status_code' => 200,
                'message' => 'Fetched from database',
                'data' => $products,
            ]);
        }
        

        // $productsResource = ProductResource::collection($products);

        // return $this->apiResponse($productsResource, 'all products');
    }

    public function show($id)
    {
        // try {

            // $product = Product::findOrFail($id);
            // $productResource = ProductResource::make($product);
            // return response($productResource, 200);

            // $cachedProduct = Cache::get('product_' . $id);
            $cachedProduct = Redis::get('product_' . $id);


            if (isset($cachedProduct)) {
                $product = json_decode($cachedProduct, FALSE);

                return response()->json([
                    'status_code' => 200,
                    'message' => 'Fetched from redis',
                    'data' => $product,
                ]);
            } else {
                $product = Product::find($id);
                Redis::set('product_' . $id, $product);
                // Cache::put('product_' . $id, $product, 30);

                return response()->json([
                    'status_code' => 200,
                    'message' => 'Fetched from database',
                    'data' => $product,
                ]);
            }

            
        // } catch (Exception $e) {
        //     return response('not found', 404);
        // }
    }

    public function store(Request $request)
    {
        // receive data
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'required|image',
            'category_id' => 'required|exists:categories,id'
        ]);

        // process data
        $product = Product::create([
            'name' => $request->name,
            'price' =>  $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image' => $request->image->store('products', 'public'),
        ]);

        $user = Auth::user();


        // event(new ProductEvent($user, $product));

        // ProductEvent::dispatch($user, $product);

        $user->notify(new ProductCreatedNotification($product));
        // CreateProductJob::dispatch($user, $product);

        //return response
        return $this->apiResponse(ProductResource::make($product), 'product added successfully!', 200);
    }

    public function tags($id)
    {
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
