<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartridgeMedia extends Model
{
    protected $table = 'cartridge_medias';
//    protected $attributes = ['picture'];
    protected $fillable = ['cartridge_id', 'address', 'is_default'];

//    public function getPictureAttribute() {
//        return '<img src="$this->address" />';
//    }

}
