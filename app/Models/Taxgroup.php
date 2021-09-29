<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taxgroup extends Model
{
    use HasFactory;
    protected $fillable = [
        'tax_group_name',
        'tax_inclusive_product'
    ];
    public function product()
    {
        return $this->hasMany(Product::class);
    }
}