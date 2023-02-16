<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['name', 'slug', 'thumbnail', 'status', 'is_deleted'];

    public function scopeWithoutDeleted($query) {
        $query->where('is_deleted', 0);
    }

    public function scopeActive($query) {
        $query->where('status', 1);
    }

    public function products() {
        return $this->hasMany(Product::class);
    }
}
