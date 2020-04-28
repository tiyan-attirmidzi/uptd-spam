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
    Route::get('transactions/input/usage/show', 'ControllerTransactions@inputUsageShow')->name('transactions.input.usage.show');
    Route::post('transactions/input/usage', 'ControllerTransactions@inputUsage')->name('transactions.input.usage');
    Route::post('transactions/fetch', 'ControllerTransactions@fetchCustomerActive')->name('transactions.fetch');
    Route::post('transactions/check', 'ControllerTransactions@billingCheck')->name('transactions.check');
    Route::post('transactions/pay', 'ControllerTransactions@pay')->name('transactions.pay');
    Route::post('customers/delete', 'ControllerCustomers@delete');
    Route::resource('customers', 'ControllerCustomers')->except(['destroy']);
    Route::resource('sop/description_costs', 'ControllerDescriptionCosts');

});
