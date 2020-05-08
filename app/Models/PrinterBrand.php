<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Support\Str;

/**
 * App\models\PrinterBrand
 *
 * @property int $id
 * @property string $title
 * @property string|null $picture
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\PrinterBrand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\PrinterBrand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\PrinterBrand query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\PrinterBrand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\PrinterBrand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\PrinterBrand wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\PrinterBrand whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\models\PrinterBrand whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PrinterBrand extends Model
{
    use CrudTrait;

    protected $table = 'printer_brands';
    protected $fillable = ['title', 'picture'];

    public function setPictureAttribute($value)
    {
        $attribute_name = "picture";
        $disk = config('backpack.base.root_disk_name'); // or use your own disk, defined in config/filesystems.php
        $destination_path = "public/uploads/brand_images"; // path relative to the disk above

        // if the image was erased
        if ($value==null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (starts_with($value, 'data:image'))
        {
            // 0. Make the image
            $image = \Image::make($value)->encode('jpg', 90);

            // 1. Generate a filename.
            $filename = md5($value.time()).'.jpg';

            // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());

            // 3. Delete the previous image, if there was one.
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // 4. Save the public path to the database
            // but first, remove "public/" from the path, since we're pointing to it from the root folder
            // that way, what gets saved in the database is the user-accesible URL
            $public_destination_path = Str::replaceFirst('public/', '', $destination_path);
            $this->attributes[$attribute_name] = $public_destination_path.'/'.$filename;

        }
    }
}
