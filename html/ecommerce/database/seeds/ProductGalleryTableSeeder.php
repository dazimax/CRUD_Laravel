<?php

use Illuminate\Database\Seeder;

class ProductGalleryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //add default product's images
        $productsImages = array(
            [
                'prod_id'=>1,
                'gallery_img_id'=>1
            ],
            [
                'prod_id'=>1,
                'gallery_img_id'=>2
            ],
            [
                'prod_id'=>2,
                'gallery_img_id'=>3
            ],
            [
                'prod_id'=>2,
                'gallery_img_id'=>4
            ]
        );

        DB::table('product_gallery')->delete();

        foreach($productsImages as $productsImage){
            DB::table('product_gallery')->insert($productsImage);
        }
    }
}
