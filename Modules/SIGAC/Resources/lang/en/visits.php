<?php

return [

    // ====== Titles / Headers ======
    'title.create_request'     => 'Create visit request',
    'title.create_application' => 'Visit requests',
    'schedule.title' => 'Schedule visit',

    // ====== Company / Contact ======
    'company.label'        => 'Company or Institution',
    'company.placeholder'  => 'Type or select...',

    'contact.name'         => 'Contact name',
    'contact.phone'        => 'Phone',
    'contact.email'        => 'Email address',

    // ====== Request / Type ======
    'request.type.label'    => 'Request type',
    'request.type.visit'    => 'Visit',
    'request.type.practice' => 'Practice',
    'requirements'          => 'Requires',

    // ====== Practice requirements ======
    'practice.requirements.label' => 'What will they need?',
    'practice.requirements.help'  => 'E.g.: materials, laboratories, equipment, etc.',

    // ====== Additional data ======
    'people.count'         => 'Number of people',
    'people.list'          => 'People list (Excel)',

    'dates.received'       => 'Received date',
    'dates.response'       => 'Response date',

    'response.method'       => 'Response method',
    'response.method.call'  => 'Call',
    'response.method.email' => 'Email',
    'select.placeholder'    => 'Select...',

    'observations'          => 'Observations',

    // ====== General Actions (forms) ======
    'actions.submit' => 'Submit request',

    // ====== Modal: Created request / Detail ======
    'modal.created.title' => 'Request registered',
    'modal.close'         => 'Close',
    'modal.company'       => 'Company',
    'modal.contact'       => 'Contact',
    'modal.phone'         => 'Phone',
    'modal.type'          => 'Type',
    'modal.requirements'  => 'Requirements',
    'modal.state'         => 'Status',
    'modal.created_at'    => 'Creation date',
    'modal.observations'  =>'Observations',
    'modal.request'       =>'Solicitud',

    // ====== Listing / Request index ======
    'index.Applicant'   => 'Applicant',
    'index.Actions'     => 'Actions',

    // Runtime states (badge labels)
    'index.Unscheduled' => 'Unscheduled',
    'index.Scheduled'   => 'Scheduled',
    'index.Today'       => 'Today',
    'index.In_progress' => 'In progress',
    'index.Finish'      => 'Finished',
    'index.Cancel'      => 'Cancelled',

    'index.empty'       => 'No requests found.',

    // ====== People / Assignment block (reschedule, etc.) ======
    'people.types.all'        => 'All',
    'people.types.employee'   => 'Employee',
    'people.types.contractor' => 'Contractor',

    'people.search'       => 'Search person',
    'people.search_ph'    => 'Name or last name...',
    'people.notify_email' => 'Notification email',
    'people.notify_hint'  => 'Select which email will receive notifications.',
    'people.no_emails'    => 'This person has no registered emails.',
    'people.emails_error' => 'Emails could not be loaded.',

    // ====== Row actions (table buttons) ======
    'actions.view_detail'     => 'View details',
    'actions.schedule'        => 'Schedule visit',
    'actions.reschedule'      => 'Reschedule',
    'actions.cancel_visit'    => 'Cancel visit',
    'actions.preview_excel'   => 'View Excel in browser',
    'actions.open_excel'      => 'Open/download Excel',
    'actions.no_file'         => 'No file',
    'actions.close'           => 'Close',
    'actions.save'            => 'Save',
    'actions.confirm'         => 'Confirm',
    'actions.change_assignee' => 'Change assignee',

    // ====== States / Auxiliary messages ======
    'states.blocked_by_cancel' => 'Request cancelled',

    'badge.soon_24h' => 'Starts in ≤ 24h',

    'common.optional'     => 'optional',
    'common.assign_later' => '(Assign later)',

    // ====== Alerts / UI notes ======
    'alert.check_data'        => 'Please review the data:',
    'alert.reschedule_notice' => 'The contact and assigned staff will be notified if you reschedule or change the assignee.',
    // Render with {!! trans('sigac::visits.alert.cancel_warn') !!}
    'alert.cancel_warn'       => 'This action will mark the request as <strong>Cancelled</strong> and notify all parties.',

    'schedule.in_charge' => 'In charge',
    'schedule.type.all' => 'All',
    'schedule.type.employee' => 'Employee',
    'schedule.type.contractor' => 'Contractor',
    'schedule.search_placeholder' => 'Search by first or last name...',
    'schedule.search_hint' => 'Type at least 2 characters and select a person.',
    'schedule.email_label' => 'Notification email',
    'schedule.email_hint' => 'Select which email will receive the notifications.',
    'schedule.activity' => 'Activity to perform',
    'schedule.day' => 'Day',
    'schedule.start_time' => 'Start time',
    'schedule.end_time' => 'End time',
    'schedule.environment_label' => 'Environment (optional)',
    'schedule.environment_placeholder' => 'Select date and time to load environments...',
    'schedule.no_environment_label' => 'Do not assign an environment for now',
    'schedule.observations' => 'Observations',
    'schedule.button.submit' => 'Schedule',

    // JS Messages (environments)
    'schedule.env_assign_later_hint' => 'You can also leave ":assign_later".',
    'schedule.env_select_prompt'     => 'Select date and hours to query.',
    'schedule.env_loading'           => 'Loading available environments...',
    'schedule.env_range_invalid'     => 'Start time must be earlier than end time.',
    'schedule.env_none_available'    => 'No environments available for the selected range.',
    'schedule.env_loaded_ok'         => 'Free environments for the selected date and time range. You can also leave ":assign_later".',
    'schedule.env_loaded_empty'      => 'No free environments. You can leave ":assign_later".',

    // Reused
    'modal.request' => 'Request',
    'people.types.employee' => 'Employee',
    'people.types.contractor' => 'Contractor',
    'people.no_emails'    => 'This person has no registered emails.',
    'people.emails_error' => 'Could not load emails.',
    'common.assign_later' => '(Assign later)',
    'title.schedule'      => 'Schedule visit',
];
