<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['lang'])->group(function () { //Middleware que permite la internacionalizacion

    Route::prefix('sigac')->group(function () {  // agrega el prefijo en la url (sicefa.test/sigac/...)

        // Rutas generales para el modulo SIGAC
        Route::controller(SIGACController::class)->group(function () { // Agregar por única vez el controlodaar para posteriormente solo definir rutas con el formato (url, método_controlador)->name(nombre_de_ruta)
            Route::get('index', 'index')->name('cefa.sigac.index'); // Vista principal y pública de la aplicación.
            Route::get('information', 'info')->name('cefa.sigac.info'); // Vista mas info sobre SIGAC y pública de la aplicación (Pública)
            Route::get('developers', 'devs')->name('cefa.sigac.devs'); // Vista sobre desarrolladores y creditos sobre SIGAC y pública de la aplicación (Pública)
            Route::get('academic', 'academic_coordination_dashboard')->name('sigac.academic_coordination.dashboard'); // Panel de control de coordinación académica (Coordinación Académica)
            Route::get('instructors', 'instructor_dashboards')->name('sigac.instructor.dashboards'); // Panel de control del instructor (Instructor)
            Route::get('wellness', 'wellness_dashboard')->name('sigac.wellness.dashboard'); // Panel de control de bienestar (Bienestar)
            Route::get('apprentice', 'apprentice_dashboard')->name('sigac.apprentice.dashboard'); // Panel de control de aprendiz (Aprendiz)
            Route::get('support', 'support_dashboard')->name('sigac.support.dashboard'); // Panel de control de apoyo (Apoyo)

            //Rutas para el menu de prueba
            Route::get('proof', 'proof')->name('cefa.sigac.proof'); // Vista principal y pública de la aplicación.

        });

        // Rutas para la programacion de eventos y horarios
        Route::controller(ProgrammeController::class)->group(function () {
            //  ---------- Progamacion de instructor ------------------
            Route::get('academic_coordination/program', 'programming')->name('sigac.academic_coordination.programming.index'); // Programación de horarios (Coordinación Académica)
            Route::get('academic_coordination/program/get', 'programming_get')->name('sigac.academic_coordination.programming.get'); // Programación de horarios (Coordinación Académica)
            Route::get('academic_coordination/events', 'event_programming')->name('sigac.academic_coordination.event_programming.index'); // Programación de eventos (Coordinación Académica)



            // Parametros
            Route::get('academic_coordination/programming/parameters/index', 'parameter')->name('sigac.academic_coordination.programming.parameters.index'); // Parametros de programacion (Coordinación Académica)
            Route::get('wellbeing/programming/parameters/index', 'parameter')->name('sigac.wellbeing.programming.parameters.index'); // Parametros de programacion (Bienestar)

            //Parametro - Competencias
            Route::get('academic_coordination/competences/index/{program_id}', 'parameter_competencies')->name('sigac.academic_coordination.competences.index'); // Registrar competencia (Coordinación Académica)
            Route::post('academic_coordination/competences/store', 'competence_store')->name('sigac.academic_coordination.competences.store'); // Registrar competencia (Coordinación Académica)
            Route::post('academic_coordination/competences/update/{id}', 'competence_update')->name('sigac.academic_coordination.competences.update'); // Actualizar competencia (Coordinación Académica)
            Route::delete('academic_coordination/competences/destroy/{id}', 'competence_destroy')->name('sigac.academic_coordination.competences.destroy'); // Eliminar competencia (Coordinación Académica)

            //Parametro - Resultados de aprendizaje
            Route::get('academic_coordination/learning_outcomes/index/{competencie_id}', 'parameter_learning_outcomes')->name('sigac.academic_coordination.learning_outcomes.index'); // Registrar competencia (Coordinación Académica)
            Route::post('academic_coordination/learning_outcomes/store', 'learning_outcome_store')->name('sigac.academic_coordination.learning_outcome.store'); // Registrar Resultado de aprendizaje (Coordinación Académica)
            Route::post('academic_coordination/learning_outcomes/update/{id}', 'learning_outcome_update')->name('sigac.academic_coordination.learning_outcome.update'); // Actualizar Resultado de aprendizaje (Coordinación Académica)
            Route::delete('academic_coordination/learning_outcomes/destroy/{id}', 'learning_outcome_destroy')->name('sigac.academic_coordination.learning_outcome.destroy'); // Eliminar Resultado de aprendizaje (Coordinación Académica)
            Route::get('academic_coordination/learning_outcomes/load/create/{program_id}', 'learning_outcome_load_create')->name('sigac.academic_coordination.programming.learning_outcome.load.create'); // Eliminar Resultado de aprendizaje (Coordinación Académica)
            Route::post('academic_coordination/learning_outcomes/load/store', 'learning_outcome_load_store')->name('sigac.academic_coordination.programming.learning_outcome.load.store'); // Eliminar Resultado de aprendizaje (Coordinación Académica)

            // Parametro - Actividades Externas
            Route::post('wellbeing/programming/parameters/external_activities/store', 'external_activity_store')->name('sigac.wellbeing.programming.parameters.external_activities.store'); // Registrar actividad externa (Bienestar)
            Route::post('wellbeing/programming/parameters/external_activities/update', 'external_activity_update')->name('sigac.wellbeing.programming.parameters.external_activities.update'); // Actualizar actividad externa (Bienestar)
            Route::delete('wellbeing/programming/parameters/external_activities/destroy/{id}', 'external_activity_destroy')->name('sigac.wellbeing.programming.parameters.external_activities.destroy'); // Eliminar actividad externa (Bienestar)

            // Parametro - Programas Especiales
            Route::post('academic_coordination/programming/parameters/special_program/store', 'special_program_store')->name('sigac.academic_coordination.programming.parameters.special_program.store'); // Registrar programa especial (Cordinacion Academica)
            Route::post('academic_coordination/programming/parameters/special_program/update', 'special_program_update')->name('sigac.academic_coordination.programming.parameters.special_program.update'); // Actualizar programa especial (Cordinacion Academica)
            Route::delete('academic_coordination/programming/parameters/special_program/destroy/{id}', 'special_program_destroy')->name('sigac.academic_coordination.programming.parameters.special_program.destroy'); // Eliminar programa especial (Cordinacion Academica)

            // Parametro - Profesiones
            Route::post('academic_coordination/profession/store', 'profession_store')->name('sigac.academic_coordination.profession.store'); // Registrar profesion (Coordinación Académica)
            Route::post('academic_coordination/profession/update/{id}', 'profession_update')->name('sigac.academic_coordination.profession.update'); // Actualizar profesion (Coordinación Académica)
            Route::delete('academic_coordination/profession/destroy/{id}', 'profession_destroy')->name('sigac.academic_coordination.profession.destroy'); // Eliminar profesion (Coordinación Académica)
            Route::post('academic_coordination/programming/parameters/competences/store', 'store')->name('sigac.academic_coordination.programming.parameters.competences.store'); // Parametros de programacion (Coordinación Académica)

            // Gestion de la Programacion de Instructor
            Route::get('academic_coordination/programming/management/index', 'management_programming')->name('sigac.academic_coordination.programming.management.index'); // Gestion de la programacion (Coordinación Académica)
            Route::get('academic_coordination/programming/management/filterquarterlie', 'management_programming_filterquarterlie')->name('sigac.academic_coordination.programming.management.filterquarterlie'); // Gestion de la programacion (Coordinación Académica)
            Route::get('academic_coordination/programming/management/filterlearning', 'management_programming_filterlearning')->name('sigac.academic_coordination.programming.management.filterlearning'); // Gestion de la programacion (Coordinación Académica)
            Route::get('academic_coordination/programming/management/filterinstructor', 'management_programming_filterinstructor')->name('sigac.academic_coordination.programming.management.filterinstructor'); // Gestion de la programacion (Coordinación Académica)
            Route::get('academic_coordination/programming/management/filterenvironment', 'management_programming_filterenvironment')->name('sigac.academic_coordination.programming.management.filterenvironment'); // Gestion de la programacion (Coordinación Académica)
            Route::get('academic_coordination/programming/management/filterstatelearning', 'management_programming_filterstatelearning')->name('sigac.academic_coordination.programming.management.filterstatelearning'); // Gestion de la programacion (Coordinación Académica)
            Route::post('academic_coordination/programming/management/store', 'management_programming_store')->name('sigac.academic_coordination.programming.management.store'); // Registrar programacion (Coordinación Académica)
            Route::post('academic_coordination/programming/management/novelty', 'management_programming_novelty')->name('sigac.academic_coordination.programming.management.novelty'); // Novedad de programacion (Coordinación Académica)


            // Horarios
            Route::post('academic_coordination/programming/management/filter', 'management_filter')->name('sigac.academic_coordination.programming.management.filter'); // Registro programación de horarios (Coordinación Académica)
            Route::post('academic_coordination/programming/management/search', 'management_search')->name('sigac.academic_coordination.programming.management.search'); // Registro programación de horarios (Coordinación Académica)
       
            // Fechas
            Route::get('academic_coordination/programming/dates', 'dates_index')->name('sigac.academic_coordination.programming.dates_index'); // Programación de horarios (Coordinación Académica)
            Route::post('academic_coordination/programming/dates/store_dates', 'store_dates')->name('sigac.academic_coordination.profession.dates_index.store_dates'); // Eliminar profesion (Coordinación Académica)
            
            // Solicitud de Programa
            Route::get('instructor/programming/program_request/index', 'program_request_index')->name('sigac.instructor.programming.program_request.index'); // Programación de horarios (Coordinación Académica)
            Route::get('programming/program_request/searchperson', 'program_request_searchperson')->name('sigac.programming.program_request.searchperson'); // Buscar instructor
            Route::get('programming/program_request/searchprofession', 'program_request_searchprofession')->name('sigac.programming.program_request.searchprofession'); // Buscar profesion
            Route::post('instructor/programming/program_request/store', 'program_request_store')->name('sigac.instructor.programming.program_request.store'); // Registrar solicitud del programa (Instructor)
            Route::get('support/programming/program_request/characterization/index', 'program_request_characterization')->name('sigac.support.programming.program_request.characterization.index'); // Solicitudes de caracterización (Apoyo)
            Route::post('support/programming/program_request/characterization/store/{id}', 'program_request_characterization_store')->name('sigac.instructor.programming.program_request.characterization.store'); // Caracterizar programa (Apoyo)
            Route::post('support/programming/program_request/characterization/devolution/{id}', 'program_request_characterization_devolution')->name('sigac.instructor.programming.program_request.characterization.devolution'); // Devolver solicitud (Apoyo)
        });

        // Rutas para la visualiación de horarios
        Route::controller(ScheduleController::class)->group(function () {
            Route::get('instructor/schedule', 'schedule_instructor')->name('sigac.instructor.schedule_instructor.index'); // Visualización de horario asignado a instructor (Instructor)
            Route::get('instructor/titled', 'schedule_titled')->name('sigac.instructor.schedule_titled.index'); // Visualización de horario asignado a titulada (Instructor)
            Route::get('apprentice/schedule', 'schedule_apprentice')->name('sigac.apprentice.schedule_apprentice.index'); // Visualización de horario asignado al aprendiz (Aprendiz)
        });

        // Rutas para la planeacion curricular
        Route::controller(CurriculumPlanningController::class)->group(function () {

            // ---------------- Proyecto Formatrivo ---------------------------
            Route::get('academic_coordination/curriculum_planning/training_project/index', 'training_project_index')->name('sigac.academic_coordination.curriculum_planning.training_project.index'); // Proyecto formativo (Coordinación Académica)
            Route::get('academic_coordination/curriculum_planning/training_project/quarterlie/index/{training_project_id}/{course_id}', 'training_project_quarterlie_index')->name('sigac.academic_coordination.curriculum_planning.training_project.quarterlie.index'); // Proyecto formativo (Coordinación Académica)
            Route::post('academic_coordination/curriculum_planning/training_project/store', 'training_project_store')->name('sigac.academic_coordination.curriculum_planning.training_project.store'); // Registrar proyecto formativo (Coordinación Académica)
            Route::post('academic_coordination/curriculum_planning/training_project/update', 'training_project_update')->name('sigac.academic_coordination.curriculum_planning.training_project.update'); // Actualizar proyecto formativo (Coordinación Académica)
            Route::post('academic_coordination/curriculum_planning/training_project/destroy/{id}', 'training_project_destroy')->name('sigac.academic_coordination.curriculum_planning.training_project.destroy'); // Eliminar proyecto formativo (Coordinación Académica)

            // ---------------- Trimestralización ---------------------------
            Route::get('academic_coordination/curriculum_planning/quarterlie/index', 'quarterlie_index')->name('sigac.academic_coordination.curriculum_planning.quarterlie.index'); // Trimestralización (Coordinación Académica)
            Route::get('academic_coordination/curriculum_planning/quarterlie/create/{quarter_number}/{training_project_id}/{programId}', 'quarterlie_create')->name('sigac.academic_coordination.curriculum_planning.quarterlie.create'); // Fromulario de registro (Coordinación Académica)
            Route::get('academic_coordination/curriculum_planning/quarterlie/filter/learning', 'quarterlie_filterlearning')->name('sigac.academic_coordination.curriculum_planning.quarterlie.filterlearning'); // Fromulario de registro (Coordinación Académica)
            Route::post('academic_coordination/curriculum_planning/quarterlie/store', 'quarterlie_store')->name('sigac.academic_coordination.curriculum_planning.quarterlie.store'); // Registrar Trimestralización (Coordinación Académica)
            Route::get('academic_coordination/curriculum_planning/quarterlie/edit/{id}', 'quarterlie_edit')->name('sigac.academic_coordination.curriculum_planning.quarterlie.edit'); // Fromulario de registro (Coordinación Académica)
            Route::get('academic_coordination/curriculum_planning/quarterlie/filterlearnin_outcome', 'quarterlie_filterlearnin_outcome')->name('sigac.academic_coordination.curriculum_planning.quarterlie.filterlearnin_outcome'); // Fromulario de registro (Coordinación Académica)
            Route::post('academic_coordination/curriculum_planning/quarterlie/update/{id}', 'quarterlie_update')->name('sigac.academic_coordination.curriculum_planning.quarterlie.update'); // Registrar Trimestralización (Coordinación Académica)
            Route::post('academic_coordination/curriculum_planning/quarterlie/destroy/{id}', 'quarterlie_destroy')->name('sigac.academic_coordination.curriculum_planning.quarterlie.destroy'); // Registrar Trimestralización (Coordinación Académica)
            
             //Profession x Program 
             Route::get('academic_coordination/curriculum_planning/assign_learning_outcomes/competencie_profession_index', 'competencie_profession_index')->name('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.competencie_profession_index'); // Index de Gestion de instructores (Coordinación Académica)
             Route::post('academic_coordination/curriculum_planning/assign_learning_outcomes/competencie_profession_table', 'competencie_profession_table')->name('sigac.academic_coordination.curriculum_planning.competencie_profession.table'); // Index de Gestion de instructores (Coordinación Académica)
             Route::post('academic_coordination/curriculum_planning/assign_learning_outcomes/competencie_profession_store', 'competencie_profession_store')->name('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.competencie_profession_store'); // Index de Gestion de instructores (Coordinación Académica)
             Route::get('academic_coordination/curriculum_planning/assign_learning_outcomes/competencie_profession_search/{id}', 'competencie_profession_search')->name('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.competencie_profession_search'); // Index de Gestion de instructores (Coordinación Académica)
             Route::delete('academic_coordination/curriculum_planning/assign_learning_outcomes/competencie_profession_destroy/{competencie_id}/{profession_id}', 'competencie_profession_destroy')->name('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.competencie_profession_destroy'); // Index de Gestion de instructores (Coordinación Académica)
        
             // Curso x Proyecto formativo
             Route::get('academic_coordination/curriculum_planning/course_trainig_project/course_training_project_index', 'course_training_project_index')->name('sigac.academic_coordination.course_trainig_project.course_trainig_project.course_training_project_index'); // Index de Gestion de instructores (Coordinación Académica)
             Route::post('academic_coordination/curriculum_planning/course_trainig_project/table', 'course_training_project_table')->name('sigac.academic_coordination.course_trainig_project.course_trainig_project.table'); // Index de Gestion de instructores (Coordinación Académica)
             Route::post('academic_coordination/curriculum_planning/course_trainig_project/course_training_project_store', 'course_training_project_store')->name('sigac.academic_coordination.course_trainig_project.course_trainig_project.course_training_project_store'); // Index de Gestion de instructores (Coordinación Académica)
             Route::delete('academic_coordination/curriculum_planning/course_trainig_project/course_training_project_destroy/{training_project_id}/{course_id}', 'course_training_project_destroy')->name('sigac.academic_coordination.curriculum_planning.course_trainig_project.course_training_project_destroy'); // Index de Gestion de instructores (Coordinación Académica)
 

            // ---------------- Resultado de aprendizaje por clase de ambiente ---------------------------
            Route::get('academic_coordination/curriculum_planning/learning_class/index', 'competencie_class_index')->name('sigac.academic_coordination.curriculum_planning.competencie_class.index'); // Proyecto formativo (Coordinación Académica)
            Route::post('academic_coordination/curriculum_planning/learning_class/learning_outcome/learning_class_store', 'competencie_class_store')->name('sigac.academic_coordination.curriculum_planning.competencie_class.store'); // Index de Gestion de instructores (Coordinación Académica)
            Route::delete('academic_coordination/curriculum_planning/learning_class/destroy/{class_environment_id}/{competencie_id}', 'competencie_class_destroy')->name('sigac.academic_coordination.curriculum_planning.competencie_class.destroy'); // Index de Gestion de instructores (Coordinación Académica)

            // ---------------- Cargar Juicio Evaluativo ---------------------------
            Route::get('academic_coordination/curriculum_planning/evaluative_judgment/index', 'evaluative_judgment_index')->name('sigac.academic_coordination.curriculum_planning.evaluative_judgment.index'); // Proyecto formativo (Coordinación Académica)
            Route::get('academic_coordination/curriculum_planning/evaluative_judgment/load/create', 'evaluative_judgment_create')->name('sigac.academic_coordination.curriculum_planning.evaluative_judgment.load.create'); // Proyecto formativo (Coordinación Académica)
            Route::post('academic_coordination/curriculum_planning/evaluative_judgment/load/store', 'evaluative_judgment_store')->name('sigac.academic_coordination.curriculum_planning.evaluative_judgment.load.store'); // Proyecto formativo (Coordinación Académica)
            Route::post('academic_coordination/curriculum_planning/evaluative_judgment/search', 'evaluative_judgment_search')->name('sigac.academic_coordination.curriculum_planning.evaluative_judgment.search'); // Proyecto formativo (Coordinación Académica)
            Route::post('academic_coordination/curriculum_planning/evaluative_judgment/filter', 'evaluative_judgment_filter')->name('sigac.academic_coordination.curriculum_planning.evaluative_judgment.filter'); // Proyecto formativo (Coordinación Académica)
        });

        // Rutas para la administración de asistencias
        Route::controller(AttendanceController::class)->group(function () {
            Route::get('instructor/attendances/attendance/index', 'attendance_index')->name('sigac.instructor.attendances.attendance.index'); // Consultar excusas de aprendiz (Instructor)
            Route::get('instructor/attendances/attendance/search', 'attendance_search')->name('sigac.instructor.attendances.attendance.search'); // Consultar excusas de aprendiz (Instructor)
            Route::get('instructor/attendances/attendance/store', 'attendance_store')->name('sigac.instructor.attendances.attendance.store'); // Consultar excusas de aprendiz (Instructor)
            Route::get('instructor/consult/excuses', 'consult_excuses')->name('sigac.instructor.attendance.excuses'); // Consultar excusas de aprendiz (Instructor)
            Route::get('instructor/consult/attendance', 'consult_attendance')->name('sigac.instructor.attendance.consult'); // Consultar asistencia por aprendiz o tituladas (Instructor)
            Route::get('instructor/register', 'index')->name('sigac.instructor.attendance.register'); // Registrar asistencia de aprendiz por titulada (Instructor)
            Route::get('wellness/consult/attendance', 'consult_attendance')->name('sigac.wellness.attendance.consult'); // Consultar asistencia por aprendiz o tituladas (Bienestar)
            Route::get('academic_coordination/reports/attendance', 'reports_attendance')->name('sigac.academic_coordination.reports.attendance.index'); // Vista principal de la sección de reportes de asistencia (Coordinación Académica)
            Route::get('instructor/reports/attendance', 'reports_attendance')->name('sigac.instructor.reports.attendance.index'); // Vista principal de la sección de reportes de asistencia (Instructor)
            Route::get('wellness/reports/attendance', 'reports_attendance')->name('sigac.wellness.reports.attendance.index'); // Vista principal de la sección de reportes de asistencia (Bienestar)
        });

        // Rutas para la administración de funcionalidades de aprendiz
        Route::controller(ApprenticeController::class)->group(function () {
            Route::get('apprentice/excuses', 'send_excuses')->name('sigac.apprentice.excuses.send'); // Enviar excusa para justificación de inasistencia (Aprendiz)
        });

        // Rutas para la programacion de eventos y horarios
        Route::controller(InstructorManagementController::class)->group(function () {
            // Gestion de Instructores
            Route::get('academic_coordination/human_talent/management_instructor/profession_instructor_index', 'profession_instructor_index')->name('sigac.academic_coordination.human_talent.management_instructor.profession_instructor_index'); // Index de Gestion de instructores (Coordinación Académica)
            Route::post('academic_coordination/human_talent/management_instructor/profession_instructor_store', 'profession_instructor_store')->name('sigac.academic_coordination.human_talent.management_instructor.profession_instructor_store'); // Index de Gestion de instructores (Coordinación Académica)
            Route::delete('academic_coordination/human_talent/management_instructor/profession_instructor_destroy/{id}', 'profession_instructor_destroy')->name('sigac.academic_coordination.human_talent.management_instructor.profession_instructor_destroy'); // Index de Gestion de instructores (Coordinación Académica)

            // Resultados de aprendizaje x instructor
            Route::get('academic_coordination/human_talent/assign_learning_outcomes/learning_out_people_index', 'learning_out_people_index')->name('sigac.academic_coordination.human_talent.assign_learning_outcomes.learning_out_people_index'); // Index de Gestion de instructores (Coordinación Académica)
            Route::post('academic_coordination/human_talent/assign_learning_outcomes/table', 'learning_out_people_table')->name('sigac.academic_coordination.human_talent.assign_learning_outcomes.table'); // Index de Gestion de instructores (Coordinación Académica)
            Route::post('academic_coordination/human_talent/assign_learning_outcomes/learning_out_people_store', 'learning_out_people_store')->name('sigac.academic_coordination.human_talent.assign_learning_outcomes.learning_out_people_store'); // Index de Gestion de instructores (Coordinación Académica)
            Route::get('academic_coordination/human_talent/assign_learning_outcomes/learning_out_people_search_instructor/{id}', 'learning_out_people_search_instructor')->name('sigac.academic_coordination.human_talent.assign_learning_outcomes.learning_out_people_search_instructor'); // Index de Gestion de instructores (Coordinación Académica)
            Route::get('academic_coordination/human_talent/assign_learning_outcomes/learning_out_people_search_competencie/{id}', 'learning_out_people_search_competencie')->name('sigac.academic_coordination.human_talent.assign_learning_outcomes.learning_out_people_search_competencie'); // Index de Gestion de instructores (Coordinación Académica)
            Route::get('academic_coordination/human_talent/assign_learning_outcomes/learning_out_people_search_learning_outcome/{id}', 'learning_out_people_search_learning_outcome')->name('sigac.academic_coordination.human_talent.assign_learning_outcomes.learning_out_people_search_learning_outcome'); // Index de Gestion de instructores (Coordinación Académica)
            Route::delete('academic_coordination/human_talent/assign_learning_outcomes/learning_out_people_destroy/{learning_id}/{person_id}', 'learning_out_people_destroy')->name('sigac.academic_coordination.human_talent.assign_learning_outcomes.learning_out_people_destroy'); // Index de Gestion de instructores (Coordinación Académica)

        });
        
        // Rutas para la programacion de eventos y horarios
        Route::controller(ReportController::class)->group(function () {
            // Gestion de Instructores
            Route::get('academic_coordination/reports/quarterlies/index', 'report_quarterlie_index')->name('sigac.academic_coordination.reports.quartelies.index'); // Index de Gestion de instructores (Coordinación Académica)
            Route::post('academic_coordination/reports/quarterlies/search', 'report_quarterlie_search')->name('sigac.academic_coordination.reports.quartelies.search'); // Index de Gestion de instructores (Coordinación Académica)

        });

    });
});
