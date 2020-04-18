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
        Route::resource('users', 'Admin\ControllerUsers');
    });

    // Officer Route
    Route::group(['prefix' => 'officer', 'middleware' => 'is.officer'], function () {
        Route::get('/', 'Officer\ControllerHome@index')->name('officer.home');
    });

    Route::get('transactions', 'ControllerTransactions@index')->name('transactions.index');
    Route::post('transactions/check', 'ControllerTransactions@billingCheck')->name('transactions.check');
    Route::post('transactions/pay', 'ControllerTransactions@pay')->name('transactions.pay');
    Route::resource('customers', 'ControllerCustomers');
    Route::resource('sop/description_costs', 'ControllerDescriptionCosts');

});
