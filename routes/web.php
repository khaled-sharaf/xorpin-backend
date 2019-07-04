<?php

// change language form this link -- method (get)
Route::get('lang/{lang}', 'LangController@lang')->name('lang');
/**********************************************************************************/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
