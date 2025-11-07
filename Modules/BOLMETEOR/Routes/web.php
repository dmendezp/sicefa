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

// Route::middleware(['lang'])->group(function () {

	Route::prefix('bolmeteor')->group(function() {

	    Route::get('/index', function () {
		    return view('bolmeteor::estacion.index');
		})->name('bolmeteor.estacion.index');

		Route::get('/climaticdata', 'BOLMETEORController@getClimaticData')->name('bolmeteor.estacion.climaticdata');
		Route::delete('/climaticdata/delete/{id}', 'BOLMETEORController@destroy')->name('bolmeteor.estacion.climaticdata.delete');
		Route::post('climaticdata/update','BOLMETEORController@update')->name('bolmeteor.estacion.climaticdata.update');

		Route::get('/desarrolladores', function () {
		    return view('bolmeteor::estacion.desarrolladores');
		})->name('bolmeteor.estacion.desarrolladores');

		Route::post('/graficas','GraphicsController@getGraficas')->name('bolmeteor.estacion.graficas');

		Route::get('/graficas','GraphicsController@getGraficas')->name('bolmeteor.general.graficas');
		Route::post('/graficas/search','GraphicsController@postValuesSearch')->name('bolmeteor.general.graficas.search');
		Route::get('/graficas/carga','GraphicsController@getCarga')->name('bolmeteor.general.graficas.carga');
		Route::post('/graficas/carga','GraphicsController@storeCarga')->name('bolmeteor.general.graficas.carga.guardar');

		Route::get('bolmeteor/elections', function () {
			return view('bolmeteor::admin.home1');
		})->name('bolmeteor.admin.home1');

	});

	Route::prefix('bolmeteor/admin')->group(function () {

		Route::get('/dashboard', function () {
			return view('bolmeteor::admin.dashboard');
		})->name('bolmeteor.admin.dashboard');
		
		Route::get('/climaticdata', 'BOLMETEORController@getClimaticData')->name('bolmeteor.admin.estacion.climaticdata');
		Route::delete('/{id}', 'BOLMETEORController@destroy')->name('bolmeteor.admin.estacion.climaticdata.delete');
		Route::post('/','BOLMETEORController@store')->name('bolmeteor.admin.estacion.climaticdata.store');
		
		Route::get('/graficas','GraphicsController@getGraficas')->name('bolmeteor.admin.graficas');
		Route::post('/graficas/search','GraphicsController@postValuesSearch')->name('bolmeteor.admin.graficas.search');
		Route::get('/graficas/carga','GraphicsController@getCarga')->name('bolmeteor.admin.graficas.carga');
		Route::post('/graficas/carga','GraphicsController@storeCarga')->name('bolmeteor.admin.graficas.carga.guardar');

		Route::get('bolmeteor/candidates', function () {
			return view('bolmeteor::admin.home2');
		})->name('bolmeteor.admin.home2');
	});

// });