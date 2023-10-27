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
// Route::middleware(['lang'])->group(function(){

    Route::prefix('radiocefa')->group(function() {
    
        Route::get('/index', 'RADIOCEFAController@index')->name('inicioRadio');

        Route::get('/Expresate', 'RadioRouteController@Expresate')->name('Expresate');

        Route::get('/cronograma', 'RadioRouteController@cronograma')->name('cronograma');

        Route::get('/votes', 'RadioRouteController@votaciones')->name('votaciones');

        Route::get('/sobrenosotros', 'RadioRouteController@sobrenosotros')->name('aboutus');


        // parrilla de programacion
        Route::get('/parrilla', 'RadioRouteController@parrilla')->name('parrilla');



    });
// });