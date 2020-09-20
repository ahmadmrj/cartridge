<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrmCustomer extends Model
{
    protected $table = 'crm_customer';

    public function city() {
        return $this->belongsTo('App\Province');
    }
}
