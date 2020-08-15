<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopProduct extends Model
{
    protected $connection = 'shop';
    protected $table = 'pts_product';
    protected $primaryKey = 'id_product';
    public $timestamps = false;
}
