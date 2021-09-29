<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $fillable = [
        'shop_name',
        'business_type',
        'city',
        'shop_owner_pin',
        'website_link',
        'facebook_link',
        'instagram_link',
        'name',
        'email',
        'phone',
        'image',
        'user_id',

    ];
}