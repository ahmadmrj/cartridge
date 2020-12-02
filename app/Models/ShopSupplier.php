<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopSupplier extends Model
{
    protected $connection = 'shop';
    protected $table = 'crm_supplier';
    protected $fillable = ['supplier_title','tell','mobile','address','website','card','description'];
    public $timestamps = false;

    /**
     * Get all of the products that are assigned this tag.
     */
    public function products()
    {
        return $this->morphedByMany(ShopProduct::class, 'supplierable');
    }

    /**
     * Get all of the attributes that are assigned this tag.
     */
    public function attributes()
    {
        return $this->morphedByMany(ShopProductAttribute::class, 'supplierable');
    }
}
