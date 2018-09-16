<?php
/**
 * @package    Product Module
 * @author     Dasitha Abeysinghe <dazimax@gmail.com>
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductInventory extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $primaryKey = 'inven_id';
    protected $table = 'product_inventory';
    protected $fillable = array(
        'prod_id',
        'prod_total_qty'
    );
    protected $dates = ['deleted_at'];

    public $timestamps = true;
}
