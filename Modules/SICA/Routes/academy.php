<?php
use Illuminate\Support\Facades\Route;
use Modules\SICA\Http\Controllers\academy\AcademyController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('sica')->group(function() {

        Route::get('/admin/academy/quarters', [AcademyController::class, 'quarters'])->name('sica.admin.academy.quarters');
        Route::get('/admin/academy/curriculums', [AcademyController::class, 'curriculums'])->name('sica.admin.academy.curriculums');
        Route::get('/admin/academy/network', [AcademyController::class, 'networks'])->name('sica.admin.academy.networks');
        Route::get('/admin/academy/lines', [AcademyController::class, 'lines'])->name('sica.admin.academy.lines');
        Route::get('/admin/academy/courses', [AcademyController::class, 'courses'])->name('sica.admin.academy.courses');
        
    });  

}); 