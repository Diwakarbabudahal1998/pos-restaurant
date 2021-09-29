<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variantgroup extends Model
{
    use HasFactory;
    protected $fillable = [
        'variant_group_name',
        'sort_order',
        'user_id',
    ];
    public function variant()
    {
        return $this->hasMany(Variant::class,'user_id');
    }
}