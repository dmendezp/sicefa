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
            Route::get('/AsignarAspectosAmbientales', 'assign_environmental_aspects')->name('cefa.hdc.assign_environmental_aspects');
            Route::get('/admin/listado_aspectos', 'aspectlist')->name('hdc.admin.resultfromaspects');
            Route::post('/mostrar-resultados', 'mostrarResultados')->name('cefa.hdc.mostrarResultados');
            Route::get('/admin/get_activities', 'getactivities')->name('hdc.admin.getactivities');
            Route::get('/get-environmental-aspects/{activityId}', 'getEnvironmentalAspects')->name('cefa.hdc.getEnvironmentalAspects');
            Route::post('/guardar', 'store')->name('hdc.assign_environmental_aspects.store');
            Route::post('/admin/update-environmental-aspects', 'update')->name('hdc.admin.updateEnvironmentalAspects');
            /* Ruta CRUD Del Formulario De Registro*/
          /*   Route::get('/actividad/{activity}/editar', 'edit')->name('cefa.hdc.edit'); */
          Route::get('cefa/hdc/edit_resultados/{activity_id}', 'edit_resultados')->name('cefa.hdc.edit_resultados');
          Route::post('admin/update/enviromentalaspect', 'UpdateEnvironmentalAspects')->name('hdc.admin.update.EnvironmentalAspects');

            Route::delete('/admin/hdc/delete_environmental_aspects/{id}', 'eliminarAspectosAmbientales')->name('hcd.admin.delete_environmental_aspects');

        });
        Route::controller(AssignAspectsController::class)->group(function(){
            Route::get('/consultar/aspectoAmbiental', 'consul')->name('hdc.admin.consultar.aspectoAmbiental'); //Ruta para consultar el aspecto ambiental
            Route::get('/add/aspects', 'addaspects')->name('hdc.admin.add.aspects');//ruta para el boton de agregar del crud
            Route::post('/admin/Aspect/activities', 'AspectActivities')->name('hdc.admin.aspect.activities');
            Route::post('/admin/Aspect', 'Aspect')->name('hdc.admin.aspects');
            Route::post('/result/tabla/Aspects', 'resulttable')->name('cefa.hdc.resultado.tabla'); //Ruta del ajax para traer la tabla con los aspectos ambientales segun la actividad
            Route::post('/guardar-aspectos/{actividad}', 'guardarAspectos')->name('cefa.hdc.guardar.aspectos');


        });

        Route::controller(CarbonfootprintController::class)->group(function () {
            /* Rutas de Calcula tu Huella */
            Route::get('/admin/persona', 'persona')->name('hdc.admin.carbonfootprint.persona');
            Route::get('/charge/persona', 'persona')->name('hdc.charge.carbonfootprint.persona');
            /* Rutas de Formulario de Calcula tu Huella */
            Route::get('/admin/form/calculates/footprin/{person}', 'formcalculates')->name('hdc.admin.Carbonfootprint.form.calculates');
            Route::get('/charge/form/calculates/footprin/{person}', 'formcalculates')->name('hdc.charge.Carbonfootprint.form.calculates');
            // Ruta para procesar el formulario (guardar los datos)
            Route::post('/admin/form/calculates/footprint/save', 'saveConsumption')->name('hdc.admin.Carbonfootprint.save_consumption');
            Route::post('/charge/form/calculates/footprint/save', 'saveConsumption')->name('hdc.charge.Carbonfootprint.save_consumption');


            /* Rutas del CRUD */
            Route::get('/admin/carbonfootprint/edit/{id}', 'editConsumption')->name('hdc.admin.carbonfootprint.edit_consumption');
            Route::get('/charge/carbonfootprint/edit/{id}', 'editConsumption')->name('hdc.charge.carbonfootprint.edit_consumption');
            Route::post('/admin/carbonfootprint/update_consumption/{id}', 'updateConsumption')->name('hdc.admin.carbonfootprint.update_consumption');
            Route::post('/charge/carbonfootprint/update_consumption/{id}', 'updateConsumption')->name('hdc.charge.carbonfootprint.update_consumption');
            Route::delete('/admin/carbonfootprint/eliminar/{id}', 'eliminarConsumo')->name('hdc.admin.carbonfootprint.eliminar');
            Route::delete('/charge/carbonfootprint/eliminar/{id}', 'eliminarConsumo')->name('hdc.charge.carbonfootprint.eliminar');
            Route::get('/carbonfootprint/edit/{id}', 'editConsumption')->name('carbonfootprint.edit_consumption');
            Route::post('/carbonfootprint/update_consumption/{id}', 'updateConsumption')->name('carbonfootprint.update_consumption');
            Route::delete('/carbonfootprint/eliminar/{id}', 'eliminarConsumo')->name('carbonfootprint.eliminar');
            Route::get('/admin/grafica', 'grafica')->name('hdc.admin.grafica');
        });

        Route::controller(GraficasController::class)->group(function () {
            /* Ruta de Graficas */
            Route::get('/Graficas', 'Graficas')->name('cefa.hdc.Graficas');

        });

        Route::controller(InstructionManualController::class)->group(function () {
            Route::get('/admin/instruction/manual', 'manual')->name('hdc.admin.instruction.manual');
            Route::get('/charge/instruction/manual', 'manual')->name('hdc.charge.instruction.manual');
        });

        Route::controller(DeveloperController::class)->group(function () {
            Route::get('/developer', 'developer')->name('cefa.hdc.developers');
        });
    });
});
