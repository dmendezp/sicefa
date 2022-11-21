<?php
use Illuminate\Support\Facades\Route;
use Modules\SICA\Http\Controllers\people\PeopleController;
use Modules\SICA\Http\Controllers\people\BasicDataController;
use Modules\SICA\Http\Controllers\people\ConfigController;
use Modules\SICA\Http\Controllers\people\ApprenticeController;
use Modules\SICA\Http\Controllers\people\AttendanceController;

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

//Apprentices
        Route::get('/admin/people/apprentices', [ApprenticeController::class, 'search_apprentices'])->name('sica.admin.people.apprentices');
        Route::post('/admin/people/apprentices/search', [ApprenticeController::class, 'search'])->name('sica.admin.people.apprentices.search');
        Route::get('/admin/people/apprentice/load',[ApprenticeController::class, 'getLoad'])->name('sica.admin.people.apprentices.load');
        Route::post('/admin/people/apprentice/load',[ApprenticeController::class, 'postLoad'])->name('sica.admin.people.apprentices.load');

// se deben actualizar los controladores cuando sean creados
//Instructors
        Route::get('/admin/people/instructors', [PeopleController::class, 'instructors'])->name('sica.admin.people.instructors');
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
