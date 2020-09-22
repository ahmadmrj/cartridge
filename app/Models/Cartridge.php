<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Pishran\LaravelPersianSlug\HasPersianSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * App\Models\Cartridge
 *
 * @property int $id
 * @property string $title
 * @property int $page_yield
 * @property string $color
 * @property string|null $buy_link
 * @property string $picture
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PrinterModel[] $printers
 * @property-read int|null $printers_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cartridge newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cartridge newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cartridge query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cartridge whereBuyLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cartridge whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cartridge whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cartridge whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cartridge wherePageYield($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cartridge wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cartridge whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cartridge whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cartridge whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Cartridge extends Model
{
    use CrudTrait;
    use HasPersianSlug;
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'cartridges';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
     protected $fillable = [
         'title',
         'technical_title',
         'description',
         'key_words',
         'seo_title',
         'color',
         'page_yield',
         'buy_link',
         'picture',
         'slug'
     ];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function printers() {
        return $this->belongsToMany(
            'App\Models\PrinterModel',
            'printer_cartridge',
            'cartridge_id',
            'printer_id'
        );
    }

    public function medias() {
        return $this->hasMany(
            'App\Models\CartridgeMedia',
            'cartridge_id',
            'id'
        );
    }

    public function tags() {
        return $this->belongsToMany('App\Models\Tag');
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
//    public function setPictureAttribute($value)
//    {
//        $attribute_name = "picture";
//        $disk = config('backpack.base.root_disk_name'); // or use your own disk, defined in config/filesystems.php
//        $destination_path = "public/uploads/cartridge_images"; // path relative to the disk above
//
//        // if the image was erased
//        if ($value==null) {
//            // delete the image from disk
//            \Storage::disk($disk)->delete($this->{$attribute_name});
//
//            // set null in the database column
//            $this->attributes[$attribute_name] = null;
//        }
//
//        // if a base64 was sent, store it in the db
//        if (starts_with($value, 'data:image'))
//        {
//            // 0. Make the image
//            $image = \Image::make($value)->encode('jpg', 90);
//
//            // 1. Generate a filename.
//            $filename = md5($value.time()).'.jpg';
//
//            // 2. Store the image on disk.
//            \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());
//
//            // 3. Delete the previous image, if there was one.
//            \Storage::disk($disk)->delete($this->{$attribute_name});
//
//            // 4. Save the public path to the database
//            // but first, remove "public/" from the path, since we're pointing to it from the root folder
//            // that way, what gets saved in the database is the user-accesible URL
//            $public_destination_path = Str::replaceFirst('public/', '', $destination_path);
//            $this->attributes[$attribute_name] = $public_destination_path.'/'.$filename;
//
//        }
//    }
}
