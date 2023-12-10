<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\Product;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        Category::create([
            'name' => 'new category from observer ' . $product->id,
            'description' => 'some random text 1',
        ]);

        // $category = new Category();
        // $category->name = 'some name';
        // $category->description = 'some description';
        // $category->save();
    }

    public function creating(Product $product): void
    {
        Category::create([
            'name' => 'new category from observer 2',
            'description' => 'some random text 2',
        ]);
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
