<?php

// here all routes control panel


// // dashboard
// Route::get('/dashboard', function () {
//     return view('admin.layouts.adminLte');
// })->name('admin.dashboard');

Route::get('{path?}', 'HomeController@index')->where('path', '([A-z\d-\/_.]+)?');

// Route::view('/users', 'admin.user.index')->name('test');
