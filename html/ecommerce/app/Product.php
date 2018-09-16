<?php
/**
 * @package    Product Module
 * @author     Dasitha Abeysinghe <dazimax@gmail.com>
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $primaryKey = 'prod_id';
    protected $table = 'product';
    protected $fillable = array(
        'prod_name'
    );
    protected $dates = ['deleted_at'];

    public $timestamps = true;
}
