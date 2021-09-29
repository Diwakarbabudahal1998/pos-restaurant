<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waiteruser extends Model
{
    use HasFactory;
    protected $fillable=[
      'waiter_name',
      'waiter_pin',  
    ];
}