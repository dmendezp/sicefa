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


        Route::controller(HDCController::class)->group(function () {
            Route::get('/index', 'index')->name('cefa.hdc.index');
            Route::get('admin/index', 'index')->name('hdc.admin.index'); // Ruta pagina principal del administrador
            Route::get('charge/index', 'index')->name('hdc.charge.index'); // Ruta pagina principal del Encargado
        });

        Route::controller(CarbonfootprintreportController::class)->group(function () {
            Route::get('/admin/generate/report', 'generateReport')->name('hdc.admin.generate.report');
            Route::get('/charge/generate/report', 'generateReport')->name('hdc.charge.generate.report');
            Route::post('/admin/generate-pdf', 'generatePdf')->name('hdc.admin.generate.pdf');
            Route::post('/charge/generate-pdf', 'generatePdf')->name('hdc.charge.generate.pdf');
            Route::post('/admin/report/tables', 'report')->name('hdc.admin.report.tables');
            Route::post('/charge/report/tables', 'report')->name('hdc.charge.report.tables');
        });

        Route::controller(FormularioController::class)->group(function () {
            Route::get('/admin/Formulario', 'formulario')->name('hdc.admin.formulario'); //Ruta del formualario de agregar registros de aspectos ambientales administrador
            Route::get('/charge/Formulario', 'formulario')->name('hdc.charge.formulario'); //Ruta del formualario de agregar registros de aspectos ambientales Encargado
            Route::post('/admin/get_activities', 'getActivities')->name('hdc.admin.activities'); // Ruta del formulario agregar que trae con ajax las actividades administrador
            Route::post('/charge/get_activities', 'getActivities')->name('hdc.charge.activities'); // Ruta del formulario agregar que trae con ajax las actividades Encargado
            Route::post('/admin/get_aspects', 'getAspects')->name('hdc.admin.aspects'); // Ruta del formulario agregar que trae con ajax los aspectos ambientales Administrador
            Route::post('/charge/get_aspects', 'getAspects')->name('hdc.charge.aspects'); // Ruta del formulario agregar que trae con ajax los aspectos ambientales Encargado
            Route::post('admin/guardar/valores', 'guardarValores')->name('hdc.admin.guardar.valores');
            Route::post('charge/guardar/valores', 'guardarValores')->name('hdc.charge.guardar.valores');
            /* Ruta del CRUD del formulario de registro*/
            Route::get('/admin/tabla', 'table')->name('hdc.admin.table');
            Route::get('/charge/tabla', 'table')->name('hdc.charge.table');
            Route::delete('admin/resulform/delete/{id}', 'delete')->name('hdc.admin.delete');
            Route::delete('charge/resulform/delete/{id}', 'delete')->name('hdc.charge.delete');
            Route::get('/admin/hdc/edit/{labor}', 'edit')->name('hdc.admin.edit');
            Route::get('/charge/hdc/edit/{labor}', 'edit')->name('hdc.charge.edit');
            Route::post('/admin/hdc/update/{labor}', 'update')->name('hdc.admin.update');
            Route::post('/charge/hdc/update/{labor}', 'update')->name('hdc.charge.update');
        });
        /* Ruta Para Asignar recursos */
        Route::controller(assign_environmental_aspectsController::class)->group(function () {
            Route::get('/admin/AsignarAspectosAmbientales', 'assign_environmental_aspects')->name('hdc.admin.assign_environmental_aspects');
            Route::get('/admin/listado_aspectos', 'aspectlist')->name('hdc.admin.resultfromaspects');
            Route::post('/admin/mostrar-resultados', 'mostrarResultados')->name('hdc.admin.mostrarResultados');
            Route::get('/admin/get_activities', 'getactivities')->name('hdc.admin.getactivities');
            Route::get('/admin/get-environmental-aspects/{activityId}', 'getEnvironmentalAspects')->name('hdc.admin.getEnvironmentalAspects');
            Route::post('/admin/update-environmental-aspects', 'update')->name('hdc.admin.updateEnvironmentalAspects');
            /* Ruta CRUD Del Formulario De Registro*/

          Route::get('/admin/hdc/edit_resultados/{activity_id}', 'edit_resultados')->name('hdc.admin.edit_resultados');
          Route::post('/admin/update/enviromentalaspect', 'UpdateEnvironmentalAspects')->name('hdc.admin.update.EnvironmentalAspects');
          Route::delete('/admin/hdc/delete_environmental_aspects/{id}', 'eliminarAspectosAmbientales')->name('hcd.admin.delete_environmental_aspects');

        });


        Route::controller(CarbonfootprintController::class)->group(function () {
            /* Rutas de Calcula tu Huella */
            Route::get('/persona', 'persona')->name('cefa.hdc.carbonfootprint.persona');
            /* Route::get('/charge/persona', 'persona')->name('hdc.charge.carbonfootprint.persona'); */
            /* Rutas de Formulario de Calcula tu Huella */
            Route::get('/form/calculates/footprin/{person}', 'formcalculates')->name('cefa.hdc.Carbonfootprint.form.calculates');
            /* Route::get('/charge/form/calculates/footprin/{person}', 'formcalculates')->name('hdc.charge.Carbonfootprint.form.calculates'); */
            // Ruta para procesar el formulario (guardar los datos)
            Route::post('/form/calculates/footprint/save', 'saveConsumption')->name('cefa.hdc.Carbonfootprint.save_consumption');
          /*   Route::post('/charge/form/calculates/footprint/save', 'saveConsumption')->name('hdc.charge.Carbonfootprint.save_consumption'); */


            /* Rutas del CRUD */
            Route::get('/carbonfootprint/edit/{id}', 'editConsumption')->name('cefa.hdc.carbonfootprint.edit_consumption');
            /* Route::get('/charge/carbonfootprint/edit/{id}', 'editConsumption')->name('hdc.charge.carbonfootprint.edit_consumption'); */
            Route::post('/carbonfootprint/update_consumption/{id}', 'updateConsumption')->name('cefa.hdc.carbonfootprint.update_consumption');
           /*  Route::post('/charge/carbonfootprint/update_consumption/{id}', 'updateConsumption')->name('hdc.charge.carbonfootprint.update_consumption'); */
            Route::delete('/carbonfootprint/eliminar/{id}', 'eliminarConsumo')->name('cefa.hdc.carbonfootprint.eliminar');
           /*  Route::delete('/charge/carbonfootprint/eliminar/{id}', 'eliminarConsumo')->name('hdc.charge.carbonfootprint.eliminar'); */
            Route::get('/carbonfootprint/edit/{id}', 'editConsumption')->name('cefa.hdc.carbonfootprint.edit_consumption');
            Route::post('/carbonfootprint/update_consumption/{id}', 'updateConsumption')->name('cefa.hdc.carbonfootprint.update_consumption');
            Route::delete('/carbonfootprint/eliminar/{id}', 'eliminarConsumo')->name('cefa.hdc.carbonfootprint.eliminar');
            Route::get('/grafica', 'grafica')->name('cefa.hdc.grafica');
        });

        Route::controller(GraphicsController::class)->group(function () {
            /* Ruta de Graficas */
            Route::get('/Graficas', 'Graficas')->name('cefa.hdc.Graficas');
            Route::get('/charge/graphics', 'Graficas')->name('hdc.charge.Graficas');
            Route::get('/admin/graphics', 'Graficas')->name('hdc.admin.Graficas');

        });

        Route::controller(InstructionManualController::class)->group(function () {
            Route::get('/admin/instruction/manual', 'manual')->name('hdc.admin.instruction.manual');
            Route::get('/charge/instruction/manual', 'manual')->name('hdc.charge.instruction.manual');
        });

        Route::controller(DeveloperController::class)->group(function () {
            Route::get('/developer', 'developer')->name('cefa.hdc.developers');
        });

        Route::controller(ParameterController::class)->group(function () {
            Route::get('/admin/parameters', 'parameters')->name('hdc.admin.parameter');
            Route::get('/charge/parameters', 'parameters')->name('hdc.charge.parameter');
            Route::post('/admin/parameters/resource/store', 'resource_store')->name('hdc.admin.parameters.resource.store');
            Route::post('/admin/parameters/resource/update', 'resource_update')->name('hdc.admin.parameters.resource.update');
            Route::delete("/admin/parameters/resource/destroy/{id}", 'resource_destroy')->name('hdc.admin.parameters.resource.destroy');
            Route::post('/charge/parameters/resource/store', 'resource_store')->name('hdc.charge.parameters.resource.store');
            Route::post('/charge/parameters/resource/update', 'resource_update')->name('hdc.charge.parameters.resource.update');
            Route::delete("/charge/parameters/resource/destroy/{id}", 'resource_destroy')->name('hdc.charge.parameters.resource.destroy');
            Route::post('/admin/parameters/environmental_aspect/store', 'enviromental_aspect_store')->name('hdc.admin.parameters.environment_aspects.store');
            Route::post('/admin/parameters/environmental_aspect/update', 'enviromental_aspect_update')->name('hdc.admin.parameters.environment_aspects.update');
            Route::delete("/admin/parameters/environmental_aspect/destroy/{id}", 'enviromental_aspect_destroy')->name('hdc.admin.parameters.environment_aspects.destroy');
            Route::post('/charge/parameters/environmental_aspect/store', 'enviromental_aspect_store')->name('hdc.charge.parameters.environment_aspects.store');
            Route::post('/charge/parameters/environmental_aspect/update', 'enviromental_aspect_update')->name('hdc.charge.parameters.environment_aspects.update');
            Route::delete('/charge/parameters/environmental_aspect/destroy/{id}', 'enviromental_aspect_destroy')->name('hdc.charge.parameters.environment_aspects.destroy');
        });
    });
});
