<?php
use Illuminate\Support\Facades\Route;
use Modules\EVS\Http\Controllers\EVSController;
use Modules\EVS\Http\Controllers\Jury;

Route::middleware(['lang'])->group(function () {

	Route::prefix('evs')->group(function() {

		Route::get('/index','EVSController@index')->name('cefa.evs.voto.index');

		//ruta de formulario para validad
		Route::get('/votar','EVSController@getVotar')->name('cefa.evs.voto.votar');
		//ruta de validacion - tarjerton
		Route::post('/votar/validar','EVSController@postValidar')->name('cefa.evs.voto.votar.validar');
		//ruta de Votar
		Route::post('/votar/registrar','EVSController@postRegistrar')->name('cefa.evs.voto.votar.registrar');


		Route::get('/tarjeton', function () {
		    return view('evs::voto.tarjeton');
		})->name('cefa.evs.voto.tarjeton');


		Route::get('/normatividad','EVSController@normatividad')->name('cefa.evs.voto.normatividad');

		Route::get('/resultados','EVSController@getResultados')->name('cefa.evs.voto.resultados');

		Route::get('/desarrolladores','EVSController@desarrolladores')->name('cefa.evs.voto.desarrolladores');

		Route::get('/jurados', function () {
		    return view('evs::jurados.index');
		})->name('evs.jurados.index');		

		Route::get('/admin', function () {
		    return view('evs::admin.index');
		})->name('evs.admin.index');


	});
	Route::prefix('evs/juries')->group(function() {
		Route::get('login','Admin\JuriesController@login')->name('cefa.evs.juries.login');
		Route::get('logout','Admin\JuriesController@logout')->name('cefa.evs.juries.logout');
		Route::get('/access','Admin\JuriesController@getaccess')->name('cefa.evs.juries.access');
		Route::post('/access','Admin\JuriesController@access')->name('cefa.evs.juries.access');
		Route::post('/search','Admin\JuriesController@search')->name('cefa.evs.juries.search');
		Route::post('/authorized','Admin\JuriesController@authorized')->name('cefa.evs.juries.authorized');
		Route::get('/report','Admin\JuriesController@report')->name('cefa.evs.juries.report');

	});

});