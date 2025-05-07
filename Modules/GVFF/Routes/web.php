<?php

use Illuminate\Support\Facades\Route;



Route::middleware(['lang'])->group(function () {
    Route::prefix('gvff')->group(function () {
        Route::get('/index', 'GVFFController@index')->name('gvff.index');
        Route::get('/viveros', 'GVFFNurseriesController@index')->name('gvff.admin.nurseries.index');
        Route::get('/viveros/create', 'GVFFNurseriesController@create')->name('gvff.admin.nurseries.create');
        Route::post('/viveros/store', 'GVFFNurseriesController@store')->name('gvff.admin.nurseries.store');
        Route::get('/viveros/{nurseries}/edit', 'GVFFNurseriesController@edit')->name('gvff.admin.nurseries.edit');
        Route::put('/viveros/{nurseries}', 'GVFFNurseriesController@update')->name('gvff.admin.nurseries.update');
        Route::delete('/viveros/{nurseries}', 'GVFFNurseriesController@destroy')->name('gvff.admin.nurseries.destroy');
        Route::get('/viveros/{nurseries}/plants', 'GVFFNurseriesController@showPlants')->name('gvff.admin.nurseries.showPlants');

        // Nuevas rutas para plantas
    Route::get('/plantas', 'GVFFPlantsController@index')->name('gvff.admin.plants.index');
    Route::get('/plantas/create', 'GVFFPlantsController@create')->name('gvff.admin.plants.create');
    Route::post('/plantas/store', 'GVFFPlantsController@store')->name('gvff.admin.plants.store');
    Route::get('/plantas/{plants}/edit', 'GVFFPlantsController@edit')->name('gvff.admin.plants.edit');
    Route::put('/plantas/{plants}', 'GVFFPlantsController@update')->name('gvff.admin.plants.update');
    Route::delete('/plantas/{plants}', 'GVFFPlantsController@destroy')->name('gvff.admin.plants.destroy');
    Route::get('/plantas/{plants}/sell', 'GVFFPlantsController@sell')->name('gvff.admin.plants.sell');
    Route::post('/plantas/{plants}/sell', 'GVFFPlantsController@processSell')->name('gvff.admin.plants.processSell');

        // Nuevas rutas para creación por tipo
    Route::get('/plantas/ornamental/create', 'GVFFPlantsController@createOrnamental')->name('gvff.admin.plants.ornamental.create');
    Route::post('/plantas/ornamental/store', 'GVFFPlantsController@storeOrnamental')->name('gvff.admin.plants.ornamental.store');
    Route::get('/plantas/medicinal/create', 'GVFFPlantsController@createMedicinal')->name('gvff.admin.plants.medicinal.create');
    Route::post('/plantas/medicinal/store', 'GVFFPlantsController@storeMedicinal')->name('gvff.admin.plants.medicinal.store');
    Route::get('/plantas/venta/create', 'GVFFPlantsController@createVenta')->name('gvff.admin.plants.venta.create');
    Route::post('/plantas/venta/store', 'GVFFPlantsController@storeVenta')->name('gvff.admin.plants.venta.store');
    Route::get('/plantas/forestal/create', 'GVFFPlantsController@createForestal')->name('gvff.admin.plants.forestal.create');
    Route::post('/plantas/forestal/store', 'GVFFPlantsController@storeForestal')->name('gvff.admin.plants.forestal.store');
    
    });

    

});


Route::prefix('gvff')->group(function () {
    //Rura para los aprendices
    Route::get('/welcome', 'GVFFController@welcome')->name('gvff.welcome');
});






