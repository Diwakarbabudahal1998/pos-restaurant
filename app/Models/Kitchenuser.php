<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kitchenuser extends Model
{
    use HasFactory;
    protected $fillable = [
        'kitchen_user_name',
        'kitchen_pin',
    ];
}