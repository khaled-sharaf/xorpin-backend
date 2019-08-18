<?php

Route::group(['prefix' => env('CP_PREFIX')], function () {
    Auth::routes(['register' => false]);
});

// route login social media
Route::namespace('Auth')->group(function () {
    Route::get('auth/{provider}', 'LoginController@redirectToProvider');
    Route::get('auth/{provider}/callback', 'LoginController@handleProviderCallback');
});





// change language form this link -- method (get)
// Route::get('lang/{lang}', 'LangController@lang')->name('lang');
/**********************************************************************************/

// use App\Product as pro;
// use App\User;
// use App\Company;
// use App\ProductType;
// use App\Winner;
// use App\City;

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/get_token_socialite', function () {
    if (!session()->has('status_active')) {
        return redirect('/');
    }
});

Route::get('/verify-email', 'API\UserController@activeEmail');

Route::get('/', function () {
    return view('welcome');

    // $pro = Pro::find(3)->comments()->with('user')->get();
    // $pro = Pro::find(3)->with('rates')->get();
    // $pro = Company::with(['products', 'rates'])->get();
    // $pro = ProductType::with('products')->get();
    // $pro = ProductDetails::with(['products', 'productType'])->get();
    // $pro = Winner::get();

    // dd(City::find(5)->city_name, City::find(5)->governorate->governorate_name);

    // \Image::make('C:\xampp\htdocs\Belal\xorpin-backend\public\images\camera.png')
    //         ->resize(100, 100)
    //         ->save('C:\xampp\htdocs\Belal\xorpin-backend\public\images\camera1.png');


});
