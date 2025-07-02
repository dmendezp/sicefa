<?php

return [
    // -----SIAController - General-----
    // Index
    'SIA_index_title_page' => 'Página principal',
    'SIA_index_title_view' => 'Página principal',
    // Devs
    'SIA_devs_title_page' => 'Desarrolladores',
    'SIA_devs_title_view' => 'Desarrolladores y créditos',
    // Info
    'SIA_info_title_page' => 'Acerca de',
    'SIA_info_title_view' => 'Acerca de',
    // Configuration
    'SIA_configuration_title_page' => 'Configuración',
    'SIA_configuration_title_view' => 'Configuración',

    // Index - Admin
    'SIA_admin_title_page' => 'Administrador',
    'SIA_admin_title_view' => 'Página principal',

    // -----ApprenticeResearcherController-----
    // Index
    'SIA_apprentice_index_title_page' => 'Aprendices Investigadores',
    'SIA_apprentice_index_title_view' => 'Listado de Aprendices',
    // Create
    'SIA_apprentice_create_title_page' => 'Registrar Aprendiz Investigador',
    'SIA_apprentice_create_title_view' => 'Registrar Aprendiz Investigador',
    // Edit
    'SIA_apprentice_edit_title_page' => 'Editar Aprendiz Investigador',
    'SIA_apprentice_edit_title_view' => 'Editar Aprendiz Investigador',

    // -----InstructorResearcherController-----
    // Index
    'SIA_instructor_index_title_page' => 'Instructores Investigadores',
    'SIA_instructor_index_title_view' => 'Listado de Instructores',
    // Create
    'SIA_instructor_create_title_page' => 'Registrar Instructor Investigador',
    'SIA_instructor_create_title_view' => 'Registrar Instructor Investigador',
    // Edit
    'SIA_instructor_edit_title_page' => 'Editar Instructor Investigador',
    'SIA_instructor_edit_title_view' => 'Editar Instructor Investigador',
    // Store/Update/Destroy
    'SIA_instructor_store_success' => '¡Instructor investigador registrado exitosamente!',
    'SIA_instructor_update_success' => '¡Instructor investigador actualizado exitosamente!',
    'SIA_instructor_destroy_success' => '¡Instructor investigador eliminado exitosamente!',
    'SIA_instructor_destroy_error' => 'No se pudo eliminar el instructor investigador.',
    // Validaciones
    'SIA_instructor_document_type_required' => 'El tipo de documento es obligatorio.',
    'SIA_instructor_document_number_unique' => 'El número de documento ya está registrado.',
    'SIA_instructor_full_name_required' => 'El nombre completo es obligatorio.',
    'SIA_instructor_gender_required' => 'El género es obligatorio.',
    'SIA_instructor_phone_digits' => 'El número de celular debe tener 10 dígitos.',
    'SIA_instructor_profession_exists' => 'La profesión seleccionada no existe.',
    'SIA_instructor_email_unique' => 'El correo electrónico ya está registrado.',
    'SIA_instructor_password_min' => 'La contraseña debe tener al menos 8 caracteres.',
    'SIA_instructor_research_skills_required' => 'Las habilidades de investigación son obligatorias.',

    // -----AdministratorController-----
    // Index
    'SIA_admin_index_title_page' => 'Administradores',
    'SIA_admin_index_title_view' => 'Listado de Administradores',
    // Create
    'SIA_admin_create_title_page' => 'Registrar Administrador',
    'SIA_admin_create_title_view' => 'Registrar Administrador',
    // Edit
    'SIA_admin_edit_title_page' => 'Editar Administrador',
    'SIA_admin_edit_title_view' => 'Editar Administrador',
    // Store/Update/Destroy
    'SIA_admin_store_success' => '¡Administrador registrado exitosamente!',
    'SIA_admin_update_success' => '¡Administrador actualizado exitosamente!',
    'SIA_admin_destroy_success' => '¡Administrador eliminado exitosamente!',
    'SIA_admin_destroy_error' => 'No se pudo eliminar el administrador.',
    // Validaciones
    'SIA_admin_document_type_required' => 'El tipo de documento es obligatorio.',
    'SIA_admin_document_number_unique' => 'El número de documento ya está registrado.',
    'SIA_admin_full_name_required' => 'El nombre completo es obligatorio.',
    'SIA_admin_gender_required' => 'El género es obligatorio.',
    'SIA_admin_phone_digits' => 'El número de celular debe tener 10 dígitos.',
    'SIA_admin_profession_exists' => 'La profesión seleccionada no existe.',
    'SIA_admin_email_unique' => 'El correo electrónico ya está registrado.',
    'SIA_admin_password_min' => 'La contraseña debe tener al menos 8 caracteres.',
    'SIA_admin_research_skills_required' => 'Las habilidades de investigación son obligatorias.',

    // -----EventSiaController-----
    // Index
    'SIA_event_index_title_page' => 'Eventos',
    'SIA_event_index_title_view' => 'Listado de Eventos',
    // Create
    'SIA_event_create_title_page' => 'Registrar Evento',
    'SIA_event_create_title_view' => 'Registrar Evento',
    // Edit
    'SIA_event_edit_title_page' => 'Editar Evento',
    'SIA_event_edit_title_view' => 'Editar Evento',
    // Store/Update/Destroy
    'SIA_event_store_success' => '¡Evento registrado exitosamente!',
    'SIA_event_update_success' => '¡Evento actualizado exitosamente!',
    'SIA_event_destroy_success' => '¡Evento eliminado exitosamente!',
    'SIA_event_destroy_error' => 'No se pudo eliminar el evento.',
    // Validaciones
    'SIA_event_name_required' => 'El nombre del evento es obligatorio.',
    'SIA_event_image_required' => 'La imagen del evento es obligatoria.',
    'SIA_event_location_required' => 'La ubicación es obligatoria.',
    'SIA_event_start_date_required' => 'La fecha de inicio es obligatoria.',
    'SIA_event_start_date_valid' => 'La fecha de inicio debe ser hoy o posterior.',
    'SIA_event_end_date_required' => 'La fecha de finalización es obligatoria.',
    'SIA_event_end_date_valid' => 'La fecha de finalización debe ser igual o posterior a la de inicio.',
    'SIA_event_organizer_required' => 'El organizador es obligatorio.',
    'SIA_event_contact_email_required' => 'El correo de contacto es obligatorio.',
    'SIA_event_contact_email_unique' => 'El correo de contacto ya está registrado.',
    'SIA_event_contact_phone_digits' => 'El teléfono de contacto debe tener 10 dígitos.',
    'SIA_event_status_required' => 'El estado es obligatorio.',
    'SIA_event_status_valid' => 'El estado seleccionado no es válido.',

   // -----PublicationController-----
    'SIA_publication_index_title_page' => 'Lista de Publicaciones',
    'SIA_publication_index_title_view' => 'Publicaciones',
    'SIA_publication_create_title_page' => 'Crear Publicación',
    'SIA_publication_create_title_view' => 'Registro de Publicación',
    'SIA_publication_edit_title_page' => 'Editar Publicación',
    'SIA_publication_edit_title_view' => 'Edición de Publicación',
    'SIA_publication_pending_title_page' => 'Publicaciones Pendientes',
    'SIA_publication_pending_title_view' => 'Revisión de Publicaciones',
    'SIA_publication_store_success' => 'Publicación creada exitosamente',
    'SIA_publication_update_success' => 'Publicación actualizada exitosamente',
    'SIA_publication_destroy_success' => 'Publicación eliminada exitosamente',
    'SIA_publication_destroy_error' => 'Error al eliminar la publicación',
    'SIA_publication_review_success' => 'Publicación revisada exitosamente',
    'SIA_publication_title_required' => 'El título es obligatorio',
    'SIA_publication_pdf_path_required' => 'La ruta del PDF es obligatoria',
    'SIA_publication_date_required' => 'La fecha de publicación es obligatoria',
    'SIA_publication_date_valid' => 'La fecha de publicación debe ser hoy o posterior',
    'SIA_publication_status_required' => 'El estado es obligatorio',
    'SIA_publication_status_valid' => 'El estado debe ser "pending", "published" o "rejected"',
    'SIA_publication_review_status_required' => 'El estado de revisión es obligatorio',
    'SIA_publication_review_status_valid' => 'El estado de revisión debe ser "published" o "rejected"',
    'SIA_publication_pdf_must_be_file' => 'El archivo debe ser un documento válido.',
    'SIA_publication_pdf_must_be_pdf' => 'El archivo debe ser un PDF.',
    'SIA_publication_pdf_max_size' => 'El archivo no debe superar los 2MB.',

    // -----ProjectController-----
    'SIA_project_index_title_page' => 'Lista de Proyectos',
    'SIA_project_index_title_view' => 'Proyectos',
    'SIA_project_create_title_page' => 'Crear Proyecto',
    'SIA_project_create_title_view' => 'Registro de Proyecto',
    'SIA_project_edit_title_page' => 'Editar Proyecto',
    'SIA_project_edit_title_view' => 'Edición de Proyecto',
    'SIA_project_store_success' => 'Proyecto registrado exitosamente',
    'SIA_project_update_success' => 'Proyecto actualizado exitosamente',
    'SIA_project_destroy_success' => 'Proyecto eliminado exitosamente',
    'SIA_project_destroy_error' => 'Error al eliminar el proyecto',
    'SIA_project_title_required' => 'El nombre es obligatorio',
    'SIA_project_description_required' => 'La descripción es obligatoria',
    'SIA_project_start_date_required' => 'La fecha de inicio es obligatoria',
    'SIA_project_start_date_valid' => 'La fecha de inicio debe ser hoy o posterior',
    'SIA_project_end_date_required' => 'La fecha de fin es obligatoria',
    'SIA_project_end_date_valid' => 'La fecha de fin debe ser posterior a la fecha de inicio',
    'SIA_project_pdf_mimes' => 'El archivo debe ser un PDF',
    'SIA_project_pdf_max' => 'El archivo no debe superar los 2MB',
    'SIA_project_status_required' => 'El estado es obligatorio',
    'SIA_project_status_valid' => 'El estado debe ser EN_CURSO, FINALIZADO o CANCELADO',
    'SIA_project_register_restricted' => 'Los administradores no pueden registrarse como participantes',
    'SIA_project_already_registered' => 'Ya estás registrado en este proyecto',
    'SIA_project_only_in_progress' => 'Solo puedes registrarte en proyectos en curso',
    'SIA_project_register_success' => 'Registro exitoso',

        // -----GroupController-----
    'SIA_group_index_title_page' => 'Lista de Grupos',
    'SIA_group_index_title_view' => 'Grupos',
    'SIA_group_create_title_page' => 'Crear Grupo',
    'SIA_group_create_title_view' => 'Registro de Grupo',
    'SIA_group_edit_title_page' => 'Editar Grupo',
    'SIA_group_edit_title_view' => 'Edición de Grupo',
    'SIA_group_store_success' => 'Grupo creado exitosamente',
    'SIA_group_update_success' => 'Grupo actualizado exitosamente',
    'SIA_group_destroy_success' => 'Grupo eliminado exitosamente',
    'SIA_group_destroy_error' => 'Error al eliminar el grupo',
    'SIA_group_name_required' => 'El nombre es obligatorio',
    'SIA_group_name_max' => 'El nombre no debe exceder 100 caracteres',
    'SIA_group_name_unique' => 'El nombre debe ser único',
    'SIA_group_description_required' => 'La descripción es obligatoria',
    'SIA_group_description_max' => 'La descripción no debe exceder 800 caracteres',

    // -----AllianceController-----
    'SIA_alliance_index_title_page' => 'Lista de Alianzas',
    'SIA_alliance_index_title_view' => 'Alianzas',
    'SIA_alliance_create_title_page' => 'Crear Alianza',
    'SIA_alliance_create_title_view' => 'Registro de Alianza',
    'SIA_alliance_edit_title_page' => 'Editar Alianza',
    'SIA_alliance_edit_title_view' => 'Edición de Alianza',
    'SIA_alliance_store_success' => 'Alianza creada exitosamente',
    'SIA_alliance_update_success' => 'Alianza actualizada exitosamente',
    'SIA_alliance_destroy_success' => 'Alianza eliminada exitosamente',
    'SIA_alliance_destroy_error' => 'Error al eliminar la alianza',
    'SIA_alliance_name_required' => 'El nombre es obligatorio',
    'SIA_alliance_name_max' => 'El nombre no debe exceder 255 caracteres',
    'SIA_alliance_description_required' => 'La descripción es obligatoria',
    'SIA_alliance_organization_required' => 'La organización es obligatoria',
    'SIA_alliance_organization_max' => 'La organización no debe exceder 255 caracteres',
    'SIA_alliance_email_required' => 'El correo es obligatorio',
    'SIA_alliance_email_valid' => 'El correo debe ser válido',
    'SIA_alliance_email_max' => 'El correo no debe exceder 255 caracteres',
    'SIA_alliance_start_date_required' => 'La fecha de inicio es obligatoria',
    'SIA_alliance_start_date_valid' => 'La fecha de inicio debe ser válida',
    'SIA_alliance_end_date_valid' => 'La fecha de fin debe ser válida',
    'SIA_alliance_end_date_after' => 'La fecha de fin debe ser posterior a la fecha de inicio',
    'SIA_alliance_status_required' => 'El estado es obligatorio',
    'SIA_alliance_status_valid' => 'El estado debe ser "active" o "inactive"',
];
