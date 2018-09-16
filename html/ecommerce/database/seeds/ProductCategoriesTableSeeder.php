<?php

use Illuminate\Database\Seeder;

class ProductCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //add default products categories
        $productsCategories = array(
            [
                'prod_id'=>1,
                'cat_id'=>1
            ],
            [
                'prod_id'=>1,
                'cat_id'=>2
            ],
            [
                'prod_id'=>2,
                'cat_id'=>3
            ]
        );

        DB::table('product_categories')->delete();

        foreach($productsCategories as $productsCategory){
            DB::table('product_categories')->insert($productsCategory);
        }
    }
}
