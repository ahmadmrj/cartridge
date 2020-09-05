<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrinterModelMedia extends Model
{
    protected $table = 'printer_medias';
//    protected $attributes = ['picture'];
    protected $fillable = ['printer_model_id', 'address'];

//    public function getPictureAttribute() {
//        return '<img src="$this->address" />';
//    }

}
