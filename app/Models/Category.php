<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'parent_id', 'thumbnail', 'status', 'is_deleted'];

    public function scopeWithoutDeleted($query) {
        $query->where('is_deleted', 0);
    }

    public function scopeActive($query) {
        $query->where('status', 1);
    }

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function parent() {
        return $this->belongsTo(Category::class, 'parent_id')->where('is_deleted', 0); 
    }
    
    public function children() {
        return $this->hasMany(Category::class, 'parent_id')->where('is_deleted', 0); 
    }
}
