<?php
// here all routes control panel
Route::get('{path?}', 'HomeController@index')->where('path', '.*');

Route::post('/get-tables-count', 'HomeController@getCounts');

// Route::post('/cities', 'HomeController@cities'); // return all governorates and cities
Route::post('/governorates', 'HomeController@governorates'); // return all governorates and cities


//////////////////////// users routes //////////////////////////////
Route::post('/users', 'UserController@index');
Route::post('/user/update', 'UserController@update');
Route::post('/user/edit', 'UserController@edit');

Route::group(['middleware' => ['isSuperAdmin']], function () {
    Route::post('/user/store', 'UserController@store');
    Route::post('/user/destroy', 'UserController@destroy');
    Route::post('/user/restore', 'UserController@restoreUser');
    Route::post('/users-id', 'UserController@users_id');
});




/////////////////// companies routes //////////////////////////////
Route::post('/company/profile', 'CompanyController@show');
Route::post('/company/update', 'CompanyController@update');

Route::group(['middleware' => ['isSuperAdmin']], function () {
    Route::post('/companies', 'CompanyController@index');
    Route::post('/company/store', 'CompanyController@store');
    Route::post('/company/destroy', 'CompanyController@destroy');
    Route::post('/company/restore', 'CompanyController@restoreCompany');
    Route::post('/companies-id', 'CompanyController@companies_id');
});




/////////////////// products routes //////////////////////////////
Route::post('/products', 'ProductController@index');
Route::post('/product/store', 'ProductController@store');
Route::post('/product/update', 'ProductController@update');
Route::post('/product/profile', 'ProductController@show');
Route::post('/product/destroy', 'ProductController@destroy');
Route::post('/product/restore', 'ProductController@restoreProduct');
Route::post('/product/sell', 'ProductController@sell');

Route::post('/products-id', 'ProductController@products_id');


//////////////////////// products types routes //////////////////////////////
Route::post('/pro-types', 'ProductTypeController@index');
Route::post('/pro-types-data', 'ProductTypeController@allTypesUseInSelectBox');

Route::group(['middleware' => ['isSuperAdmin']], function () {
    Route::post('/pro-type/store', 'ProductTypeController@store');
    Route::post('/pro-type/update', 'ProductTypeController@update');
    Route::post('/pro-type/edit', 'ProductTypeController@edit');
    Route::post('/pro-type/destroy', 'ProductTypeController@destroy');
    Route::post('/pro-type/restore', 'ProductTypeController@restoreType');
});




//////////////////////// winners routes //////////////////////////////
Route::post('/winners', 'WinnerController@index');

Route::group(['middleware' => ['isSuperAdmin']], function () {
    Route::post('/winner/store', 'WinnerController@store');
    Route::post('/winner/update', 'WinnerController@update');
    Route::post('/winner/edit', 'WinnerController@edit');
    Route::post('/winner/destroy', 'WinnerController@destroy');
});



//////////////////////// comments routes //////////////////////////////
Route::post('/comments', 'CommentController@index');

Route::group(['middleware' => ['isSuperAdmin']], function () {
    Route::post('/comment/update', 'CommentController@update');
    Route::post('/comment/edit', 'CommentController@edit');
    Route::post('/comment/destroy', 'CommentController@destroy');
});



//////////////////////// settings routes //////////////////////////////
Route::group(['middleware' => ['isSuperAdmin']], function () {
    Route::post('/settings', 'SettingController@index');
    Route::post('/setting/store', 'SettingController@store');
    Route::post('/setting/update', 'SettingController@update');
    Route::post('/setting/edit', 'SettingController@edit');
    Route::post('/setting/destroy', 'SettingController@destroy');

    Route::post('/setting/edit/carousel', 'SettingController@editCarousel');
    Route::post('/setting/update/carousel', 'SettingController@updateCarousel');
});
