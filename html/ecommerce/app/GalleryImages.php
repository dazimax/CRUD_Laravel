<?php
/**
 * @package    Product Module
 * @author     Dasitha Abeysinghe <dazimax@gmail.com>
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GalleryImages extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $primaryKey = 'gallery_img_id';
    protected $table = 'gallery_images';
    protected $fillable = array(
        'gallery_img_path'
    );
    protected $dates = ['deleted_at'];

    public $timestamps = true;
}
