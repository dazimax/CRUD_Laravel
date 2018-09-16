<?php
/**
 * @package    Product Module
 * @author     Dasitha Abeysinghe <dazimax@gmail.com>
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategories extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'product_categories';
    protected $fillable = array(
        'prod_id',
        'cat_id'
    );
    protected $dates = ['deleted_at'];

    public $timestamps = true;
}
