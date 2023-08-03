<?php

Route::middleware(['lang'])->group(function () {
	// prefijo de la aplicacion
	Route::prefix('evs/admin')->group(function() {
		//namespace EVS-controllers
		//Route::namespace('Modules\EVS\Http\Controllers')->group(function () {
			//ruta del Dashboard
			Route::get('/dashboard','Admin\DashboardController@getDashboard')->name('evs.admin.dashboard');
			//rutas de eventos
			Route::get('elections','Admin\ElectionsController@getElections')->name('evs.admin.elections');
			Route::get('/election/add','Admin\ElectionsController@getElectionAdd')->name('evs.admin.elections.add');
			Route::post('/election/add','Admin\ElectionsController@postElectionAdd')->name('evs.admin.elections.add');
			Route::get('/election/edit/{id}','Admin\ElectionsController@getElectionEdit')->name('evs.admin.elections.edit');
			Route::post('/election/edit/{id}','Admin\ElectionsController@postElectionEdit')->name('evs.admin.elections.edit');
			Route::get('/election/delete/{id}','Admin\ElectionsController@getElectionDelete')->name('evs.admin.elections.delete');
			//rutas de candidates
			Route::get('/candidates','Admin\CandidatesController@getCandidates')->name('evs.admin.candidates');
			Route::get('/candidates/add/{id}','Admin\CandidatesController@getCandidatesAdd')->name('evs.admin.candidates.add');
			Route::post('/candidates/search/{id}','Admin\CandidatesController@postCandidatesSearch')->name('evs.admin.candidates.search');
			Route::post('/candidates/add','Admin\CandidatesController@postCandidateAdd')->name('evs.admin.candidates.add');
			Route::get('/candidates/edit/{id}','Admin\CandidatesController@getCandidateEdit')->name('evs.admin.candidates.edit');
			Route::post('/candidates/edit/{id}','Admin\CandidatesController@postCandidateEdit')->name('evs.admin.candidates.edit');
			Route::get('/candidates/delete/{id}','Admin\CandidatesController@getCandidateDelete')->name('evs.admin.candidates.delete');
			//rutas de juries
			Route::get('/juries','Admin\JuriesController@getJuries')->name('evs.admin.juries');
			Route::get('/juries/add/{id}','Admin\JuriesController@getJuriesAdd')->name('evs.admin.juries.add');
			Route::post('/juries/search/{id}','Admin\JuriesController@postJuriesSearch')->name('evs.admin.juries.search');
			Route::post('/juries/add','Admin\JuriesController@postJuriesAdd')->name('evs.admin.juries.add');
			Route::get('/juries/edit/{id}','Admin\JuriesController@getJuriesEdit')->name('evs.admin.juries.edit');
			Route::post('/juries/edit/{id}','Admin\JuriesController@postJuriesEdit')->name('evs.admin.juries.edit');
			Route::get('/juries/delete/{id}','Admin\JuriesController@getJuriesDelete')->name('evs.admin.juries.delete');
			//rutas elected
			Route::get('/electeds','Admin\ElectedsController@getElected')->name('evs.admin.electeds');
			Route::get('/elected/add','Admin\ElectedsController@getElectedAdd')->name('evs.admin.electeds.add');

			Route::get('/elected/edit/{id}','Admin\ElectedsController@getElectedEdit')->name('evs.admin.electeds.edit');

			Route::get('/elected/delete/{id}','Admin\ElectedsController@getElectedDelete')->name('evs.admin.electeds.delete');

			//Route::get('/elected/delete/{id}','Admin\ElectionsController@getElectionDelete')->name('evs.admin.elections.delete');
		//});

	});

});