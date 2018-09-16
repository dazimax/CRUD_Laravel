<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('CategoryTableSeeder');
        $this->call('ProductTableSeeder');
        $this->call('ProductCategoriesTableSeeder');
        $this->call('GalleryImagesTableSeeder');
        $this->call('ProductGalleryTableSeeder');
        $this->call('ProductInventoryTableSeeder');
        $this->call('ProductInventoryPricesTableSeeder');
    }
}
