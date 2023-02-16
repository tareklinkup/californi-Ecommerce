<?php

namespace App\Models;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'user_id', 
        'shipping_name', 
        'shipping_phone', 
        'shipping_address', 
        'shipping_region', 
        'sub_total', 
        'vat', 
        'total', 
        'shipping_charge'
    ];

    public function scopeWithoutDeleted($query) {
        $query->where('is_delete', 0);
    }

    public function scopeMyOrders($query) {
        $query->where('user_id', Auth::id())->where('is_delete', 0);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function order_products() {
        return $this->hasMany(OrderProduct::class);
    }
}
