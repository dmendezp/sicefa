<?php
use Illuminate\Support\Facades\Route;
use Modules\SICA\Http\Controllers\people\PeopleController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('sica')->group(function() {

        Route::get('/admin/people/data', [PeopleController::class, 'personal_data'])->name('sica.admin.people.personal_data');

        Route::get('/admin/people/search_apprentices', [PeopleController::class, 'search_apprentices'])->name('sica.admin.people.search_apprentices');
        Route::get('/admin/people/instructors', [PeopleController::class, 'instructors'])->name('sica.admin.people.instructors');
        Route::get('/admin/people/officers', [PeopleController::class, 'officers'])->name('sica.admin.people.officers');
        Route::get('/admin/people/contractors', [PeopleController::class, 'contractors'])->name('sica.admin.people.contractors');   

    });  

}); 