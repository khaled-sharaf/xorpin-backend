<?php

// here all routes control panel

Route::get('{path?}', 'HomeController@index')->where('path', '([A-z\d-\/_.]+)?');

//////////////////////// users routes //////////////////////////////
Route::post('/users', 'UserController@index');
Route::post('/user/store', 'UserController@store');
Route::post('/user/update', 'UserController@update');
Route::post('/user/edit', 'UserController@edit');
Route::post('/user/destroy', 'UserController@destroy');
Route::post('/user/restore', 'UserController@restoreUser');
Route::post('/users-id', 'UserController@users_id');



/////////////////// companies routes //////////////////////////////
Route::post('/companies', 'CompanyController@index');
Route::post('/company/store', 'CompanyController@store');
Route::post('/company/update', 'CompanyController@update');
Route::post('/company/profile', 'CompanyController@show');
Route::post('/company/destroy', 'CompanyController@destroy');
Route::post('/company/restore', 'CompanyController@restoreCompany');
Route::post('/companies-id', 'CompanyController@companies_id');


/////////////////// products routes //////////////////////////////
Route::post('/products', 'ProductController@index');
Route::post('/product/store', 'ProductController@store');
Route::post('/product/update', 'ProductController@update');
Route::post('/product/profile', 'ProductController@show');
Route::post('/product/destroy', 'ProductController@destroy');
Route::post('/product/restore', 'ProductController@restoreProduct');
Route::post('/products-id', 'ProductController@products_id');


//////////////////////// products types routes //////////////////////////////
Route::post('/pro-types', 'ProductTypeController@index');
Route::post('/pro-type/store', 'ProductTypeController@store');
Route::post('/pro-type/update', 'ProductTypeController@update');
Route::post('/pro-type/edit', 'ProductTypeController@edit');
Route::post('/pro-type/destroy', 'ProductTypeController@destroy');
Route::post('/pro-type/restore', 'ProductTypeController@restoreType');

Route::post('/pro-types-data', 'ProductTypeController@allTypesUseInSelectBox');




//////////////////////// winners routes //////////////////////////////
Route::post('/winners', 'WinnerController@index');
Route::post('/winner/store', 'WinnerController@store');
Route::post('/winner/update', 'WinnerController@update');
Route::post('/winner/edit', 'WinnerController@edit');
Route::post('/winner/destroy', 'WinnerController@destroy');






// Route::view('/users', 'admin.user.index')->name('test');
