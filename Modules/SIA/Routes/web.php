<?php
use Illuminate\Support\Facades\Route;

Route::middleware(['lang'])->group(function () {
    Route::prefix('sia')->group(function () {
        Route::controller(SIAController::class)->group(function () {
            Route::get('index', 'index')->name('cefa.sia.index');
            Route::get('developers', 'devs')->name('cefa.sia.devs');
            Route::get('information', 'info')->name('cefa.sia.info');
            Route::get('admin', 'admin')->name('sia.admin.index');
            Route::get('instructor', 'instructor')->name('sia.instructor.index');
            Route::get('apprentice', 'apprentice')->name('sia.apprentice.index');
        });

        Route::controller(ResearchProjectController::class)->group(function () {
            Route::get('admin/research-projects/index', 'index')->name('sia.admin.research_project.index');
            Route::get('admin/searchperson', 'searchperson')->name('sia.admin.searchperson');
            Route::post('admin/research-projects/store', 'store')->name('sia.admin.research_project.store');
            Route::put('admin/research-projects/update/{project}', 'update')->name('sia.admin.research_project.update')->where('project', '[0-9]+');
            Route::delete('admin/research-projects/destroy/{project}', 'destroy')->name('sia.admin.research_project.destroy')->where('project', '[0-9]+');

            Route::get('apprentice/research_project/apply', 'showApplicationForm')->name('sia.apprentice.research_project.apply');
            Route::get('apprentice/research_project/showinfo', 'showProjectInfo')->name('sia.apprentice.research_project.showinfo');
            Route::post('apprentice/research_project/apply', 'apply')->name('sia.apprentice.research_project.apply.store');

            Route::get('admin/research_project/applications', 'manageApplications')->name('sia.admin.research_project.applications');
            Route::post('admin/research_project/applications/{id}/status', 'updateStatus')->name('sia.admin.research_project.applications.update');

            Route::get('instructor/research_project/group', 'group')->name('sia.instructor.research_project.group');
            Route::get('admin/research_project/group', 'group')->name('sia.admin.research_project.group');
            Route::delete('admin/research_project/applications/{id}/detach', 'detachApplication')->name('sia.admin.research_project.applications.detach');
        });

        Route::controller(AllianceController::class)->group(function () {
            Route::get('admin/alliance/index', 'index')->name('sia.admin.alliance.index');
            Route::post('admin/alliance/store', 'store')->name('sia.admin.alliance.store');
            Route::put('admin/alliance/update/{id}', 'update')->name('sia.admin.alliance.update');
            Route::delete('admin/alliance/destroy/{id}', 'destroy')->name('sia.admin.alliance.destroy');
        });

        // Rutas para el CRUD de Eventos
        Route::controller(EventSiaController::class)->group(function () {
            Route::get('admin/event/index', 'index')->name('sia.admin.event.index');
            Route::post('admin/event/store', 'store')->name('sia.admin.event.store');
            Route::put('admin/event/update/{event}', 'update')->name('sia.admin.event.update')->where('event', '[0-9]+');
            Route::delete('admin/events/destroy/{event}', 'destroy')->name('sia.admin.event.destroy')->where('event', '[0-9]+');
        });

        // Rutas para el CRUD de Publicaciones
        Route::controller(PublicationController::class)->group(function () {
            Route::get('apprentice/publication/create',  'create')->name('sia.apprentice.publication.create');
            Route::post('apprentice/publication/store', 'store')->name('sia.apprentice.publication.store');

            Route::get('admin/publication/index',  'index')->name('sia.admin.publication.index');
            Route::post('admin/publication/store', 'store_admin')->name('sia.admin.publication.store');
            Route::put('admin/publication/update/{publication}', 'updateStatus')->name('sia.admin.publication.update');
        });

        // Rutas para el CRUD de Eventos
        Route::controller(HumanTalentController::class)->group(function () {
            Route::get('admin/human_talent/user', 'user')->name('sia.admin.human_talent.user');
            Route::get('admin/human_talent/apprentice', 'apprentice')->name('sia.admin.human_talent.apprentice');
            Route::get('admin/human_talent/apprentice/data', 'apprenticeData')->name('sia.admin.human_talent.apprentice.data');
            Route::get('admin/human_talent/user', 'user')->name('sia.admin.human_talent.user');
        });

    });
});
