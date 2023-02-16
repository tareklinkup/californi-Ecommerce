<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'brand_id',
        'category_id',
        'name',
        'slug',
        'thumbnail',
        'product_code',
        'quantity',
        'price',
        'discount_percent',
        'discount_amount',
        'description',
        'status',
        // 'is_featured',
        'is_deleted'
    ];

    public function scopeWithoutDeleted($query) {
        $query->where('is_deleted', 0);
    }

    public function scopeRecentProducts($query) {
        $query->where('is_featured', 0);
    }

    // public function scopeFeaturedProducts($query) {
    //     $query->where('is_featured', 1);
    // }

    public function scopeNewOfferProducts($query)
    {
        $query->where('discount_amount', '!=', '')
                ->orWhere('discount_percent', '!=', '');
    }

    public function scopeActive($query) {
        $query->where('status', 1);
    }

    public function getHasDiscountAttribute() {
        if (isset($this->discount_amount) && $this->discount_amount > 0) {
            return true;
        } elseif (isset($this->discount_percent) && $this->discount_percent > 0) {
            return true;
        }
        return false;
    }

    public function getDiscountPriceAttribute() {
        if (isset($this->discount_amount) && $this->discount_amount > 0) {
            return number_format(($this->price - $this->discount_amount), 2);
        } elseif (isset($this->discount_percent) && $this->discount_percent > 0) {
            return number_format($this->price - (($this->price * $this->discount_percent) / 100), 2);
        }
        return false;
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function images() {
        return $this->hasMany(ProductImage::class);
    }

}
