<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //add default products
        $products = array(
            [
                'prod_id'=>1,
                'prod_name'=>'testProduct1',
                'prod_details'=>'testProduct1 details'
            ],
            [
                'prod_id'=>2,
                'prod_name'=>'testProduct2',
                'prod_details'=>'testProduct2 details'
            ]

        );

        DB::table('product')->delete();

        foreach($products as $product){
            DB::table('product')->insert($product);
        }
    }
}
