<?php
use Illuminate\Support\Facades\Route;

Route::middleware(['lang'])->group(function () {
    Route::prefix('sia')->group(function () {
        Route::controller(SIAController::class)->group(function () {
            Route::get('index', 'index')->name('cefa.sia.index');
            Route::get('developers', 'devs')->name('cefa.sia.devs');
            Route::get('information', 'info')->name('cefa.sia.info');
            Route::get('admin', 'admin')->name('sia.admin.index');
        });

        // Rutas para el CRUD de Aprendices Investigadores
        Route::controller(ApprenticeResearcherController::class)->group(function () {
            Route::get('admin/apprentice-researchers/index', 'index')->name('sia.admin.apprentice-researchers.index');
            Route::get('admin/apprentice-researchers/create', 'create')->name('sia.admin.apprentice-researchers.create');
            Route::post('admin/apprentice-researchers/store', 'store')->name('sia.admin.apprentice-researchers.store');
            Route::get('admin/apprentice-researchers/edit/{apprentice}', 'edit')->name('sia.admin.apprentice-researchers.edit')->where('apprentice', '[0-9]+');
            Route::put('admin/apprentice-researchers/update/{apprentice}', 'update')->name('sia.admin.apprentice-researchers.update')->where('apprentice', '[0-9]+');
            Route::delete('admin/apprentice-researchers/destroy/{apprentice}', 'destroy')->name('sia.admin.apprentice-researchers.destroy')->where('apprentice', '[0-9]+');
        });

        // Rutas para el CRUD de Instructores Investigadores
        Route::controller(InstructorResearcherController::class)->group(function () {
            Route::get('admin/instructor-researchers/index', 'index')->name('sia.admin.instructor-researchers.index');
            Route::get('admin/instructor-researchers/create', 'create')->name('sia.admin.instructor-researchers.create');
            Route::post('admin/instructor-researchers/store', 'store')->name('sia.admin.instructor-researchers.store');
            Route::get('admin/instructor-researchers/edit/{instructor}', 'edit')->name('sia.admin.instructor-researchers.edit')->where('instructor', '[0-9]+');
            Route::put('admin/instructor-researchers/update/{instructor}', 'update')->name('sia.admin.instructor-researchers.update')->where('instructor', '[0-9]+');
            Route::delete('admin/instructor-researchers/destroy/{instructor}', 'destroy')->name('sia.admin.instructor-researchers.destroy')->where('instructor', '[0-9]+');
            Route::get('admin/instructor-researchers/check-document', 'checkDocument')->name('sia.admin.instructor-researchers.checkDocument');
        });

        // Rutas para el CRUD de Administradores
        Route::controller(AdministratorController::class)->group(function () {
            Route::get('admin/administrators/index', 'index')->name('sia.admin.administrators.index');
            Route::get('admin/administrators/create', 'create')->name('sia.admin.administrators.create');
            Route::post('admin/administrators/store', 'store')->name('sia.admin.administrators.store');
            Route::get('admin/administrators/edit/{administrator}', 'edit')->name('sia.admin.administrators.edit')->where('administrator', '[0-9]+');
            Route::put('admin/administrators/update/{administrator}', 'update')->name('sia.admin.administrators.update')->where('administrator', '[0-9]+');
            Route::delete('admin/administrators/destroy/{administrator}', 'destroy')->name('sia.admin.administrators.destroy')->where('administrator', '[0-9]+');
            Route::get('admin/administrators/check-document', 'checkDocument')->name('sia.admin.administrators.checkDocument');
        });

        // Rutas para el CRUD de Eventos
        Route::controller(EventSiaController::class)->group(function () {
            Route::get('admin/events/index', 'index')->name('sia.admin.events.index');
            Route::get('admin/events/create', 'create')->name('sia.admin.events.create');
            Route::post('admin/events/store', 'store')->name('sia.admin.events.store');
            Route::get('admin/events/edit/{event}', 'edit')->name('sia.admin.events.edit')->where('event', '[0-9]+');
            Route::put('admin/events/update/{event}', 'update')->name('sia.admin.events.update')->where('event', '[0-9]+');
            Route::delete('admin/events/destroy/{event}', 'destroy')->name('sia.admin.events.destroy')->where('event', '[0-9]+');
        });

        // Rutas para el CRUD de Publicaciones
          Route::controller(PublicationController::class)->group(function () {
            Route::get('admin/publications/index', 'index')->name('sia.admin.publications.index');
            Route::get('admin/publications/create', 'create')->name('sia.admin.publications.create');
            Route::post('admin/publications/store', 'store')->name('sia.admin.publications.store');
            Route::get('admin/publications/edit/{publication}', 'edit')->name('sia.admin.publications.edit')->where('publication', '[0-9]+');
            Route::put('admin/publications/update/{publication}', 'update')->name('sia.admin.publications.update')->where('publication', '[0-9]+');
            Route::delete('admin/publications/destroy/{publication}', 'destroy')->name('sia.admin.publications.destroy')->where('publication', '[0-9]+');
            Route::get('admin/publications/pending', 'pending')->name('sia.admin.publications.pending');
            Route::get('admin/publications/review/{publication}', 'review')->name('sia.admin.publications.review')->where('publication', '[0-9]+');
        });
       // Rutas para el CRUD de Projectos 
        Route::controller(ProjectController::class)->group(function () {
            Route::get('admin/projects/index', 'index')->name('sia.admin.projects.index');
            Route::get('admin/projects/create', 'create')->name('sia.admin.projects.create');
            Route::post('admin/projects/store', 'store')->name('sia.admin.projects.store');
            Route::get('admin/projects/edit/{project}', 'edit')->name('sia.admin.projects.edit');
            Route::put('admin/projects/update/{project}', 'update')->name('sia.admin.projects.update');
            Route::delete('admin/projects/destroy/{project}', 'destroy')->name('sia.admin.projects.destroy');
        });
        // Rutas para el CRUD de Grupos
        Route::controller(GroupController::class)->group(function () {
            Route::get('groups/index', 'index')->name('sia.admin.groups.index');
            Route::get('groups/create', 'create')->name('sia.admin.groups.create');
            Route::post('groups/store', 'store')->name('sia.admin.groups.store');
            Route::get('groups/edit/{group}', 'edit')->name('sia.admin.groups.edit');
            Route::put('groups/update/{group}', 'update')->name('sia.admin.groups.update');
            Route::delete('groups/destroy/{group}', 'destroy')->name('sia.admin.groups.destroy');
        });
        // Rutas para el CRUD de Alianzas
        Route::controller(AllianceController::class)->group(function () {
            Route::get('alliances/index', 'index')->name('sia.admin.alliances.index');
            Route::get('alliances/create', 'create')->name('sia.admin.alliances.create');
            Route::post('alliances/store', 'store')->name('sia.admin.alliances.store');
            Route::get('alliances/edit/{alliance}', 'edit')->name('sia.admin.alliances.edit');
            Route::put('alliances/update/{alliance}', 'update')->name('sia.admin.alliances.update');
            Route::delete('alliances/destroy/{alliance}', 'destroy')->name('sia.admin.alliances.destroy');
        });
    });
});
