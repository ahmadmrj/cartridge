<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PrinterFamily
 *
 * @property int $id
 * @property int $brand_id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\models\PrinterBrand $brand
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrinterFamily newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrinterFamily newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrinterFamily query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrinterFamily whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrinterFamily whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrinterFamily whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrinterFamily whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrinterFamily whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PrinterFamily extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'printer_families';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['title', 'brand_id'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function brand() {
        return $this->belongsTo('App\Models\PrinterBrand');
    }

    public function printers() {
        return $this->hasMany('App\Models\PrinterModel');
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
