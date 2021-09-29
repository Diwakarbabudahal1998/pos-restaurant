<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'price', 'product_name', 'category_id', 'tax_group_id',
    ];
    public function productcategory()
    {
        return $this->belongsTo(Productcategory::class, 'category_id');
    }
    public function taxgroup()
    {
        return $this->belongsTo(Taxgroup::class, 'tax_group_id');
    }
}