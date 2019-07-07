<?php

// change language form this link -- method (get)
// Route::get('lang/{lang}', 'LangController@lang')->name('lang');
/**********************************************************************************/

Auth::routes();

Route::get('/not-active', 'HomeController@index')->name('home');
