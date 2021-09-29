<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addongroup extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'addon_group_name',
        'sort_order',
        'min_table',
        'max_table'
    ];
    public function addon()
    {
        return $this->hasMany(Addon::class, 'id');
    }
}