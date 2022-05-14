<?php
use Illuminate\Support\Facades\Route;
use Modules\SICA\Http\Controllers\people\PeopleController;
use Modules\SICA\Http\Controllers\people\PersonalDataController;
use Modules\SICA\Http\Controllers\people\ApprenticeController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('sica')->group(function() {
//Personal data
        Route::get('/admin/people/data', [PeopleController::class, 'personal_data'])->name('sica.admin.people.personal_data');
        Route::post('/admin/people/data/search', [PersonalDataController::class, 'search_personal_data'])->name('sica.admin.people.personal_data.search');
        // Add
        Route::get('/admin/people/data/add/{doc}', [PersonalDataController::class, 'getAddData'])->name('sica.admin.people.personal_data.add');
        Route::post('/admin/people/data/add', [PersonalDataController::class, 'postAddData'])->name('sica.admin.people.personal_data.add');
        //Edit
        Route::get('/admin/people/data/{id}/edit', [PersonalDataController::class, 'getEditData'])->name('sica.admin.people.personal_data.edit');
        Route::put('/admin/people/data/{id}/edit', [PersonalDataController::class, 'postEditData'])->name('sica.admin.people.personal_data.edit');
//Apprentices
        Route::get('/admin/people/search_apprentices', [PeopleController::class, 'search_apprentices'])->name('sica.admin.people.search_apprentices');
        Route::post('/admin/people/apprentices/search', [ApprenticeController::class, 'search'])->name('sica.admin.people.apprentices.search');
 //Instructors      
        Route::get('/admin/people/instructors', [PeopleController::class, 'instructors'])->name('sica.admin.people.instructors');
 //Officers 
        Route::get('/admin/people/officers', [PeopleController::class, 'officers'])->name('sica.admin.people.officers');
 //Contractors 
        Route::get('/admin/people/contractors', [PeopleController::class, 'contractors'])->name('sica.admin.people.contractors');   

    });  

}); 