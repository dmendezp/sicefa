<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('cafeto/admin')->group(function() {
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('cafeto.admin.dashboard');

    Route::get('/sales', 'Admin\SalesController@index')->name('cafeto.admin.sales');
});
