<?php

use Illuminate\Database\Seeder;

class GalleryImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //add default gallery images
        $galleryImages = array(
            [
                'gallery_img_id'=>1,
                'gallery_img_path'=>'/media/products/product_1_1.jpg'
            ],
            [
                'gallery_img_id'=>2,
                'gallery_img_path'=>'/media/products/product_1_2.jpg'
            ],
            [
                'gallery_img_id'=>3,
                'gallery_img_path'=>'/media/products/product_1_3.jpg'
            ],
            [
                'gallery_img_id'=>4,
                'gallery_img_path'=>'/media/products/product_1_4.jpg'
            ]
        );

        DB::table('gallery_images')->delete();

        foreach($galleryImages as $galleryImage){
            DB::table('gallery_images')->insert($galleryImage);
        }
    }
}
