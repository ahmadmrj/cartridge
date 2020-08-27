<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopProductAttributeShop extends Model
{
    protected $connection = 'shop';
    protected $table = 'pts_product_attribute_shop';
    protected $primaryKey = 'id_product_attribute';
    public $timestamps = false;
}
