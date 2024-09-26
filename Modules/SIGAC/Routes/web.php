<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['lang'])->group(function () { //Middleware que permite la internacionalizacion

    Route::prefix('sigac')->group(function () {  // agrega el prefijo en la url (sicefa.test/sigac/...)

        // RUTAS GENERALES
        Route::controller(SIGACController::class)->group(function () { // Agregar por única vez el controlodaar para posteriormente solo definir rutas con el formato (url, método_controlador)->name(nombre_de_ruta)
            Route::get('index', 'index')->name('cefa.sigac.index'); // Vista principal y pública de la aplicación.
            Route::get('information', 'info')->name('cefa.sigac.info'); // Vista mas info sobre SIGAC y pública de la aplicación (Pública)
            Route::get('developers', 'devs')->name('cefa.sigac.devs'); // Vista sobre desarrolladores y creditos sobre SIGAC y pública de la aplicación (Pública)
            Route::get('academic_coordination', 'academic_coordination_dashboard')->name('sigac.academic_coordination.dashboard'); // Panel de control de coordinación académica (Coordinación Académica)
            Route::get('instructor', 'instructor_dashboards')->name('sigac.instructor.dashboard'); // Panel de control del instructor (Instructor)
            Route::get('wellness', 'wellness_dashboard')->name('sigac.wellness.dashboard'); // Panel de control de bienestar (Bienestar)
            Route::get('apprentice', 'apprentice_dashboard')->name('sigac.apprentice.dashboard'); // Panel de control de aprendiz (Aprendiz)
            Route::get('support', 'support_dashboard')->name('sigac.support.dashboard'); // Panel de control de apoyo (Apoyo)
            Route::get('securitystaff', 'securitystaff_dashboard')->name('sigac.securitystaff.dashboard'); // Panel de control de apoyo (Apoyo)

        });

        // RUTAS PROGRAMACION DE INSTRUCTORES
        Route::controller(ProgrammeController::class)->group(function () {

            //  ---------- Progamacion de instructor ------------------
            Route::get('academic_coordination/programming/get', 'programming_get')->name('sigac.academic_coordination.programming.get'); // Programación de horarios (Coordinación Académica)
            Route::get('academic_coordination/events', 'event_programming')->name('sigac.academic_coordination.event_programming.index'); // Programación de eventos (Coordinación Académica)

            // Parametros
            Route::get('academic_coordination/programming/parameters/index', 'parameter')->name('sigac.academic_coordination.programming.parameters.index'); // Parametros de programacion (Coordinación Académica)
            Route::get('wellbeing/programming/parameters/index', 'parameter')->name('sigac.wellbeing.programming.parameters.index'); // Parametros de programacion (Bienestar)

            //Parametro - Competencias
            Route::get('academic_coordination/competences/index/{program_id}', 'parameter_competencies')->name('sigac.academic_coordination.programming.competence.index'); // Vista Competencias del programa (Coordinación Académica)
            Route::post('academic_coordination/competences/store', 'competence_store')->name('sigac.academic_coordination.programming.competence.store'); // Registrar competencia (Coordinación Académica)
            Route::post('academic_coordination/competences/update/{id}', 'competence_update')->name('sigac.academic_coordination.programming.competence.update'); // Actualizar competencia (Coordinación Académica)
            Route::delete('academic_coordination/competences/destroy/{id}', 'competence_destroy')->name('sigac.academic_coordination.programming.competence.destroy'); // Eliminar competencia (Coordinación Académica)

            Route::get('academic_coordination/programming/programs/export', 'program_export')->name('sigac.academic_coordination.programming.programs.export'); // Vista carge de archivo (Coordinación Académica)
            Route::get('academic_coordination/programming/programs/load/create', 'program_load_create')->name('sigac.academic_coordination.programming.programs.load.create'); // Vista carge de archivo (Coordinación Académica)
            Route::post('academic_coordination/programming/programs/load/store', 'program_load_store')->name('sigac.academic_coordination.programming.programs.load.store'); // Registro programas por archivo (Coordinación Académica)
            Route::get('academic_coordination/programming/programs/search', 'program_search')->name('sigac.academic_coordination.programming.programs.search'); // Vista carge de archivo (Coordinación Académica)

            //Parametro - Resultados de aprendizaje
            Route::get('academic_coordination/learning_outcomes/index/{competencie_id}/{program_id}', 'parameter_learning_outcomes')->name('sigac.academic_coordination.programming.learning_outcome.index'); // Vista resultados de aprendizaje de la competencia (Coordinación Académica)
            Route::post('academic_coordination/learning_outcomes/store', 'learning_outcome_store')->name('sigac.academic_coordination.programming.learning_outcome.store'); // Registrar resultado de aprendizaje (Coordinación Académica)
            Route::post('academic_coordination/learning_outcomes/update/{id}', 'learning_outcome_update')->name('sigac.academic_coordination.programming.learning_outcome.update'); // Actualizar resultado de aprendizaje (Coordinación Académica)
            Route::delete('academic_coordination/learning_outcomes/destroy/{id}', 'learning_outcome_destroy')->name('sigac.academic_coordination.programming.learning_outcome.destroy'); // Eliminar resultado de aprendizaje (Coordinación Académica)
            Route::get('academic_coordination/learning_outcomes/load/create/{program_id}', 'learning_outcome_load_create')->name('sigac.academic_coordination.programming.learning_outcome.load.create'); // Vista carge de resultado de aprendizaje (Coordinación Académica)
            Route::post('academic_coordination/learning_outcomes/load/store', 'learning_outcome_load_store')->name('sigac.academic_coordination.programming.learning_outcome.load.store'); // Registrar resultados de aprendizaje cargados (Coordinación Académica)

            // Parametro - Actividades Externas
            Route::post('academic_coordination/programming/parameters/external_activities/store', 'external_activity_store')->name('sigac.academic_coordination.programming.parameters.external_activities.store'); // Registrar actividad externa (Coordinación Académica)
            Route::post('wellbeing/programming/parameters/external_activities/store', 'external_activity_store')->name('sigac.wellbeing.programming.parameters.external_activities.store'); // Registrar actividad externa (Bienestar)
            Route::post('academic_coordination/programming/parameters/external_activities/update', 'external_activity_update')->name('sigac.academic_coordination.programming.parameters.external_activities.update'); // Actualizar actividad externa (Coordinación Académica)
            Route::post('wellbeing/programming/parameters/external_activities/update', 'external_activity_update')->name('sigac.wellbeing.programming.parameters.external_activities.update'); // Actualizar actividad externa (Bienestar)
            Route::delete('academic_coordination/programming/parameters/external_activities/destroy/{id}', 'external_activity_destroy')->name('sigac.academic_coordination.programming.parameters.external_activities.destroy'); // Eliminar actividad externa (Coordinación Académica)
            Route::delete('wellbeing/programming/parameters/external_activities/destroy/{id}', 'external_activity_destroy')->name('sigac.wellbeing.programming.parameters.external_activities.destroy'); // Eliminar actividad externa (Bienestar)

            // Parametro - Programas Especiales
            Route::post('academic_coordination/programming/parameters/special_program/store', 'special_program_store')->name('sigac.academic_coordination.programming.parameters.special_program.store'); // Registrar programa especial (Cordinacion Academica)
            Route::post('academic_coordination/programming/parameters/special_program/update', 'special_program_update')->name('sigac.academic_coordination.programming.parameters.special_program.update'); // Actualizar programa especial (Cordinacion Academica)
            Route::delete('academic_coordination/programming/parameters/special_program/destroy/{id}', 'special_program_destroy')->name('sigac.academic_coordination.programming.parameters.special_program.destroy'); // Eliminar programa especial (Cordinacion Academica)

            // Parametro - Profesiones
            Route::post('academic_coordination/profession/store', 'profession_store')->name('sigac.academic_coordination.programming.profession.store'); // Registrar profesion (Coordinación Académica)
            Route::post('academic_coordination/profession/update/{id}', 'profession_update')->name('sigac.academic_coordination.programming.profession.update'); // Actualizar profesion (Coordinación Académica)
            Route::delete('academic_coordination/profession/destroy/{id}', 'profession_destroy')->name('sigac.academic_coordination.programming.profession.destroy'); // Eliminar profesion (Coordinación Académica)

            // Gestion de la Programacion de Instructor
            Route::get('academic_coordination/programming/management/index', 'management_programming')->name('sigac.academic_coordination.programming.management.index'); // Vista gestionar la programación (Coordinación Académica)
            Route::get('academic_coordination/programming/management/search_quarter_number', 'management_search_quarter_number')->name('sigac.academic_coordination.programming.management.search_quarter_number'); // Consultar numero de trimestres (Coordinación Académica)
            Route::get('academic_coordination/programming/management/filterquarterlie', 'management_programming_filterquarterlie')->name('sigac.academic_coordination.programming.management.filterquarterlie'); // Consultar trimestralización (Coordinación Académica)
            Route::get('academic_coordination/programming/management/filterlearning', 'management_programming_filterlearning')->name('sigac.academic_coordination.programming.management.filterlearning'); // Consultar resultados de aprendizaje (Coordinación Académica)
            Route::get('academic_coordination/programming/management/filterinstructor', 'management_programming_filterinstructor')->name('sigac.academic_coordination.programming.management.filterinstructor'); // Consultar instructores (Coordinación Académica)
            Route::get('academic_coordination/programming/management/filterenvironment', 'management_programming_filterenvironment')->name('sigac.academic_coordination.programming.management.filterenvironment'); // Consultar ambientes (Coordinación Académica)
            Route::get('academic_coordination/programming/management/filterstatelearning', 'management_programming_filterstatelearning')->name('sigac.academic_coordination.programming.management.filterstatelearning'); // Consultar estado del resultado de prendizaje (Coordinación Académica)
            Route::post('academic_coordination/programming/management/store', 'management_programming_store')->name('sigac.academic_coordination.programming.management.store'); // Registrar programación del instructor (Coordinación Académica)
            Route::get('academic_coordination/programming/management/search_course', 'management_programming_search_course')->name('sigac.academic_coordination.programming.management.search_course'); // Vista gestionar la programación (Coordinación Académica)
            Route::post('academic_coordination/programming/management/destroy', 'management_programming_destroy')->name('sigac.academic_coordination.programming.management.destroy'); // Eliminar programación de un dia especifico del trimestre (Coordinación Académica)
            Route::post('academic_coordination/programming/management/novelty/store', 'management_programming_novelty')->name('sigac.academic_coordination.programming.management.novelty.store'); // Registrar novedad de la programación (Coordinación Académica)
            Route::post('instructor/programming/management/novelty/store', 'management_programming_novelty')->name('sigac.instructor.programming.management.novelty.store'); // Registrar novedad de la programación (Coordinación Académica)
            Route::post('instructor/programming/management/destroy', 'management_programming_destroy')->name('sigac.instructor.programming.management.destroy'); // Eliminar programación de un dia especifico del trimestre (Coordinación Académica)
            Route::get('instructor/programming/management/search_course', 'management_programming_search_course')->name('sigac.instructor.programming.management.search_course'); // Vista gestionar la programación (Coordinación Académica)


            // Horarios
            Route::get('programming/index', 'programming')->name('cefa.sigac.programming.index'); // Programación de horarios
            Route::get('academic_coordination/programming/index', 'programming')->name('sigac.academic_coordination.programming.index'); // Programación de horarios
            Route::get('instructor/programming/index', 'programming')->name('sigac.instructor.programming.index'); // Programación de horarios
            Route::get('support/programming/index', 'programming')->name('sigac.support.programming.index'); // Programación de horarios
            Route::get('apprentice/programming/index', 'programming')->name('sigac.apprentice.programming.index'); // Programación de horarios
            Route::get('wellness/programming/index', 'programming')->name('sigac.wellness.programming.index'); // Programación de horarios
      
            Route::post('academic_coordination/programming/management/filter', 'management_filter')->name('sigac.academic_coordination.programming.management.filter'); // Consultar filtro de horario
            Route::post('academic_coordination/programming/management/search', 'management_search')->name('sigac.academic_coordination.programming.management.search'); // Consultar programaciones del instructor
            Route::post('instructor/programming/management/filter', 'management_filter')->name('sigac.instructor.programming.management.filter'); // Consultar filtro de horario
            Route::post('instructor/programming/management/search', 'management_search')->name('sigac.instructor.programming.management.search'); // Consultar programaciones del instructor
            Route::post('support/programming/management/filter', 'management_filter')->name('sigac.support.programming.management.filter'); // Consultar filtro de horario
            Route::post('support/programming/management/search', 'management_search')->name('sigac.support.programming.management.search'); // Consultar programaciones del instructor
            Route::post('apprentice/programming/management/filter', 'management_filter')->name('sigac.apprentice.programming.management.filter'); // Consultar filtro de horario
            Route::post('apprentice/programming/management/search', 'management_search')->name('sigac.apprentice.programming.management.search'); // Consultar programaciones del instructor
            Route::post('wellness/programming/management/filter', 'management_filter')->name('sigac.wellness.programming.management.filter'); // Consultar filtro de horario
            Route::post('wellness/programming/management/search', 'management_search')->name('sigac.wellness.programming.management.search'); // Consultar programaciones del instructor
            Route::post('programming/management/search', 'management_search')->name('cefa.sigac.programming.management.search'); // Consultar programaciones del instructor
            Route::post('programming/management/filter', 'management_filter')->name('cefa.sigac.programming.management.filter'); // Consultar filtro de horario

            // Fechas
            Route::get('academic_coordination/programming/dates', 'dates_index')->name('sigac.academic_coordination.programming.dates_index'); // Programación de horarios (Coordinación Académica)
            Route::post('academic_coordination/programming/dates/store_dates', 'store_dates')->name('sigac.academic_coordination.profession.dates_index.store_dates'); // Eliminar profesion (Coordinación Académica)
            
            // Solicitud de Programa
            Route::get('instructor/programming/program_request/table', 'program_request_table')->name('sigac.instructor.programming.program_request.table'); // Solicitud de programa (Instructor)
            Route::get('academic_coordination/programming/program_request/table', 'program_request_table')->name('sigac.academic_coordination.programming.program_request.table'); // Solicitud de programa (Coordinación Académica)
            Route::get('instructor/programming/program_request/index', 'program_request_index')->name('sigac.instructor.programming.program_request.index'); // Solicitud de programa (Coordinación Académica)
            Route::get('academic_coordination/programming/program_request/index', 'program_request_index')->name('sigac.academic_coordination.programming.program_request.index'); // Solicitud de programa (Coordinación Académica)
            Route::get('instructor/programming/program_request/searchperson', 'program_request_searchperson')->name('sigac.instructor.programming.program_request.searchperson'); // Buscar instructor
            Route::get('academic_coordination/programming/program_request/searchperson', 'program_request_searchperson')->name('sigac.academic_coordination.programming.program_request.searchperson'); // Buscar instructor
            Route::get('instructor/programming/program_request/searchprofession', 'program_request_searchprofession')->name('sigac.instructor.programming.program_request.searchprofession'); // Buscar profesion
            Route::get('academic_coordination/programming/program_request/searchprofession', 'program_request_searchprofession')->name('sigac.academic_coordination.programming.program_request.searchprofession'); // Buscar profesion
            Route::get('instructor/programming/program_request/searchempresa', 'program_request_searchempresa')->name('sigac.instructor.programming.program_request.searchempresa'); // Buscar profesion
            Route::get('academic_coordination/programming/program_request/searchempresa', 'program_request_searchempresa')->name('sigac.academic_coordination.programming.program_request.searchempresa'); // Buscar profesion
            Route::get('instructor/programming/program_request/searchapplicant', 'program_request_searchapplicant')->name('sigac.instructor.programming.program_request.searchapplicant'); // Buscar profesion
            Route::get('academic_coordination/programming/program_request/searchapplicant', 'program_request_searchapplicant')->name('sigac.academic_coordination.programming.program_request.searchapplicant'); // Buscar profesion
            Route::post('instructor/programming/program_request/store', 'program_request_store')->name('sigac.instructor.programming.program_request.store'); // Registrar solicitud del programa (Instructor)
            Route::post('academic_coordination/programming/program_request/store', 'program_request_store')->name('sigac.academic_coordination.programming.program_request.store'); // Registrar solicitud del programa (Instructor)
            Route::get('academic_coordination/programming/program_request/download/{id}', 'program_request_download')->name('sigac.academic_coordination.programming.program_request.program_request_download'); // Buscar profesion
            Route::get('instructor/programming/program_request/download/{id}', 'program_request_download')->name('sigac.instructor.programming.program_request.program_request_download'); // Buscar profesion
            Route::post('academic_coordination/programming/program_request/document_store/{id}', 'program_request_document_store')->name('sigac.academic_coordination.programming.program_request.document_store'); // Registrar solicitud del programa (Instructor)
            Route::post('instructor/programming/program_request/document_store/{id}', 'program_request_document_store')->name('sigac.instructor.programming.program_request.document_store'); // Registrar solicitud del programa (Instructor)
            Route::get('support/programming/program_request/characterization/index', 'program_request_characterization')->name('sigac.support.programming.program_request.characterization.index'); // Solicitudes de caracterización (Apoyo)
            Route::post('support/programming/program_request/characterization/store/{id}', 'program_request_characterization_store')->name('sigac.support.programming.program_request.characterization.store'); // Caracterizar programa (Apoyo)
            Route::post('support/programming/program_request/characterization/devolution/{id}', 'program_request_characterization_devolution')->name('sigac.instructor.programming.program_request.characterization.devolution'); // Devolver solicitud (Apoyo)
            Route::get('support/programming/program_request/download/{id}', 'program_request_download')->name('sigac.support.programming.program_request.program_request_download'); // Buscar profesion

            //Actividades externas
            Route::get('academic_coordination/programming/external_activities/index', 'external_activities_index')->name('sigac.academic_coordination.programming.external_activities.index'); // Buscar profesion
            Route::get('academic_coordination/programming/external_activities/create', 'external_activities_create')->name('sigac.academic_coordination.programming.external_activities.external_activities_create'); // Buscar profesion
            Route::get('academic_coordination/programming/external_activities/search_course', 'external_activities_search_course')->name('sigac.academic_coordination.programming.external_activities.external_activities_search_course'); // Buscar profesion
            Route::post('academic_coordination/programming/external_activities/store', 'external_activities_store')->name('sigac.academic_coordination.programming.external_activities.external_activities_store'); // Buscar profesion
            Route::get('academic_coordination/programming/external_activities/searchperson', 'external_activities_search_person')->name('sigac.academic_coordination.programming.external_activities.external_activities_search_person');
            Route::post('academic_coordination/programming/external_activities/approved_external_activities', 'approved_external_activities')->name('sigac.academic_coordination.programming.external_activities.approved_external_activities'); // Buscar profesion
            Route::post('academic_coordination/programming/external_activities/cancel_external_activities', 'cancel_external_activities')->name('sigac.academic_coordination.programming.external_activities.cancel_external_activities'); // Buscar profesion
 
            Route::get('wellness/programming/external_activities/index', 'external_activities_index')->name('sigac.wellness.programming.external_activities.index'); // Buscar profesion
            Route::get('wellness/programming/external_activities/create', 'external_activities_create')->name('sigac.wellness.programming.external_activities.external_activities_create'); // Buscar profesion
            Route::get('wellness/programming/external_activities/search_course', 'external_activities_search_course')->name('sigac.wellness.programming.external_activities.external_activities_search_course'); // Buscar profesion
            Route::post('wellness/programming/external_activities/store', 'external_activities_store')->name('sigac.wellness.programming.external_activities.external_activities_store'); // Buscar profesion
            Route::get('wellness/programming/external_activities/searchperson', 'external_activities_search_person')->name('sigac.wellness.programming.external_activities.external_activities_search_person');
        });

        // RUTAS PLANEACION CURRICULAR
        Route::controller(CurriculumPlanningController::class)->group(function () {

            // ---------------- Proyecto Formatrivo ---------------------------
            Route::get('academic_coordination/curriculum_planning/training_project/index', 'training_project_index')->name('sigac.academic_coordination.curriculum_planning.training_project.index'); // Vista proyectos formativos y cursos (Coordinación Académica)
            Route::get('academic_coordination/curriculum_planning/training_project/quarterlie/index/{training_project_id}/{course_id}', 'training_project_quarterlie_index')->name('sigac.academic_coordination.curriculum_planning.training_project.quarterlie.index'); // Vista trimestralización del curso (Coordinación Académica)
            Route::post('academic_coordination/curriculum_planning/training_project/store', 'training_project_store')->name('sigac.academic_coordination.curriculum_planning.training_project.store'); // Registrar proyecto formativo (Coordinación Académica)
            Route::post('academic_coordination/curriculum_planning/training_project/update', 'training_project_update')->name('sigac.academic_coordination.curriculum_planning.training_project.update'); // Actualizar proyecto formativo (Coordinación Académica)
            Route::delete('academic_coordination/curriculum_planning/training_project/destroy/{id}', 'training_project_destroy')->name('sigac.academic_coordination.curriculum_planning.training_project.destroy'); // Eliminar proyecto formativo (Coordinación Académica)

            // ---------------- Trimestralización ---------------------------
            Route::get('academic_coordination/curriculum_planning/quarterlie/filter/learning', 'quarterlie_filterlearning')->name('sigac.academic_coordination.curriculum_planning.quarterlie.filterlearning'); // Consultar resultados de aprendizaje por competencia (Coordinación Académica)
            Route::post('academic_coordination/curriculum_planning/quarterlie/store', 'quarterlie_store')->name('sigac.academic_coordination.curriculum_planning.quarterlie.store'); // Registrar trimestralizaciòn (Coordinación Académica)
            Route::post('academic_coordination/curriculum_planning/quarterlie/destroy/{id}', 'quarterlie_destroy')->name('sigac.academic_coordination.curriculum_planning.quarterlie.destroy'); // Eliminar trimestralizaciòn (Coordinación Académica)

            /* Route::post('academic_coordination/curriculum_planning/quarterlie/update/{id}', 'quarterlie_update')->name('sigac.academic_coordination.curriculum_planning.quarterlie.update'); // Registrar Trimestralización (Coordinación Académica) */
            /* Route::get('academic_coordination/curriculum_planning/quarterlie/index', 'quarterlie_index')->name('sigac.academic_coordination.curriculum_planning.quarterlie.index'); // Trimestralización (Coordinación Académica) */
            /* Route::get('academic_coordination/curriculum_planning/quarterlie/create/{quarter_number}/{training_project_id}/{programId}', 'quarterlie_create')->name('sigac.academic_coordination.curriculum_planning.quarterlie.create'); // Fromulario de registro (Coordinación Académica) */
            /* Route::get('academic_coordination/curriculum_planning/quarterlie/edit/{id}', 'quarterlie_edit')->name('sigac.academic_coordination.curriculum_planning.quarterlie.edit'); // Fromulario de registro (Coordinación Académica) */
            /* Route::get('academic_coordination/curriculum_planning/quarterlie/filterlearnin_outcome', 'quarterlie_filterlearnin_outcome')->name('sigac.academic_coordination.curriculum_planning.quarterlie.filterlearnin_outcome'); // Fromulario de registro (Coordinación Académica) */

            
            Route::get('academic_coordination/curriculum_planning/quarterlie/load/create/{course_id}/{training_project_id}', 'quarterlie_load_create')->name('sigac.academic_coordination.curriculum_planning.quarterlie.load.create'); // Vista carge de trimestralizaciòn (Coordinación Académica)
            Route::post('academic_coordination/curriculum_planning/quarterlie/load/store', 'quarterlie_load_store')->name('sigac.academic_coordination.curriculum_planning.quarterlie.load.store'); // Registrar trimestralizaciones cargadas (Coordinación Académica)            
            
            //Profession x Competencia 
            Route::get('academic_coordination/curriculum_planning/assign_learning_outcomes/competencie_profession_index', 'competencie_profession_index')->name('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.competencie_profession_index'); // Vista asignacion de profesion por competencia (Coordinación Académica)
            Route::post('academic_coordination/curriculum_planning/assign_learning_outcomes/competencie_profession_table', 'competencie_profession_table')->name('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.competencie_profession.table'); // Consultar profesiones asignadas por programa (Coordinación Académica)
            Route::post('academic_coordination/curriculum_planning/assign_learning_outcomes/competencie_profession_store', 'competencie_profession_store')->name('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.competencie_profession_store'); // Asignar profesion a la competencia (Coordinación Académica)
            Route::get('academic_coordination/curriculum_planning/assign_learning_outcomes/competencie_profession_search/{id}', 'competencie_profession_search')->name('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.competencie_profession_search'); // Actualizar la consulta profesiones asignadas (Coordinación Académica)
            Route::delete('academic_coordination/curriculum_planning/assign_learning_outcomes/competencie_profession_destroy/{competencie_id}/{profession_id}', 'competencie_profession_destroy')->name('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.competencie_profession_destroy'); // Eliminar asociación de la profesion asignada con la competencia (Coordinación Académica)
        
            // Curso x Proyecto formativo
            Route::get('academic_coordination/curriculum_planning/course_trainig_project/course_training_project_index', 'course_training_project_index')->name('sigac.academic_coordination.curriculum_planning.course_trainig_project.index'); // Vista asociacion de curso por proyecto formativo (Coordinación Académica)
            Route::post('academic_coordination/curriculum_planning/course_trainig_project/table', 'course_training_project_table')->name('sigac.academic_coordination.curriculum_planning.course_trainig_project.table'); // Consulta de los cursos por proyecto formativo (Coordinación Académica)
            Route::post('academic_coordination/curriculum_planning/course_trainig_project/course_training_project_store', 'course_training_project_store')->name('sigac.academic_coordination.curriculum_planning.course_trainig_project.store'); // Asociar curso al proyecto formativo (Coordinación Académica)
            Route::delete('academic_coordination/curriculum_planning/course_trainig_project/course_training_project_destroy/{training_project_id}/{course_id}', 'course_training_project_destroy')->name('sigac.academic_coordination.curriculum_planning.course_trainig_project.destroy'); // Eliminar asociacion del curso con el proyecto formativo (Coordinación Académica)


           // Competencia por calse de ambiente
           Route::get('academic_coordination/curriculum_planning/learning_class/index', 'competencie_class_index')->name('sigac.academic_coordination.curriculum_planning.competencie_class.index'); // Vista asociacion de competencia por clase de ambiente (Coordinación Académica)
           Route::post('academic_coordination/curriculum_planning/learning_class/learning_outcome/learning_class_store', 'competencie_class_store')->name('sigac.academic_coordination.curriculum_planning.competencie_class.store'); // Asociar la competencia a la clase de ambiente (Coordinación Académica)
           Route::delete('academic_coordination/curriculum_planning/learning_class/destroy/{class_environment_id}/{competencie_id}', 'competencie_class_destroy')->name('sigac.academic_coordination.curriculum_planning.competencie_class.destroy'); // Eliminar asociacion de la competencia con la clase de ambiente (Coordinación Académica)

            // ---------------- Juicio Evaluativo ---------------------------
            Route::get('academic_coordination/curriculum_planning/evaluative_judgment/index', 'evaluative_judgment_index')->name('sigac.academic_coordination.curriculum_planning.evaluative_judgment.index'); // Proyecto formativo (Coordinación Académica)
            Route::get('academic_coordination/curriculum_planning/evaluative_judgment/load/create', 'evaluative_judgment_create')->name('sigac.academic_coordination.curriculum_planning.evaluative_judgment.load.create'); // Proyecto formativo (Coordinación Académica)
            Route::post('academic_coordination/curriculum_planning/evaluative_judgment/load/store', 'evaluative_judgment_store')->name('sigac.academic_coordination.curriculum_planning.evaluative_judgment.load.store'); // Proyecto formativo (Coordinación Académica)
            Route::post('academic_coordination/curriculum_planning/evaluative_judgment/search', 'evaluative_judgment_search')->name('sigac.academic_coordination.curriculum_planning.evaluative_judgment.search'); // Proyecto formativo (Coordinación Académica)
            Route::post('academic_coordination/curriculum_planning/evaluative_judgment/filter', 'evaluative_judgment_filter')->name('sigac.academic_coordination.curriculum_planning.evaluative_judgment.filter'); // Proyecto formativo (Coordinación Académica)
        });

        // RUTAS GESTION DE ASISTENCIAS
        Route::controller(AttendanceController::class)->group(function () {
            // ---------------- Asistencia ---------------------------
            Route::get('instructor/attendances/attendance/index', 'attendance_index')->name('sigac.instructor.attendances.attendance.index'); // Vista registro de asistencia (Instructor)
            Route::get('instructor/attendances/attendance/search', 'attendance_search')->name('sigac.instructor.attendances.attendance.search'); // Consultar asistencia (Instructor)
            Route::get('instructor/attendances/attendance/store', 'attendance_store')->name('sigac.instructor.attendances.attendance.store'); // Registra asistencia del aprendiz (Instructor)
            Route::get('academic_coordination/reports/attendance', 'reports_attendance')->name('sigac.academic_coordination.reports.attendance.index'); // Vista principal de la sección de reportes de asistencia (Coordinación Académica)

            /* Route::get('instructor/consult/excuses', 'consult_excuses')->name('sigac.instructor.attendance.excuses'); // Consultar excusas de aprendiz (Instructor) */
            /* Route::get('instructor/consult/attendance', 'consult_attendance')->name('sigac.instructor.attendance.consult'); // Consultar asistencia por aprendiz o tituladas (Instructor) */
            /* Route::get('instructor/register', 'index')->name('sigac.instructor.attendance.register'); // Registrar asistencia de aprendiz por titulada (Instructor) */
            /* Route::get('wellness/consult/attendance', 'consult_attendance')->name('sigac.wellness.attendance.consult'); // Consultar asistencia por aprendiz o tituladas (Bienestar) */
            /* Route::get('instructor/reports/attendance', 'reports_attendance')->name('sigac.instructor.reports.attendance.index'); // Vista principal de la sección de reportes de asistencia (Instructor) */
            /* Route::get('wellness/reports/attendance', 'reports_attendance')->name('sigac.wellness.reports.attendance.index'); // Vista principal de la sección de reportes de asistencia (Bienestar) */
        });

        // RUTAS GESTION DE APRENDICES
        Route::controller(ApprenticeController::class)->group(function () {
            Route::get('apprentice/excuses', 'send_excuses')->name('sigac.apprentice.excuses.send'); // Enviar excusa para justificación de inasistencia (Aprendiz)
        });

        // RUTAS GESTION DE INSTRUCTORES
        Route::controller(InstructorManagementController::class)->group(function () {

            // Gestion de Instructores
            Route::get('academic_coordination/human_talent/management_instructor/profession_instructor_index', 'profession_instructor_index')->name('sigac.academic_coordination.human_talent.management_instructor.profession_instructor.index'); // Vista asociacion de instructores por profesion (Coordinación Académica)
            Route::post('academic_coordination/human_talent/management_instructor/profession_instructor_store', 'profession_instructor_store')->name('sigac.academic_coordination.human_talent.management_instructor.profession_instructor.store'); // Asociar profesion al instructor (Coordinación Académica)
            Route::delete('academic_coordination/human_talent/management_instructor/profession_instructor_destroy/{id}', 'profession_instructor_destroy')->name('sigac.academic_coordination.human_talent.management_instructor.profession_instructor.destroy'); // Eliminar asociación de la profesion y el instructor (Coordinación Académica)

            // Resultados de aprendizaje x instructor
            Route::get('academic_coordination/human_talent/assign_learning_outcomes/learning_out_people_index', 'learning_out_people_index')->name('sigac.academic_coordination.human_talent.assign_learning_outcomes.index'); // Vista asociacion de resultado de aprendizaje por instructor (Coordinación Académica)
            Route::post('academic_coordination/human_talent/assign_learning_outcomes/table', 'learning_out_people_table')->name('sigac.academic_coordination.human_talent.assign_learning_outcomes.table'); // Consultar asociacion de instructores por resultado de aprendizaje (Coordinación Académica)
            Route::post('academic_coordination/human_talent/assign_learning_outcomes/learning_out_people_store', 'learning_out_people_store')->name('sigac.academic_coordination.human_talent.assign_learning_outcomes.store'); // Asociar resultado de aprendizaje al instructor (Coordinación Académica)
            Route::get('academic_coordination/human_talent/assign_learning_outcomes/learning_out_people_search_instructor/{id}', 'learning_out_people_search_instructor')->name('sigac.academic_coordination.human_talent.assign_learning_outcomes.search_instructor'); // Consultar instructor apto para el resultado de aprendizaje (Coordinación Académica)
            Route::get('academic_coordination/human_talent/assign_learning_outcomes/learning_out_people_search_competencie/{id}', 'learning_out_people_search_competencie')->name('sigac.academic_coordination.human_talent.assign_learning_outcomes.search_competencie'); // Consultar competencias del programa (Coordinación Académica)
            Route::get('academic_coordination/human_talent/assign_learning_outcomes/learning_out_people_search_learning_outcome/{id}', 'learning_out_people_search_learning_outcome')->name('sigac.academic_coordination.human_talent.assign_learning_outcomes.search_learning_outcome'); // Consultar resultado de aprendizaje (Coordinación Académica)
            Route::delete('academic_coordination/human_talent/assign_learning_outcomes/learning_out_people_destroy/{learning_outcome_person_id}', 'learning_out_people_destroy')->name('sigac.academic_coordination.human_talent.assign_learning_outcomes.destroy'); // Eliminar asociación del resultado de aprendizaje al instructor (Coordinación Académica)

        });

        // RUTAS CONTROL DE AMBIENTES
        Route::controller(EnvironmentControlController::class)->group(function () {
            
            // Entrada inventario
            Route::get('instructor/environmentcontrol/environment_inventory_movement/entrance/index', 'entrance_index')->name('sigac.instructor.environmentcontrol.environment_inventory_movement.entrance.index'); // Vista reporte trimestralización (Coordinación Académica)
            Route::post('instructor/environmentcontrol/environment_inventory_movement/entrance/store', 'entrance_store')->name('sigac.instructor.environmentcontrol.environment_inventory_movement.entrance.store'); // Vista reporte trimestralización (Coordinación Académica)

            // Movimiento interno de inventario
            Route::get('instructor/environmentcontrol/environment_inventory_movement/exit/index', 'exit_index')->name('sigac.instructor.environmentcontrol.environment_inventory_movement.exit.index'); // Vista reporte trimestralización (Coordinación Académica)
            Route::get('instructor/environmentcontrol/environment_inventory_movement/exit/searchelement', 'exit_searchelement')->name('sigac.instructor.environmentcontrol.environment_inventory_movement.exit.searchelement'); // Vista reporte trimestralización (Coordinación Académica)
            Route::post('instructor/environmentcontrol/environment_inventory_movement/exit/store', 'exit_store')->name('sigac.instructor.environmentcontrol.environment_inventory_movement.exit.store'); // Vista reporte trimestralización (Coordinación Académica)

            // Asignacion de bodegas a ambientes
            Route::get('instructor/environmentcontrol/assign_environment_warehouse/index', 'assign_environment_warehouse_index')->name('sigac.instructor.environmentcontrol.assign_environment_warehouse.index'); // Vista reporte trimestralización (Coordinación Académica)
            Route::post('instructor/environmentcontrol/assign_environment_warehouse/store', 'assign_environment_warehouse_store')->name('sigac.instructor.environmentcontrol.assign_environment_warehouse.store'); // Vista reporte trimestralización (Coordinación Académica)
            Route::delete('instructor/environmentcontrol/assign_environment_warehouse/{environment_id}/{warehouse_id}', 'assign_environment_warehouse_destroy')->name('sigac.instructor.environmentcontrol.assign_environment_warehouse.destroy'); // Eliminar asociación de la profesion a

            Route::get('instructor/environmentcontrol/environment_inventory_movement/check/index', 'check_index')->name('sigac.instructor.environmentcontrol.environment_inventory_movement.check.index'); // Vista reporte trimestralización (Coordinación Académica)
            Route::get('instructor/environmentcontrol/environment_inventory_movement/check/searchelement', 'check_searchinventory')->name('sigac.instructor.environmentcontrol.environment_inventory_movement.check.searchinventory'); // Vista reporte trimestralización (Coordinación Académica)
            Route::get('instructor/environmentcontrol/environment_inventory_movement/check/searchperson', 'check_searchperson')->name('sigac.instructor.environmentcontrol.environment_inventory_movement.check.searchperson'); // Vista reporte trimestralización (Coordinación Académica)
            Route::post('instructor/environmentcontrol/environment_inventory_movement/check/store', 'check_store')->name('sigac.instructor.environmentcontrol.environment_inventory_movement.check.store'); // Vista reporte trimestralización (Coordinación Académica)

            Route::get('securitystaff/environmentcontrol/environment_inventory_movement/check_pending/index', 'check_pending_index')->name('sigac.securitystaff.environmentcontrol.environment_inventory_movement.check.index'); // Vista reporte trimestralización (Coordinación Académica)
            Route::get('securitystaff/environmentcontrol/environment_inventory_movement/check_pending/searchelement', 'check_searchinventory')->name('sigac.securitystaff.environmentcontrol.environment_inventory_movement.check.searchinventory'); // Vista reporte trimestralización (Coordinación Académica)
            Route::get('securitystaff/environmentcontrol/environment_inventory_movement/check_pending/searchperson', 'check_searchperson')->name('sigac.securitystaff.environmentcontrol.environment_inventory_movement.check.searchperson'); // Vista reporte trimestralización (Coordinación Académica)
            Route::post('securitystaff/environmentcontrol/environment_inventory_movement/check_pending/store', 'check_store')->name('sigac.securitystaff.environmentcontrol.environment_inventory_movement.check.store'); // Vista reporte trimestralización (Coordinación Académica)

        });
        
        // RUTAS GESTION DE REPORTES
        Route::controller(ReportController::class)->group(function () {
            
            // Reporte trimestralización
            Route::get('academic_coordination/reports/quarterlies/index', 'report_quarterlie_index')->name('sigac.academic_coordination.reports.quartelies.index'); // Vista reporte trimestralización (Coordinación Académica)
            Route::get('instructor/reports/quarterlies/index', 'report_quarterlie_index')->name('sigac.instructor.reports.quartelies.index'); // Vista reporte trimestralización (Coordinación Académica)
            Route::post('academic_coordination/reports/quarterlies/search', 'report_quarterlie_search')->name('sigac.academic_coordination.reports.quartelies.search'); // Consultar trimestralización del curso (Coordinación Académica)
            Route::post('instructor/reports/quarterlies/search', 'report_quarterlie_search')->name('sigac.instructor.reports.quartelies.search'); // Consultar trimestralización del curso (Coordinación Académica)

            // ---------------- Consultar datos de instructores --------------------
            Route::get('academic_coordination/reports/instructors/index', 'instructors_index')->name('sigac.academic_coordination.reports.instructors.index'); // Reporte de instructores (Coordinación Académica)
            Route::post('academic_coordination/reports/instructors/search', 'instructors_search')->name('sigac.academic_coordination.reports.instructors.search'); // Consultar datos de instructores (Coordinación Académica)

            // ---------------- Consultar disponibilidad de ambientes --------------------
            Route::get('academic_coordination/reports/environments/index', 'environments_index')->name('sigac.academic_coordination.reports.environments.index'); // Ambientes (Coordinación Académica)
            Route::post('academic_coordination/reports/environments/search', 'environments_search')->name('sigac.academic_coordination.reports.environments.search'); // Consultar ambientes (Coordinación Académica)
            Route::get('academic_coordination/reports/environments/search_person', 'search_person')->name('sigac.academic_coordination.reports.environments.search_person'); // Buscar personas (Coordinación Académica)
            Route::post('academic_coordination/reports/environments/institucional_request_store', 'institucional_request_store')->name('sigac.academic_coordination.reports.environments.institucional_request_store'); // Guardar reprogramacion (Coordinación Académica)
            
            Route::get('academic_coordination/reports/active_courses/index', 'active_courses_index')->name('sigac.academic_coordination.reports.active_courses.index'); // Ambientes (Coordinación Académica)
            Route::post('academic_coordination/reports/active_courses/search', 'active_courses_search')->name('sigac.academic_coordination.reports.active_courses.search'); // Consultar ambientes (Coordinación Académica)

        });

    });
});
