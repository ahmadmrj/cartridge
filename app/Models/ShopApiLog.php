<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopApiLog extends Model
{
    protected $table='shop_api_logs';
    protected $fillable = [
        'product_code',
        'product_name',
        'attribute_name',
        'change_field',
        'change_value',
        'ip_address'
    ];
}
