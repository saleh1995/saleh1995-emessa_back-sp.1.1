<?php

namespace App\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $guarded = [];

    protected $fillable = [
        'name',
        'image',
        'price',
        'description',
        'category_id',
    ];

    // protected $table = 'products';


    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return ProductFactory::new();
    }



    //relations

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag');
    }
}
