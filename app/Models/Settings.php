<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = [
        'logo', 
        'shop_name', 
        'address',
        'vat',
        'phone_1', 
        'phone_2', 
        'email_1', 
        'email_2', 
        'facebook', 
        'twitter', 
        'youtube', 
        'vimeo'
    ];
}
