<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopCategory extends Model
{
    protected $connection = 'shop';
    protected $table = 'pts_category';
    protected $primaryKey = 'id_category';
    public $timestamps = false;
}
