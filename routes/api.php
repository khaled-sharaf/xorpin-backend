<?php

use Illuminate\Http\Request;


// global
// Route::get('/cities', 'HomeController@cities'); // return all governorates and cities
Route::post('/logout', 'UserController@logout');
Route::post('/register', 'UserController@register');
Route::post('/forgot_password', 'UserController@forgotPassword'); // send email
Route::post('/reset_password', 'UserController@resetPassword'); // send token and new password
Route::post('/verify_email', 'UserController@verifyEmail'); // send email
// Route::post('/active_email', 'UserController@activeEmail'); // send token


// user
Route::post('/user_profile/update/{id}', 'UserController@update');


// home page

Route::get('/search', 'ProductController@search'); // global search

Route::get('/products_home', 'ProductController@homePage'); // latest 8 product from all categories
Route::get('/carousel', 'SettingController@carousel'); // all images of carousel
Route::get('/winners', 'WinnerController@all_winners'); // all winners
Route::get('/partners', 'CompanyController@partners'); // all logos of companies

// products
Route::get('/products_category/{id}', 'ProductController@products_category'); // all products from every category
// /products_category  -- send in request this key >>>>>   "category" => id category
// and number page  >>>>   ?page=2   | Required
// and perPage (length in one page)  >>>>   &length=12  | optional  >>>>  default = 12

Route::get('/product_profile/{id}', 'ProductController@product_profile'); // product profile
Route::get('/products_company/{id}', 'ProductController@products_company'); // products of comoany  id = company id

// companies
Route::get('/companies', 'CompanyController@all_companies'); // all companies
Route::get('/company_profile/{id}', 'CompanyController@company_profile'); // company profile
Route::post('/company/{id}/visits/set', 'CompanyController@set_visit'); // set visit to company
Route::get('/company/{id}/visits/get', 'CompanyController@get_visits'); // get visits number of this company

// categories
Route::get('/categories', 'ProductTypeController@all_categories'); // all categories


// apis require auth
Route::middleware('auth:api')->group(function () {
    Route::get('/user', 'UserController@get_user_auth');

    // comments
    Route::post('/comment/store', 'CommentController@store'); // add new comment
    Route::post('/comment/update/{id}', 'CommentController@update'); // update comment
    Route::post('/comment/destroy/{id}', 'CommentController@destroy'); // destroy comment

    // rates
    Route::post('/product/rate', 'ProductController@add_rate'); // product rate
    Route::post('/company/rate', 'CompanyController@add_rate'); // company rate
});



