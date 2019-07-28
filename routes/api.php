<?php

use Illuminate\Http\Request;


// global
Route::get('/cities', 'HomeController@cities'); // return all governorates and cities



// home page
Route::get('/products_home', 'ProductController@homePage'); // 8 latest product from all categories
Route::get('/carousel', 'SettingController@carousel'); // all images of carousel
Route::get('/winners', 'WinnerController@all_winners'); // all winners
Route::get('/partners', 'CompanyController@partners'); // all logos of companies

// products
Route::get('/products_category', 'ProductController@products_category'); // all products from every category
// /products_category  -- send in request this key >>>>>   "category" => id or name category
// and number page  >>>>   ?page=2   | Required
// and perPage (length in one page)  >>>>   &length=12  | optional  >>>>  default = 12

Route::get('/product_profile/{id}', 'ProductController@product_profile'); // product profile
Route::get('/products_company/{id}', 'ProductController@products_company'); // products of comoany  id = company id

// companies
Route::get('/companies', 'CompanyController@all_companies'); // all companies
Route::get('/company_profile/{id}', 'CompanyController@company_profile'); // company profile

// categories
Route::get('/categories', 'ProductTypeController@all_categories'); // all categories



Route::post('/logout', 'UserController@logout');

Route::middleware('auth:api')->group(function () {
    Route::get('/user', 'UserController@get_user_auth');

    // comments
    Route::post('/comment/store', 'CommentController@store'); // add new comment
    Route::post('/comment/update/{id}', 'CommentController@update'); // update comment
    Route::post('/comment/destroy/{id}', 'CommentController@update'); // destroy comment

    // rates
    Route::post('/company/rate/{rate}', 'CompanyController@store')->where('rate', '[12345]'); // company rate
    Route::post('/product/rate/{rate}', 'ProductController@store')->where('rate', '[12345]'); // product rate
});



