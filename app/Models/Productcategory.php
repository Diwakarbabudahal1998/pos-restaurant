<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productcategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_category_name',
        'sort_order',
        
    ];
    public function product()
    {
        return $this->hasMany(Product::class);
    }
}