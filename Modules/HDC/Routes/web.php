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

Route::middleware(['lang'])->group(function () {
    Route::prefix('hdc')->group(function () {
        Route::get('/index', 'HDCController@index')->name('cefa.hdc.index');

        /* Ruta del Formulario */
        Route::get('/Formulario', 'FormularioController@formulario')->name('cefa.hdc.formulario');
        Route::post('/get_activities', 'FormularioController@getActivities')->name('hdc.activities');
        Route::post('/get_aspects', 'FormularioController@getAspects')->name('hdc.aspects');
        Route::post('/guardar/valores', 'FormularioController@guardarValores')->name('hdc.guardar.valores');
        /* Ruta del CRUD */
        Route::get('/tabla', 'FormularioController@table')->name('admin.hdc.table');
        Route::delete('/resulform/delete/{id}', 'FormularioController@delete')->name('cefa.hdc.delete');
        Route::get('/cefa/hdc/edit/{labor}', 'FormularioController@edit')->name('cefa.hdc.edit');
        Route::post('/cefa/hdc/update/{labor}', 'FormularioController@update')->name('cefa.hdc.update');



        /* Ruta Para Administrar Recursos */
        Route::get('/AdminstrarRecursos', 'AdminresourcesController@adminresources')->name('cefa.hdc.adminresources');
        Route::get('/get-environmental-aspects/{activityId}', 'AdminresourcesController@getEnvironmentalAspects')->name('cefa.hdc.getEnvironmentalAspects');
        Route::post('/guardar', 'AdminresourcesController@store')->name('hdc.adminresources.store');
        Route::post('/update-environmental-aspects', 'AdminresourcesController@updateEnvironmentalAspects')->name('cefa.hdc.updateEnvironmentalAspects');


        /* Rutas de Calcula tu Huella */
        Route::get('persona', 'CarbonfootprintController@persona')->name('carbonfootprint.persona');
        Route::get('/calculos/persona/{documento}', 'CarbonfootprintController@verificarUsuario')->name('carbonfootprint.calculos.persona');

        /* Rutas de Formulario de Calcula tu Huella */
        Route::get('/form/calculates/footprin/{person}', 'CarbonfootprintController@formcalculates')->name('Carbonfootprint.form.calculates');
        // Ruta para procesar el formulario (guardar los datos)
        Route::post('/form/calculates/footprint/save', 'CarbonfootprintController@saveConsumption')->name('Carbonfootprint.save_consumption');

        /* Rutas del CRUD */
        Route::get('/carbonfootprint/edit/{id}', 'CarbonfootprintController@editConsumption')->name('carbonfootprint.edit_consumption');
        Route::post('/carbonfootprint/update_consumption/{id}', 'CarbonfootprintController@updateConsumption')->name('carbonfootprint.update_consumption');
        Route::delete('/carbonfootprint/eliminar/{id}', 'CarbonfootprintController@eliminarConsumo')->name('carbonfootprint.eliminar');







        /* Ruta de Graficas */
        Route::get('/Graficas', 'GraficasController@Graficas')->name('cefa.hdc.Graficas');
    });
});
