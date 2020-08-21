<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopStockAvailable extends Model
{
    protected $connection = 'shop';
    protected $table = 'pts_stock_available';
    protected $primaryKey = 'id_stock_available';
    public $timestamps = false;
}
