<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopProductShop extends Model
{
    protected $connection = 'shop';
    protected $table = 'pts_product_shop';
    protected $primaryKey = 'id_product';
    public $timestamps = false;
}
