<?php

use Illuminate\Database\Seeder;

class ProductInventoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //add default product's inventory
        $productsInventories = array(
            [
                'inven_id'=>1,
                'prod_id'=>1,
                'prod_total_qty'=>200
            ],
            [
                'inven_id'=>2,
                'prod_id'=>2,
                'prod_total_qty'=>600
            ],
        );

        DB::table('product_inventory')->delete();

        foreach($productsInventories as $productsInventory){
            DB::table('product_inventory')->insert($productsInventory);
        }
    }
}
