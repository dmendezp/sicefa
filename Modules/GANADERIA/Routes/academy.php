<?php
use Illuminate\Support\Facades\Route;
use Modules\GANADERIA\Http\Controllers\academy\AcademyController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('ganaderia')->group(function() {

        Route::get('/admin/academy/quarters', [AcademyController::class, 'quarters'])->name('ganaderia.admin.academy.quarters');
        Route::get('/admin/academy/curriculums', [AcademyController::class, 'curriculums'])->name('ganaderia.admin.academy.curriculums');
        Route::get('/admin/academy/network', [AcademyController::class, 'networks'])->name('ganaderia.admin.academy.networks');
        Route::get('/admin/academy/lines', [AcademyController::class, 'lines'])->name('ganaderia.admin.academy.lines');
        Route::get('/admin/academy/courses', [AcademyController::class, 'courses'])->name('ganaderia.admin.academy.courses');
        Route::get('/admin/units/production2', 'AdminController@dashboard')->name('ganaderia.admin.dashboard');  
        
    });  

}); 