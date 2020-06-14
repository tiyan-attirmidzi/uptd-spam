<?php

use Illuminate\Support\Facades\Route;

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

    Route::get('dashboard', 'Auth\LoginController@dashboard')->name('dashboard');
    Route::get('transactions', 'ControllerTransactions@index')->name('transactions.index');
    Route::get('transactions/input/usage/show', 'ControllerTransactions@inputUsageShow')->name('transactions.input.usage.show');
    Route::post('transactions/input/usage', 'ControllerTransactions@inputUsage')->name('transactions.input.usage');
    Route::post('transactions/fetch', 'ControllerTransactions@fetchCustomerActive')->name('transactions.fetch');
    Route::post('transactions/check', 'ControllerTransactions@billingCheck')->name('transactions.check');
    Route::post('transactions/pay/{customer_id}/{billing_number}', 'ControllerTransactions@pay')->name('transactions.pay');
    Route::get('transactions/history/month/unpaidoff', 'ControllerTransactions@transactionHistoryPerMonth')->name('transactions.unpaidoff');
    Route::get('transactions/history/month/alreadypaid', 'ControllerTransactions@transactionHistoryPerMonth')->name('transactions.alreadypaid');
    Route::get('transactions/alldata', 'ControllerTransactions@pay')->name('transactions.alldata');
    Route::get ( 'sop/other_costs', 'ControllerOtherCosts@index' )->name('other_costs.index');
    Route::post ( 'sop/other_costs/update', 'ControllerOtherCosts@update' )->name('other_costs.update');
    Route::resource('customers', 'ControllerCustomers');
    Route::resource('sop/description_costs', 'ControllerDescriptionCosts');

});

Auth::routes(['register' => false]);


