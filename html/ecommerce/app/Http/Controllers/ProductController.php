<?php
/**
 * @package    Product Module
 * @author     Dasitha Abeysinghe <dazimax@gmail.com>
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Request as ValidationRequest;
use App\Http\Requests;
use App\Product;
use App\Category;
use App\GalleryImages;
use App\ProductCategories;
use App\ProductGallery;
use App\ProductInventory;
use App\ProductInventoryPrices;
use DB;

class ProductController extends Controller
{
    public function searchProducts()
    {
        //load product list
        $productsList = Product::all()
            ->where('prod_is_visible', 1);

        //load categories
        $productCategories = DB::table('category')->select('category.*')
            ->whereNull('category.deleted_at')
            ->get();

        return view('layouts.master.app')
            ->with('products', $productsList)
            ->with('defaultcategories', $productCategories);
    }

    public function saveProduct(Request $requestObj)
    {
        $this->status = true;
        $requestParams = $requestObj->all();

        if (count($requestParams) > 0) {

            if (empty($requestParams['prod_name'])) {
                $this->msg = "Please provide all the necessary details.!";
                $this->status = false;
            }

            $images = $requestObj->file('gallery_img_path');
            if (is_array($images) && $images[0] != null) {
                foreach ($images as $image) {
                    $file_extension = $image->getMimeType();
                    if ($file_extension == 'image/jpeg' || $file_extension == 'image/jpg' || $file_extension == 'image/png') {
                        $this->status = true;
                    } else {
                        $this->msg = "Please upload correct product image type!";
                        $this->status = false;
                    }
                }
            }

            if ($this->status) {

                try {

                    //add or update product info
                    if (isset($requestParams['prod_id']) && !empty($requestParams['prod_id'])) {
                        $productId = $requestParams['prod_id'];
                        $isProductExists = Product::where('prod_id', $productId)->exists();
                        if ($isProductExists) {
                            $productObj = Product::where('prod_id', $productId);
                        } else {
                            $productObj = new Product();
                        }
                    } else {
                        $productObj = new Product();
                    }

                    //add product info
                    $productObj->prod_name = $requestParams['prod_name'];
                    $productObj->prod_details = $requestParams['prod_details'];
                    $productObj->prod_is_visible = $requestParams['prod_is_visible'];
                    $productObj->save(); //generate id

                    //link product categories
                    $productCategoriesArray = $requestParams['category'];
                    if (count($productCategoriesArray) > 0) {
                        $productCategoriesObj = new ProductCategories();
                        //remove exists linked categories
                        DB::table('product_categories')->where('prod_id', '=', $productObj->prod_id)->delete();
                        //linked new product categories
                        foreach ($productCategoriesArray as $productCategory) {
                            $productCategoriesObj->prod_id = $productObj->prod_id;
                            $productCategoriesObj->cat_id = $productCategory;
                        }
                        $productCategoriesObj->save();
                    }

                    //add gallery images
                    $productGalleryImagesIDsArray = array();
                    //upload the image file
                    if (is_array($images) && $images[0] != null) {
                        $productGalleryObj = new GalleryImages();
                        $destinationPath = public_path('/media/products');
                        $destinationImagesPath = '/media/products';
                        foreach ($images as $image) {
                            $productImgName = $productObj->prod_id . '_product_image' . time() . '.' . $image->getClientOriginalExtension();
                            $image->move($destinationPath, $productImgName);
                            $productImgPath = $destinationImagesPath . '/' . $productImgName;
                            //add the product gallery image to DB
                            $productGalleryObj->gallery_img_path = $productImgPath;
                            $productGalleryObj->save();
                            $productGalleryImagesIDsArray[] = $productGalleryObj->gallery_img_id;
                        }
                    }

                    //link gallery images with product
                    if (count($productGalleryImagesIDsArray) > 0) {
                        $galleryImagesObj = new ProductGallery();
                        //remove exists linked product images
                        DB::table('product_gallery')->where('prod_id', '=', $productObj->prod_id)->delete();
                        //linked new product images
                        foreach ($productGalleryImagesIDsArray as $productGalleryImagesID) {
                            $galleryImagesObj->prod_id = $productObj->prod_id;
                            $galleryImagesObj->gallery_img_id = $productGalleryImagesID;
                        }
                        $galleryImagesObj->save();
                    }

                    //add product inventory
                    $productInventoryQtyArray = $requestParams['inven_qty'];
                    $productInventoryPriceArray = $requestParams['inven_price'];
                    if (count($productInventoryQtyArray) > 0) {
                        if (count($productInventoryQtyArray) == count($productInventoryPriceArray)) {
                            $productInventoryObj = new ProductInventory();
                            $productTotalQty = 0;
                            //remove existing product inventory
                            DB::table('product_inventory')->where('prod_id', '=', $productObj->prod_id)->delete();
                            //add total inevntory qty
                            foreach ($productInventoryQtyArray as $productInventoryQty) {
                                $productTotalQty += $productInventoryQty;
                            }
                            if ($productTotalQty > 0) {
                                $productInventoryObj->prod_id = $productObj->prod_id;
                                $productInventoryObj->prod_total_qty = $productTotalQty;
                                $productInventoryObj->save();
                            } else {
                                $this->msg = "Please add correct product Qty!";
                            }
                        } else {
                            $this->msg = "Please add correct product Qty and Prices!";
                        }
                    }

                    //add product inventory with prices
                    if (count($productInventoryQtyArray) > 0) {
                        if (count($productInventoryQtyArray) == count($productInventoryPriceArray)) {
                            if ($productTotalQty > 0) {
                                $productInventoryPricesObj = new ProductInventoryPrices();
                                //remove existing product inventory prices
                                DB::table('product_inventory_prices')->where('inven_id', '=', $productInventoryObj->inven_id)->delete();
                                //add product inventory qty and prices
                                foreach ($productInventoryQtyArray as $qtyIndex => $productInventoryQty) {
                                    $productInventoryPricesObj->inven_id = $productInventoryObj->inven_id;
                                    $productInventoryPricesObj->inven_qty = $productInventoryQty;
                                    $productInventoryPricesObj->inven_price = $productInventoryPriceArray[$qtyIndex];
                                    $productInventoryPricesObj->save();
                                }
                            } else {
                                $this->msg = "Please add correct product Qty!";
                            }
                        } else {
                            $this->msg = "Please add correct product Qty and Prices!";
                        }
                    }

                    return redirect()->action('ProductController@searchProducts')->with('products', Product::all());

                } catch (Exception $e) {
                    $this->msg = $e->getMessage();
                }

            } else {
                if (empty($this->msg)) {
                    $this->msg = "Please verify all the form inputs.";
                }
                return back()->withErrors($this->msg);
            }
        } else {
            return redirect()->action('ProductController@searchProducts')->with('products', Product::all());
        }

    }

    public function viewProduct($productId)
    {
        $this->status = true;

        if (empty($productId)) {
            $this->msg = "Product not identified";
            $this->status = false;
        }

        if ($this->status) {
            $isProductExists = Product::where('prod_id', $productId)->exists();
            if ($isProductExists) {
                //load product details
                $productObj = Product::find($productId);

                //load product categories
                $productCategories = DB::table('category')->select('category.*')
                    ->join('product_categories', 'product_categories.cat_id', '=', 'category.cat_id')
                    ->whereNull('category.deleted_at')
                    ->where(['product_categories.prod_id' => $productId])
                    ->get();

                //load product images
                $productImages = DB::table('gallery_images')->select('gallery_images.*')
                    ->join('product_gallery', 'product_gallery.gallery_img_id', '=', 'gallery_images.gallery_img_id')
                    ->whereNull('gallery_images.deleted_at')
                    ->where(['product_gallery.prod_id' => $productId])
                    ->get();

                //load product inventory & prices
                $productInventoryPrices = DB::table('product_inventory_prices')->select('product_inventory_prices.*')
                    ->join('product_inventory', 'product_inventory.inven_id', '=', 'product_inventory_prices.inven_id')
                    ->whereNull('product_inventory_prices.deleted_at')
                    ->where(['product_inventory.prod_id' => $productId])
                    ->get();

                //load categories
                $defaultCategories = DB::table('category')->select('category.*')
                    ->whereNull('category.deleted_at')
                    ->get();

                return view('layouts.master.app')
                    ->with('products', Product::all())
                    ->with('product', $productObj)
                    ->with('categories', $productCategories)
                    ->with('images', $productImages)
                    ->with('inventoryprices', $productInventoryPrices)
                    ->with('defaultcategories', $defaultCategories);




            } else {
                $this->msg = "Product not exists.";
                return back()->withErrors($this->msg);
            }
        } else {
            return back()->withErrors($this->msg);
        }
    }

    public function removeProduct($productId)
    {

        $this->status = true;

        if (empty($productId)) {
            $this->msg = "Product not identified.";
            $this->status = false;
        }

        if ($this->status) {
            $isProductExists = Product::where('prod_id', $productId)->exists();
            if ($isProductExists) {
                //remove product
                $productObj = Product::find($productId);
                $productObj->delete();
                return redirect()->action('ProductController@searchProducts')->with('products', Product::all());
            } else {
                $this->msg = "Product not exists.";
                return back()->withErrors($this->msg);
            }
        } else {
            return back()->withErrors($this->msg);
        }
    }
}
