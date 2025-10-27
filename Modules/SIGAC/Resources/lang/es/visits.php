<?php

return [

    // ====== Títulos / Encabezados ======
    'title.create_request'     => 'Crear solicitud de visita',
    'title.create_application' => 'Solicitudes de visita',
    'title.schedule' => 'Agendar visita', 

    // ====== Empresa / Contacto ======
    'company.label'        => 'Empresa o Institución',
    'company.placeholder'  => 'Escriba o seleccione...',

    'contact.name'         => 'Nombre de contacto',
    'contact.phone'        => 'Teléfono',
    'contact.email'        => 'Correo electrónico',

    // ====== Solicitud / Tipo ======
    'request.type.label'    => 'Tipo de solicitud',
    'request.type.visit'    => 'Visita',
    'request.type.practice' => 'Práctica',
    'requirements'          => 'Requiere',

    // ====== Requerimientos de práctica ======
    'practice.requirements.label' => '¿Qué van a necesitar?',
    'practice.requirements.help'  => 'Ej.: materiales, laboratorios, equipos, etc.',

    // ====== Datos adicionales ======
    'people.count'         => 'Cantidad de personas',
    'people.list'          => 'Listado de personas (Excel)',

    'dates.received'       => 'Fecha de recepción',
    'dates.response'       => 'Fecha de respuesta',

    'response.method'       => 'Método de respuesta',
    'response.method.call'  => 'Llamada',
    'response.method.email' => 'Correo',
    'select.placeholder'    => 'Seleccione...',

    'observations'          => 'Observaciones',

    // ====== Acciones generales (formularios) ======
    'actions.submit' => 'Enviar solicitud',

    // ====== Modal: solicitud creada / detalle ======
    'modal.created.title' => 'Solicitud registrada',
    'modal.close'         => 'Cerrar',
    'modal.company'       => 'Empresa',
    'modal.contact'       => 'Contacto',
    'modal.phone'         => 'Teléfono',
    'modal.type'          => 'Tipo',
    'modal.requirements'  => 'Requerimientos',
    'modal.state'         => 'Estado',
    'modal.created_at'    => 'Fecha de creación',
    'modal.observations'  =>'Observacion',
    'modal.request'       =>'Application',

    // ====== Listado / Índice de solicitudes ======
    'index.Applicant'   => 'Solicitante',
    'index.Actions'     => 'Acciones',

    // Estados “runtime” (se muestran como badge)
    'index.Unscheduled' => 'Sin agendar',
    'index.Scheduled'   => 'Agendada',
    'index.Today'       => 'Hoy',
    'index.In_progress' => 'En curso',
    'index.Finish'      => 'Finalizada',
    'index.Cancel'      => 'Cancelada',

    'index.empty'       => 'No hay solicitudes registradas.',

    // ====== Bloque “personas / asignación” (reprogramar, etc.) ======
    'people.types.all'        => 'Todos',
    'people.types.employee'   => 'Planta',
    'people.types.contractor' => 'Contratista',

    'people.search'    => 'Buscar persona',
    'people.search_ph' => 'Nombre o apellido...',
    'people.notify_email' => 'Correo para notificaciones',
    'people.notify_hint'  => 'Selecciona a qué correo se enviarán las notificaciones.',
    'people.no_emails'    => 'Esta persona no tiene correos registrados.',
    'people.emails_error' => 'No se pudieron cargar los correos.',

    // ====== Acciones por fila (iconos en la tabla) ======
    'actions.view_detail'    => 'Ver detalle',
    'actions.schedule'       => 'Agendar visita',
    'actions.reschedule'     => 'Reprogramar',
    'actions.cancel_visit'   => 'Cancelar visita',
    'actions.preview_excel'  => 'Ver Excel en el navegador',
    'actions.open_excel'     => 'Abrir/descargar Excel',
    'actions.no_file'        => 'Sin archivo',
    'actions.close'          => 'Cerrar',
    'actions.save'           => 'Guardar',
    'actions.confirm'        => 'Confirmar',
    'actions.change_assignee'=> 'Cambiar encargado',

    // ====== Estados / Mensajes auxiliares ======
    'states.blocked_by_cancel' => 'Solicitud cancelada',

    'badge.soon_24h' => 'Próxima ≤ 24h',

    'common.optional'     => 'opcional',
    'common.assign_later' => '(Asignar después)',

    // ====== Alertas / Notas de la UI ======
    'alert.check_data'        => 'Revisa los datos:',
    'alert.reschedule_notice' => 'Se notificará al contacto y a los encargados si reprogramas o cambias el encargado.',
    // Puedes renderizarlo con {!! trans('sigac::visits.alert.cancel_warn') !!}
    'alert.cancel_warn'       => 'Esta acción marcará la solicitud como <strong>Cancelada</strong> y notificará a las partes.',

    'schedule.in_charge' => 'Encargado',
'schedule.type.all' => 'Todos',
'schedule.type.employee' => 'Planta',
'schedule.type.contractor' => 'Contratista',
'schedule.search_placeholder' => 'Buscar por nombre o apellido...',
'schedule.search_hint' => 'Escribe al menos 2 caracteres y selecciona una persona.',
'schedule.email_label' => 'Correo para notificaciones',
'schedule.email_hint' => 'Selecciona a qué correo se enviarán las notificaciones.',
'schedule.activity' => 'Actividad a realizar',
'schedule.day' => 'Día',
'schedule.start_time' => 'Hora de inicio',
'schedule.end_time' => 'Hora de fin',
'schedule.environment_label' => 'Ambiente (opcional)',
'schedule.environment_placeholder' => 'Seleccione fecha y horas para cargar ambientes...',
'schedule.no_environment_label' => 'No asignar ambiente por ahora',
'schedule.observations' => 'Observaciones',
'schedule.button.submit' => 'Agendar',

// Mensajes JS (ambientes)
'schedule.env_assign_later_hint' => 'También puedes dejar ":assign_later".',
'schedule.env_select_prompt'     => 'Seleccione fecha y horas para consultar.',
'schedule.env_loading'           => 'Cargando ambientes disponibles...',
'schedule.env_range_invalid'     => 'La hora de inicio debe ser menor a la hora de fin.',
'schedule.env_none_available'    => 'No hay ambientes disponibles para el rango seleccionado.',
'schedule.env_loaded_ok'         => 'Ambientes libres para la fecha y rango. También puedes dejar ":assign_later".',
'schedule.env_loaded_empty'      => 'No hay ambientes libres. Puedes dejar ":assign_later".',

// Reutilizadas
'modal.request' => 'Solicitud',
'people.types.employee' => 'Planta',
'people.types.contractor' => 'Contratista',
'people.no_emails'    => 'Esta persona no tiene correos registrados.',
'people.emails_error' => 'No se pudieron cargar los correos.',
'common.assign_later' => '(Asignar después)',
'title.schedule'      => 'Agendar visita',

];
