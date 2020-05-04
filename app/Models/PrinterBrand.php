<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class PrinterBrand extends Model
{
    use CrudTrait;

    protected $table = 'printer_brands';
}
