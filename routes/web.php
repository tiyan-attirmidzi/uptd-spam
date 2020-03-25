<?php

use Illuminate\Support\Facades\Route;


Auth::routes(['register' => false]);

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'auth'], function () {

    // Admin Route
    Route::group(['prefix' => 'admin', 'middleware' => 'is.admin'], function () {
        Route::get('/', 'Admin\ControllerHome@index')->name('admin.home');
    });

    // Officer Route
    Route::group(['prefix' => 'officer', 'middleware' => 'is.officer'], function () {
        Route::get('/', 'Officer\ControllerHome@index')->name('officer.home');
    });

    Route::resource('customers', 'ControllerCustomers');

});
