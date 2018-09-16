<?php
/**
 * @package    Product Module
 * @author     Dasitha Abeysinghe <dazimax@gmail.com>
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $primaryKey = 'cat_id';
    protected $table = 'category';
    protected $fillable = array(
        'cat_parent_id',
        'cat_name'
    );
    protected $dates = ['deleted_at'];

    public $timestamps = true;
}
