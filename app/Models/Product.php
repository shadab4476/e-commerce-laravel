<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        "category_id",
        "name",
        "image",
        "description",
        "short_description",
        "rprice",
        "price",
        "author_id",
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id", "id");
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class, "product_id", "id");
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
