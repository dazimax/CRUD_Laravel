<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //add default categories
        $categories = array(
            [
                'cat_id'=>1,
                'cat_parent_id'=>0,
                'cat_name'=>'Men'
            ],
            [
                'cat_id'=>2,
                'cat_parent_id'=>1,
                'cat_name'=>'Blazers'
            ],
            [
                'cat_id'=>3,
                'cat_parent_id'=>2,
                'cat_name'=>'Sunglasses'
            ],
        );

        DB::table('category')->delete();

        foreach($categories as $category){
            DB::table('category')->insert($category);
        }
    }
}
