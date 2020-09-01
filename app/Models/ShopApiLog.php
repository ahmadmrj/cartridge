<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShopApiLog extends Model
{
    protected $table='shop_api_logs';
    protected $fillable = [
        'product_code',
        'product_name',
        'change_field',
        'change_value',
        'ip_address'
    ];
}
