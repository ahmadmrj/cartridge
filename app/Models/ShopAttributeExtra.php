<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopAttributeExtra extends Model
{
    protected $fillable = ['id_product_attribute'];
    protected $connection = 'shop';
    protected $table = 'crm_attribute_extra_info';
    protected $primaryKey = 'id_product_attribute';
    public $timestamps = false;
}
