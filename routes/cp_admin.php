<?php

// here all routes control panel


// dashboard
Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');
Route::view('/users', 'admin.user.index')->name('test');
