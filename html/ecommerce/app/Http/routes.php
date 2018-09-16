<?php
/**
 * @package    Product Module
 * @author     Dasitha Abeysinghe <dazimax@gmail.com>
 */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middlewareGroups' => 'web'], function() {
	//Controllers
	Route::any('/','ProductController@searchProducts');
	Route::post('/save','ProductController@saveProduct');
	Route::any('/view/{id}','ProductController@viewProduct');
	Route::any('/remove/{id}','ProductController@removeProduct');

});
