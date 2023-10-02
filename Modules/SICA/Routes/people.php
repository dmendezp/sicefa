<?php
use Illuminate\Support\Facades\Route;
use Modules\SICA\Http\Controllers\people\PeopleController;
use Modules\SICA\Http\Controllers\people\BasicDataController;
use Modules\SICA\Http\Controllers\people\ConfigController;
use Modules\SICA\Http\Controllers\people\ApprenticeController;
use Modules\SICA\Http\Controllers\people\InstructorController;
use Modules\SICA\Http\Controllers\people\AttendanceController;
use Modules\SICA\Http\Controllers\people\TempTablesController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('sica')->group(function() {

//ADMIN---------------------------------------------------------------------------

//Configuration
    //-- Home - aqui van todos los list en una sola vista. las demas rutas deben llamar a metodos de config para cargar por ajax en un modal
       Route::get('/admin/people/config', [ConfigController::class, 'config'])->name('sica.admin.people.config');

    //-- Events
        // Add
        Route::get('/admin/people/config/event/add', [ConfigController::class, 'addEventGet'])->name('sica.admin.people.config.event.add');
        Route::post('/admin/people/config/event/add', [ConfigController::class, 'addEventPost'])->name('sica.admin.people.config.event.add');
        // Edit
        Route::get('/admin/people/config/event/edit/{id}', [ConfigController::class, 'editEventGet'])->name('sica.admin.people.config.event.edit');
        Route::post('/admin/people/config/event/edit', [ConfigController::class, 'editEventPost'])->name('sica.admin.people.config.event.edit');
        // Delete
        Route::get('/admin/people/config/event/delete/{id}', [ConfigController::class, 'deleteEventGet'])->name('sica.admin.people.config.event.delete');
        Route::post('/admin/people/config/event/delete/', [ConfigController::class, 'deleteEventPost'])->name('sica.admin.people.config.event.delete');
    //-- Eps
        // Add
        Route::get('/admin/people/config/eps/add', [ConfigController::class, 'addEpsGet'])->name('sica.admin.people.config.eps.add');
        Route::post('/admin/people/config/eps/add', [ConfigController::class, 'addEpsPost'])->name('sica.admin.people.config.eps.add');
        // Edit
        Route::get('/admin/people/config/eps/edit/{id}', [ConfigController::class, 'editEpsGet'])->name('sica.admin.people.config.eps.edit');
        Route::post('/admin/people/config/eps/edit', [ConfigController::class, 'editEpsPost'])->name('sica.admin.people.config.eps.edit');
        // Delete
        Route::get('/admin/people/config/eps/delete/{id}', [ConfigController::class, 'deleteEpsGet'])->name('sica.admin.people.config.eps.delete');
        Route::post('/admin/people/config/eps/delete/', [ConfigController::class, 'deleteEpsPost'])->name('sica.admin.people.config.eps.delete');
    //-- Population group
        // Add
        Route::get('/admin/people/config/population/add', [ConfigController::class, 'addPopulationGet'])->name('sica.admin.people.config.population.add');
        Route::post('/admin/people/config/population/add', [ConfigController::class, 'addPopulationPost'])->name('sica.admin.people.config.population.add');
        // Edit
        Route::get('/admin/people/config/population/edit/{id}', [ConfigController::class, 'editPopulationGet'])->name('sica.admin.people.config.population.edit');
        Route::post('/admin/people/config/population/edit', [ConfigController::class, 'editPopulationPost'])->name('sica.admin.people.config.population.edit');
        // Delete
        Route::get('/admin/people/config/population/delete/{id}', [ConfigController::class, 'deletePopulationGet'])->name('sica.admin.people.config.population.delete');
        Route::post('/admin/people/config/population/delete/', [ConfigController::class, 'deletePopulationPost'])->name('sica.admin.people.config.population.delete');

//Personal data
        Route::get('/admin/people/data', [PeopleController::class, 'personal_data'])->name('sica.admin.people.personal_data');
        Route::post('/admin/people/data/search', [PeopleController::class, 'search_personal_data'])->name('sica.admin.people.personal_data.search');
        // Add
        Route::get('/admin/people/data/add/{doc}', [PeopleController::class, 'getAddData'])->name('sica.admin.people.personal_data.add');
        Route::post('/admin/people/data/add', [PeopleController::class, 'postAddBasicData'])->name('sica.admin.people.basic_data.add');
        // Add Basic

        Route::get('/admin/people/basic_data/search/', [BasicDataController::class, 'search_basic_data'])->name('sica.admin.people.basic_data.search');
        Route::get('/attendance/people/basic_data/search/', [BasicDataController::class, 'search_basic_data'])->name('sica.attendance.people.basic_data.search');
        Route::post('/admin/people/basic_data/add/', [BasicDataController::class, 'postAddData'])->name('sica.admin.people.basic_data.add');
        Route::post('/attendance/people/basic_data/add/', [BasicDataController::class, 'postAddData'])->name('sica.attendance.people.basic_data.add');

        // Edit
        Route::get('/admin/people/data/{id}/edit', [PeopleController::class, 'getEditData'])->name('sica.admin.people.personal_data.edit');
        Route::put('/admin/people/data/{id}/edit', [PeopleController::class, 'postEditData'])->name('sica.admin.people.personal_data.edit');

        Route::get('/admin/people/load',[TempTablesController::class, 'getLoadPeople'])->name('sica.admin.people.personal_data.load');
        Route::post('/admin/people/load',[TempTablesController::class, 'postLoadPeople'])->name('sica.admin.people.personal_data.load');

//Apprentices
        Route::get('/admin/people/apprentices', [ApprenticeController::class, 'search_apprentices'])->name('sica.admin.people.apprentices');
        Route::post('/admin/people/apprentices/search', [ApprenticeController::class, 'search'])->name('sica.admin.people.apprentices.search');

        Route::get('/admin/people/apprentice/load',[TempTablesController::class, 'getLoadApprentices'])->name('sica.admin.people.apprentices.load');
        Route::post('/admin/people/apprentice/load',[TempTablesController::class, 'postLoadApprentices'])->name('sica.admin.people.apprentices.load');


//Instructors
        Route::get('/admin/people/instructors', [InstructorController::class, 'instructors'])->name('sica.admin.people.instructors');
// se deben actualizar los controladores cuando sean creados
//Officers
        Route::get('/admin/people/officers', [PeopleController::class, 'officers'])->name('sica.admin.people.officers');
//Contractors
        Route::get('/admin/people/contractors', [PeopleController::class, 'contractors'])->name('sica.admin.people.contractors');

//ATTENDANCE--------------------------------------------------------------------------

//events_attendance
       Route::get('/admin/people/events_attendance', [AttendanceController::class, 'events_attendance'])->name('sica.admin.people.events_attendance');
       Route::get('/attendance/people/events_attendance', [AttendanceController::class, 'events_attendance'])->name('sica.attendance.people.events_attendance');
    });

});
