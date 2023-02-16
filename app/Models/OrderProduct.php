<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model 
{
    protected $table = 'order_product';

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}