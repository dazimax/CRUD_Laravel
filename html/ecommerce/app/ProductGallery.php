<?php
/**
 * @package    Product Module
 * @author     Dasitha Abeysinghe <dazimax@gmail.com>
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductGallery extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'product_gallery';
    protected $fillable = array(
        'prod_id',
        'gallery_img_id'
    );
    protected $dates = ['deleted_at'];

    public $timestamps = true;
}
