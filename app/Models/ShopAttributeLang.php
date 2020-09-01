<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopAttributeLang extends Model
{
    protected $connection = 'shop';
    protected $table = 'pts_attribute_lang';
    protected $primaryKey = 'id_attribute';
    public $timestamps = false;
}
