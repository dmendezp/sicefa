<?php

use Illuminate\Support\Facades\Route;

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

Route::prefix('hdc')->group(function() {

    Route::get('index', 'HDCController@index')->name('cefa.hdc.index');

    /* Rutas de Pecuaria */
    Route::get('bovinos', 'PecuariaController@bovinos')->name('cefa.hdc.bovinos');
    Route::get('equinos', 'PecuariaController@equinos')->name('cefa.hdc.equinos');
    Route::get('ovinos', 'PecuariaController@ovinos')->name('cefa.hdc.ovinos');
    Route::get('piscicola', 'PecuariaController@piscicola')->name('cefa.hdc.piscicola');
    Route::get('porcinos', 'PecuariaController@porcinos')->name('cefa.hdc.porcinos');

    /* Rutas de Ambiental */
    Route::get('ResiduosOrganicos', 'PecuariaController@rorganicos')->name('cefa.hdc.rorganicos');
    Route::get('ViveroOrnamental', 'PecuariaController@vivero')->name('cefa.hdc.vivero');
    Route::get('ResiduosSolidos', 'PecuariaController@rsolidos')->name('cefa.hdc.rsolidos');
    Route::get('lombricultivo', 'PecuariaController@lombricultivo')->name('cefa.hdc.lombricultivo');
    Route::get('HuelladeCarbono', 'PecuariaController@huella')->name('cefa.hdc.huella');


});

