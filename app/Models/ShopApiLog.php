<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\CalendarUtils;

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

    public function getCreatedAtAttribute($value)
    {
        $reval = date('Y-m-d',strtotime($value));

        $reval = CalendarUtils::strftime('H:i Y/m/d', strtotime($value));

        return $reval;
    }

    public function getChangeValueAttribute($value) {
        return is_numeric($value) ? number_format($value) : $value;
    }
    public function getChangeFieldAttribute($value) {
        $change = [
            'description' => 'توضیحات',
            'price' => 'قیمت فروش',
            'wholesale_price' => 'قیمت خرید',
            'quantity' => 'موجودی',
        ];

        return $change[$value];
    }
}
