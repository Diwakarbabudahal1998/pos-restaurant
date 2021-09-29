<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appuser extends Model
{
    use HasFactory;
    protected $fillable = [
        'app_user_name',
        'app_user_pin',
    ];
}