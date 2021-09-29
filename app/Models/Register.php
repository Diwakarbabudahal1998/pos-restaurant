<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    use HasFactory;
    protected $fillable = [
        'register_name',
        'rceipt_number_prefixe',
        'bill_header',
        'bill_footer',
        'printed_type',
        'printed_receipt_order',
        'include_shop_logo',
        'table_number',
        'server_ip_address',
        'kds_stale_time',
        'accept_status_order',
        'served_status_order',
        'change_status_item',
        'user_id',

    ];
}