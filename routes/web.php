<?php

// change language form this link -- method (get)
// Route::get('lang/{lang}', 'LangController@lang')->name('lang');
/**********************************************************************************/

use App\Product as pro;
use App\User;
use App\Company;
use App\ProductType;
use App\ProductDetails;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {

    // $pro = Pro::find(3)->comments()->with('user')->get();
    // $pro = Pro::find(3)->with('rates')->get();
    // $pro = Company::with(['products', 'rates'])->get();
    // $pro = ProductType::with('products')->get();
    $pro = ProductDetails::with(['products', 'productType'])->get();


    // dd($pro);
    dd($pro->toArray());


    return view('welcome');
});
