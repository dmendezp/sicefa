<?php
use Illuminate\Support\Facades\Route;
use Modules\GANADERIA\Http\Controllers\people\PeopleController;
use Modules\GANADERIA\Http\Controllers\people\PersonalDataController;
use Modules\GANADERIA\Http\Controllers\people\ApprenticeController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('ganaderia')->group(function() {
//Personal data
       Route::get('/admin/people/config', [PeopleController::class, 'config'])->name('ganaderia.admin.people.config');
        Route::get('/admin/people/data', [PeopleController::class, 'personal_data'])->name('ganaderia.admin.people.personal_data');
        Route::post('/admin/people/data/search', [PersonalDataController::class, 'search_personal_data'])->name('ganaderia.admin.people.personal_data.search');
        // Add
        Route::get('/admin/people/data/add/{doc}', [PersonalDataController::class, 'getAddData'])->name('ganaderia.admin.people.personal_data.add');
        Route::post('/admin/people/data/add', [PersonalDataController::class, 'postAddData'])->name('ganaderia.admin.people.personal_data.add');
        //Edit
        Route::get('/admin/people/data/{id}/edit', [PersonalDataController::class, 'getEditData'])->name('ganaderia.admin.people.personal_data.edit');
        Route::put('/admin/people/data/{id}/edit', [PersonalDataController::class, 'postEditData'])->name('ganaderia.admin.people.personal_data.edit');
//Apprentices
        Route::get('/admin/people/search_apprentices', [PeopleController::class, 'search_apprentices'])->name('ganaderia.admin.people.search_apprentices');
        Route::post('/admin/people/apprentices/search', [ApprenticeController::class, 'search'])->name('ganaderia.admin.people.apprentices.search');
 //Instructors      
        Route::get('/admin/people/instructors', [PeopleController::class, 'instructors'])->name('ganaderia.admin.people.instructors');
 //Officers 
        Route::get('/admin/people/officers', [PeopleController::class, 'officers'])->name('ganaderia.admin.people.officers');
 //Contractors 
        Route::get('/admin/people/contractors', [PeopleController::class, 'contractors'])->name('ganaderia.admin.people.contractors');   
       
    });  

}); 