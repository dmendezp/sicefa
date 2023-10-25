<?php

use Illuminate\Support\Facades\Route;
use Modules\HDC\Http\Controllers\GraficasController;

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


        Route::controller(HDCController::class)->group(function(){
            Route::get('/index', 'index')->name('cefa.hdc.index');
            Route::get('admin/index', 'index')->name('hdc.admin.index');// Ruta pagina principal del administrador
            Route::get('charge/index', 'index')->name('hdc.charge.index');// Ruta pagina principal del Encargado
            Route::get('userHDC/index', 'index')->name('hdc.userHDC.index');// Ruta pagina principal del Usuario Calcula tu Huella



        });

        Route::controller(FormularioController::class)->group(function(){
            Route::get('/admin/Formulario', 'formulario')->name('hdc.admin.formulario'); //Ruta del formualario de agregar registros de aspectos ambientales administrador
            Route::get('/charge/Formulario', 'formulario')->name('hdc.charge.formulario');//Ruta del formualario de agregar registros de aspectos ambientales Encargado
            Route::post('/admin/get_activities', 'getActivities')->name('hdc.admin.activities');// Ruta del formulario agregar que trae con ajax las actividades administrador
            Route::post('/charge/get_activities', 'getActivities')->name('hdc.charge.activities');// Ruta del formulario agregar que trae con ajax las actividades Encargado
            Route::post('/admin/get_aspects', 'getAspects')->name('hdc.admin.aspects');// Ruta del formulario agregar que trae con ajax los aspectos ambientales Administrador
            Route::post('/charge/get_aspects', 'getAspects')->name('hdc.charge.aspects');// Ruta del formulario agregar que trae con ajax los aspectos ambientales Encargado
            Route::post('/guardar/valores', 'guardarValores')->name('hdc.guardar.valores');
             /* Ruta del CRUD del formulario de registro*/
            Route::get('/admin/tabla', 'FormularioController@table')->name('hdc.admin.table');
            Route::delete('/resulform/delete/{id}', 'delete')->name('cefa.hdc.delete');
            Route::get('/cefa/hdc/edit/{labor}', 'edit')->name('cefa.hdc.edit');
            Route::post('/cefa/hdc/update/{labor}', 'update')->name('cefa.hdc.update');

        });
         /* Ruta Para Asignar recursos */
        Route::controller(assign_environmental_aspectsController::class)->group(function(){
            Route::get('/AsignarAspectosAmbientales', 'assign_environmental_aspects')->name('cefa.hdc.assign_environmental_aspects');
            Route::get('/listado_aspectos', 'aspectlist')->name('cefa.hdc.resultfromaspects');
            Route::post('/mostrar-resultados', 'mostrarResultados')->name('cefa.hdc.mostrarResultados');
            Route::get('/get-environmental-aspects/{activityId}', 'getEnvironmentalAspects')->name('cefa.hdc.getEnvironmentalAspects');
            Route::post('/guardar', 'store')->name('hdc.assign_environmental_aspects.store');
            Route::post('/update-environmental-aspects', 'updateEnvironmentalAspects')->name('cefa.hdc.updateEnvironmentalAspects');
            /* Ruta CRUD Del Formulario De Registro*/
        });

        Route::controller(CarbonfootprintController::class)->group(function(){
            /* Rutas de Calcula tu Huella */
            Route::get('persona', 'persona')->name('carbonfootprint.persona');
            Route::get('/calculos/persona/{documento}', 'verificarUsuario')->name('carbonfootprint.calculos.persona');
             /* Rutas de Formulario de Calcula tu Huella */
            Route::get('/form/calculates/footprin/{person}', 'formcalculates')->name('Carbonfootprint.form.calculates');
            // Ruta para procesar el formulario (guardar los datos)
            Route::post('/form/calculates/footprint/save', 'saveConsumption')->name('Carbonfootprint.save_consumption');

            /* Rutas del CRUD */
            Route::get('/carbonfootprint/edit/{id}', 'editConsumption')->name('carbonfootprint.edit_consumption');
            Route::post('/carbonfootprint/update_consumption/{id}', 'updateConsumption')->name('carbonfootprint.update_consumption');
            Route::delete('/carbonfootprint/eliminar/{id}', 'eliminarConsumo')->name('carbonfootprint.eliminar');
        });

        Route::controller(GraficasController::class)->group(function(){
            /* Ruta de Graficas */
        Route::get('/Graficas', 'Graficas')->name('cefa.hdc.Graficas');
        });
    });
});
