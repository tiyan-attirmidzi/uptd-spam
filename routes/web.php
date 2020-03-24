<?php

use Illuminate\Support\Facades\Route;


Auth::routes(['register' => false]);

Route::get('/', function () {
    return view('auth.login');
});

Route::group([
    'middleware' => [
        'check.access',
        'auth'
    ]
], function () {

    // Admin Route
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', 'Admin\ControllerHome@index')->name('admin.home');
    });

    // Officer Route
    Route::group(['prefix' => 'officer'], function () {
        Route::get('/', 'Officer\ControllerHome@index')->name('officer.home');
    });

});
