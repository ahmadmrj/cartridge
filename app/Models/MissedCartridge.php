<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class MissedCartridge extends Model
{
    use CrudTrait;

    protected $table = 'missed_cartridges';
    protected $fillable = ['title', 'phone_number'];
}
