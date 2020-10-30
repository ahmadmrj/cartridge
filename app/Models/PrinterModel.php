<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PrinterModel
 *
 * @property int $id
 * @property int $family_id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PrinterFamily $family
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrinterModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrinterModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrinterModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrinterModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrinterModel whereFamilyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrinterModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrinterModel whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrinterModel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PrinterModel extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'printer_models';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
     protected $fillable = [
         'title',
         'family_id',
         'technical_title',
         'buy_link',
         'key_words',
         'seo_title',
         'description'
     ];
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
    public function family() {
        return $this->belongsTo('App\Models\PrinterFamily');
    }

    public function medias() {
        return $this->hasMany(
            'App\Models\PrinterModelMedia',
            'printer_model_id',
            'id'
        );
    }

    public function cartridges() {
        return $this->belongsToMany(
            'App\Models\Cartridge',
            'printer_cartridge',
            'printer_id',
            'cartridge_id'
        );
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
