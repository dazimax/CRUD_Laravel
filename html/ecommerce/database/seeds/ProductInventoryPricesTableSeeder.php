<?php

use Illuminate\Database\Seeder;

class ProductInventoryPricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //add default product's sub inventory prices
        $productsInventoryPrices = array(
            [
                'inven_id'=>1,
                'inven_qty'=>100,
                'inven_price'=>30.00
            ],
            [
                'inven_id'=>1,
                'inven_qty'=>100,
                'inven_price'=>60.00
            ],
            [
                'inven_id'=>2,
                'inven_qty'=>350,
                'inven_price'=>10.00
            ],
            [
                'inven_id'=>2,
                'inven_qty'=>250,
                'inven_price'=>20.00
            ]
        );

        DB::table('product_inventory_prices')->delete();

        foreach($productsInventoryPrices as $productsInventoryPrice){
            DB::table('product_inventory_prices')->insert($productsInventoryPrice);
        }
    }
}
