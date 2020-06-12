<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class CartridgeMedia extends Model
{
    protected $table = 'cartridge_medias';
//    protected $attributes = ['picture'];
    protected $fillable = ['cartridge_id', 'address'];

//    public function getPictureAttribute() {
//        return '<img src="$this->address" />';
//    }

}
