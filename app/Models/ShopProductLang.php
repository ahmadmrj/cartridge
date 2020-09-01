<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopProductLang extends Model
{
    protected $connection = 'shop';
    protected $table = 'pts_product_lang';
    protected $primaryKey = 'id_product';
    public $timestamps = false;
}
