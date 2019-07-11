<?php

// here all routes control panel


// // dashboard
// Route::get('/dashboard', function () {
//     return view('admin.layouts.adminLte');
// })->name('admin.dashboard');

Route::get('{path?}', 'HomeController@index')->where('path', '([A-z\d-\/_.]+)?');

//////////////////////// users routes //////////////////////////////
Route::post('/users', 'UserController@index');
Route::post('/user/store', 'UserController@store');
Route::post('/user/update', 'UserController@update');
Route::post('/user/edit', 'UserController@edit');
Route::post('/user/destroy', 'UserController@destroy');
Route::post('/user/restore', 'UserController@restoreUser');



/////////////////// companies routes //////////////////////////////
Route::post('/companies', 'CompanyController@index');
Route::post('/company/store', 'CompanyController@store');
Route::post('/company/update', 'CompanyController@update');
Route::post('/company/profile', 'CompanyController@show');
Route::post('/company/destroy', 'CompanyController@destroy');
Route::post('/company/restore', 'CompanyController@restoreCompany');
Route::post('/companies-id', 'CompanyController@companies_id');


//////////////////////// users routes //////////////////////////////
Route::post('/pro-types', 'ProductTypeController@index');
Route::post('/pro-type/store', 'ProductTypeController@store');
Route::post('/pro-type/update', 'ProductTypeController@update');
Route::post('/pro-type/edit', 'ProductTypeController@edit');
Route::post('/pro-type/destroy', 'ProductTypeController@destroy');
Route::post('/pro-type/restore', 'ProductTypeController@restoreType');





// Route::view('/users', 'admin.user.index')->name('test');
