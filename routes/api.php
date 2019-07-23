<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function () {
    // Route::get('/products_home', 'ProductController@homePage');
});


// home page
Route::get('/products_home', 'ProductController@homePage');
Route::get('/carousel', 'SettingController@carousel');



// product profile
Route::get('/product_profile/{id}', 'ProductController@product_profile')->where('id', "[0-9]+");
