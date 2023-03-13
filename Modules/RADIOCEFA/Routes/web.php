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
    
    Route::get('/', 'RADIOCEFAController@index')->name('inicioRadio');

    Route::get('/peticiones', 'RadioRouteController@PetMusica')->name('peticiones');

    // Route::get('/', 'RADIOCEFAController@index')->name('inicioRadio');



});
