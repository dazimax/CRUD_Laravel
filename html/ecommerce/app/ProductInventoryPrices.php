<?php
/**
 * @package    Product Module
 * @author     Dasitha Abeysinghe <dazimax@gmail.com>
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductInventoryPrices extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'product_inventory_prices';
    protected $fillable = array(
        'inven_id',
        'inven_qty',
        'inven_price'
    );
    protected $dates = ['deleted_at'];

    public $timestamps = true;
}
