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

Route::prefix('radiocefa')->group(function() {
    
    Route::get('/', 'RADIOCEFAController@index');

    // Route::get('/abouts', 'RADIOCEFAController@index')->mane('inicioRadio');

    // Route::get('/', 'RADIOCEFAController@index')->mane('inicioRadio');



});
