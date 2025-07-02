<?php

return [
    // -----SIAController - General-----
    // Index
    'SIA_index_title_page' => 'Homepage',
    'SIA_index_title_view' => 'Homepage',
    // Devs
    'SIA_devs_title_page' => 'Developers',
    'SIA_devs_title_view' => 'Developers and Credits',
    // Info
    'SIA_info_title_page' => 'About us',
    'SIA_info_title_view' => 'About us',
    // Configuration
    'SIA_configuration_title_page' => 'Configuration',
    'SIA_configuration_title_view' => 'Configuration',

    // Index - Admin
    'SIA_admin_title_page' => 'Administrator',
    'SIA_admin_title_view' => 'Homepage',

    // -----ApprenticeResearcherController-----
    // Index
    'SIA_apprentice_index_title_page' => 'Apprentice Researchers',
    'SIA_apprentice_index_title_view' => 'List of Apprentices',
    // Create
    'SIA_apprentice_create_title_page' => 'Register Apprentice Researcher',
    'SIA_apprentice_create_title_view' => 'Register Apprentice Researcher',
    // Edit
    'SIA_apprentice_edit_title_page' => 'Edit Apprentice Researcher',
    'SIA_apprentice_edit_title_view' => 'Edit Apprentice Researcher',

    // -----InstructorResearcherController-----
    // Index
    'SIA_instructor_index_title_page' => 'Instructor Researchers',
    'SIA_instructor_index_title_view' => 'List of Instructors',
    // Create
    'SIA_instructor_create_title_page' => 'Register Instructor Researcher',
    'SIA_instructor_create_title_view' => 'Register Instructor Researcher',
    // Edit
    'SIA_instructor_edit_title_page' => 'Edit Instructor Researcher',
    'SIA_instructor_edit_title_view' => 'Edit Instructor Researcher',
    // Store/Update/Destroy
    'SIA_instructor_store_success' => 'Instructor researcher registered successfully!',
    'SIA_instructor_update_success' => 'Instructor researcher updated successfully!',
    'SIA_instructor_destroy_success' => 'Instructor researcher deleted successfully!',
    'SIA_instructor_destroy_error' => 'Could not delete the instructor researcher.',
    // Validations
    'SIA_instructor_document_type_required' => 'The document type is required.',
    'SIA_instructor_document_number_unique' => 'The document number is already registered.',
    'SIA_instructor_full_name_required' => 'The full name is required.',
    'SIA_instructor_gender_required' => 'The gender is required.',
    'SIA_instructor_phone_digits' => 'The phone number must be 10 digits.',
    'SIA_instructor_profession_exists' => 'The selected profession does not exist.',
    'SIA_instructor_email_unique' => 'The email is already registered.',
    'SIA_instructor_password_min' => 'The password must be at least 8 characters.',
    'SIA_instructor_research_skills_required' => 'Research skills are required.',

    // -----AdministratorController-----
    // Index
    'SIA_admin_index_title_page' => 'Administrators',
    'SIA_admin_index_title_view' => 'List of Administrators',
    // Create
    'SIA_admin_create_title_page' => 'Register Administrator',
    'SIA_admin_create_title_view' => 'Register Administrator',
    // Edit
    'SIA_admin_edit_title_page' => 'Edit Administrator',
    'SIA_admin_edit_title_view' => 'Edit Administrator',
    // Store/Update/Destroy
    'SIA_admin_store_success' => 'Administrator registered successfully!',
    'SIA_admin_update_success' => 'Administrator updated successfully!',
    'SIA_admin_destroy_success' => 'Administrator deleted successfully!',
    'SIA_admin_destroy_error' => 'Could not delete the administrator.',
    // Validations
    'SIA_admin_document_type_required' => 'The document type is required.',
    'SIA_admin_document_number_unique' => 'The document number is already registered.',
    'SIA_admin_full_name_required' => 'The full name is required.',
    'SIA_admin_gender_required' => 'The gender is required.',
    'SIA_admin_phone_digits' => 'The phone number must be 10 digits.',
    'SIA_admin_profession_exists' => 'The selected profession does not exist.',
    'SIA_admin_email_unique' => 'The email is already registered.',
    'SIA_admin_password_min' => 'The password must be at least 8 characters.',
    'SIA_admin_research_skills_required' => 'Research skills are required.',

    // -----EventSiaController-----
    // Index
    'SIA_event_index_title_page' => 'Events',
    'SIA_event_index_title_view' => 'List of Events',
    // Create
    'SIA_event_create_title_page' => 'Register Event',
    'SIA_event_create_title_view' => 'Register Event',
    // Edit
    'SIA_event_edit_title_page' => 'Edit Event',
    'SIA_event_edit_title_view' => 'Edit Event',
    // Store/Update/Destroy
    'SIA_event_store_success' => 'Event registered successfully!',
    'SIA_event_update_success' => 'Event updated successfully!',
    'SIA_event_destroy_success' => 'Event deleted successfully!',
    'SIA_event_destroy_error' => 'Could not delete the event.',
    // Validations
    'SIA_event_name_required' => 'The event name is required.',
    'SIA_event_image_required' => 'The event image is required.',
    'SIA_event_location_required' => 'The location is required.',
    'SIA_event_start_date_required' => 'The start date is required.',
    'SIA_event_start_date_valid' => 'The start date must be today or later.',
    'SIA_event_end_date_required' => 'The end date is required.',
    'SIA_event_end_date_valid' => 'The end date must be equal to or after the start date.',
    'SIA_event_organizer_required' => 'The organizer is required.',
    'SIA_event_contact_email_required' => 'The contact email is required.',
    'SIA_event_contact_email_unique' => 'The contact email is already registered.',
    'SIA_event_contact_phone_digits' => 'The contact phone must be 10 digits.',
    'SIA_event_status_required' => 'The status is required.',
    'SIA_event_status_valid' => 'The selected status is not valid.',

    // -----PublicationController-----
    'SIA_publication_index_title_page' => 'Publications List',
    'SIA_publication_index_title_view' => 'Publications',
    'SIA_publication_create_title_page' => 'Create Publication',
    'SIA_publication_create_title_view' => 'Publication Registration',
    'SIA_publication_edit_title_page' => 'Edit Publication',
    'SIA_publication_edit_title_view' => 'Publication Editing',
    'SIA_publication_pending_title_page' => 'Pending Publications',
    'SIA_publication_pending_title_view' => 'Publications Review',
    'SIA_publication_store_success' => 'Publication registered successfully',
    'SIA_publication_update_success' => 'Publication updated successfully',
    'SIA_publication_destroy_success' => 'Publication deleted successfully',
    'SIA_publication_destroy_error' => 'Error deleting the publication',
    'SIA_publication_review_success' => 'Publication reviewed successfully',
    'SIA_publication_title_required' => 'The title is required',
    'SIA_publication_pdf_path_required' => 'The PDF path is required',
    'SIA_publication_date_required' => 'The publication date is required',
    'SIA_publication_date_valid' => 'The publication date must be today or later',
    'SIA_publication_status_required' => 'The status is required',
    'SIA_publication_status_valid' => 'The status must be pending, published or rejected',
    'SIA_publication_review_status_required' => 'The review status is required',
    'SIA_publication_review_status_valid' => 'The review status must be published or rejected',

     // -----ProjectController-----
    'SIA_project_index_title_page' => 'List of Projects',
    'SIA_project_index_title_view' => 'Projects',
    'SIA_project_create_title_page' => 'Create Project',
    'SIA_project_create_title_view' => 'Project Registration',
    'SIA_project_edit_title_page' => 'Edit Project',
    'SIA_project_edit_title_view' => 'Project Edition',
    'SIA_project_store_success' => 'Project registered successfully',
    'SIA_project_update_success' => 'Project updated successfully',
    'SIA_project_destroy_success' => 'Project deleted successfully',
    'SIA_project_destroy_error' => 'Error deleting project',
    'SIA_project_title_required' => 'The name is required',
    'SIA_project_description_required' => 'The description is required',
    'SIA_project_start_date_required' => 'The start date is required',
    'SIA_project_start_date_valid' => 'The start date must be today or later',
    'SIA_project_end_date_required' => 'The end date is required',
    'SIA_project_end_date_valid' => 'The end date must be after the start date',
    'SIA_project_pdf_mimes' => 'The file must be a PDF',
    'SIA_project_pdf_max' => 'The file must not exceed 2MB',
    'SIA_project_status_required' => 'The status is required',
    'SIA_project_status_valid' => 'The status must be EN_CURSO, FINALIZADO or CANCELADO',
    'SIA_project_register_restricted' => 'Administrators cannot register as participants',
    'SIA_project_already_registered' => 'You are already registered in this project',
    'SIA_project_only_in_progress' => 'You can only register in projects in progress',
    'SIA_project_register_success' => 'Registration successful',

    // -----GroupController-----
    'SIA_group_index_title_page' => 'List of Groups',
    'SIA_group_index_title_view' => 'Groups',
    'SIA_group_create_title_page' => 'Create Group',
    'SIA_group_create_title_view' => 'Group Registration',
    'SIA_group_edit_title_page' => 'Edit Group',
    'SIA_group_edit_title_view' => 'Group Edition',
    'SIA_group_store_success' => 'Group created successfully',
    'SIA_group_update_success' => 'Group updated successfully',
    'SIA_group_destroy_success' => 'Group deleted successfully',
    'SIA_group_destroy_error' => 'Error deleting group',
    'SIA_group_name_required' => 'The name is required',
    'SIA_group_name_max' => 'The name must not exceed 100 characters',
    'SIA_group_name_unique' => 'The name must be unique',
    'SIA_group_description_required' => 'The description is required',
    'SIA_group_description_max' => 'The description must not exceed 800 characters',

    // -----AllianceController----
    'SIA_alliance_index_title_page' => 'List of Alliances',
    'SIA_alliance_index_title_view' => 'Alliances',
    'SIA_alliance_create_title_page' => 'Create Alliance',
    'SIA_alliance_create_title_view' => 'Alliance Registration',
    'SIA_alliance_edit_title_page' => 'Edit Alliance',
    'SIA_alliance_edit_title_view' => 'Alliance Edition',
    'SIA_alliance_store_success' => 'Alliance created successfully',
    'SIA_alliance_update_success' => 'Alliance updated successfully',
    'SIA_alliance_destroy_success' => 'Alliance deleted successfully',
    'SIA_alliance_destroy_error' => 'Error deleting alliance',
    'SIA_alliance_name_required' => 'The name is required',
    'SIA_alliance_name_max' => 'The name must not exceed 255 characters',
    'SIA_alliance_description_required' => 'The description is required',
    'SIA_alliance_organization_required' => 'The organization is required',
    'SIA_alliance_organization_max' => 'The organization must not exceed 255 characters',
    'SIA_alliance_email_required' => 'The email is required',
    'SIA_alliance_email_valid' => 'The email must be valid',
    'SIA_alliance_email_max' => 'The email must not exceed 255 characters',
    'SIA_alliance_start_date_required' => 'The start date is required',
    'SIA_alliance_start_date_valid' => 'The start date must be valid',
    'SIA_alliance_end_date_valid' => 'The end date must be valid',
    'SIA_alliance_end_date_after' => 'The end date must be after the start date',
    'SIA_alliance_status_required' => 'The status is required',
    'SIA_alliance_status_valid' => 'The status must be "active" or "inactive"',
];
