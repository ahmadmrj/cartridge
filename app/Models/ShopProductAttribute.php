<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopProductAttribute extends Model
{
    protected $connection = 'shop';
    protected $table = 'pts_product_attribute';
    protected $primaryKey = 'id_product_attribute';
    public $timestamps = false;
}
