<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopProductExtra extends Model
{
    protected $fillable = ['id_product'];
    protected $connection = 'shop';
    protected $table = 'crm_product_extra_info';
    protected $primaryKey = 'id_product';
    public $timestamps = false;
}
