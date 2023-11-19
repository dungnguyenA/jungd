<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Images;
use App\Models\Categories;
use App\Models\Brand;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable =
    [
        'product_name', 'price', 'discount_price', 'quantity',
        'description', 'category_id', 'brand_id'
    ];

    public function image()
    {
        return $this->hasMany(Images::class, 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            // Xóa tất cả các ảnh liên quan
            $product->image()->delete();
        });
    }
}
