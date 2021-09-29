<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chashier extends Model
{
    use HasFactory;
    protected $fillable = [
        'chashier_name',
        'chashier_pin',
        'manage_permission'
    ];
}