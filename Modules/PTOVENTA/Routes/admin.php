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
Route::middleware(['lang'])->group(function(){
Route::prefix('ptoventa/admin')->group(function() {
    Route::get('/dashboard', 'Admin\DashboardController@dashboard')->name('ptoventa.admin.dashboard');

    Route::get('/sales', 'Admin\SalesController@index')->name('ptoventa.admin.sales');
    Route::get('/sales/invoice', 'Admin\SalesController@store')->name('ptoventa.admin.sales.invoice');
    Route::get('/sales/invoice/products', 'Admin\ProductsController@show')->name('ptoventa.admin.sales.invoice.products');
}); 
});
