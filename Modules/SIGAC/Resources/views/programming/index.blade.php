@extends('sigac::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/sigac/css/customStyles.css') }}">
    <style>
        .complementaria {
            background-color: #ff5733 !important; /* Color de fondo para eventos sin ambiente */
            color: #FFFFFF !important; /* Color del texto si es necesario */
            border: 1px solid #FF5733 !important; /* Borde opcional */
        }

        .medios_tecnologicos {
            background-color: #ebd40af3 !important; /* Color de fondo para eventos sin ambiente */
            color: #FFFFFF !important; /* Color del texto si es necesario */
            border: 1px solid #ebd40af3 !important; /* Borde opcional */
        }

        .event-novelty {
            background-color: #00e1ff !important; /* Color de fondo para eventos sin ambiente */
            color: #FFFFFF !important; /* Color del texto si es necesario */
            border: 1px solid #00e1ff !important; /* Borde opcional */
        }

        .bienestar{
            background-color: #2bff00 !important; /* Color de fondo para eventos sin ambiente */
            color: #FFFFFF !important; /* Color del texto si es necesario */
            border: 1px solid #2bff00 !important; /* Borde opcional */
 
        }
    </style>
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('sigac::programming.Breadcrumb_Active_Programming') }}</li>
@endpush

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h4>Filtrar Por :</h4>
                <select name="filter" id="filter" class="form-select form-select-sm" aria-label="Small select example">
                    <option selected>Seleccionar Filtro</option>
                    <option value="1">Instructor</option>
                    <option value="2">Ambiente</option>
                    <option value="3">Curso</option>
                </select>
            </div>
            <div class="col-md-6">
                <h4 id="titulo">Seleccionar</h4>
                {!! Form::select('search', [], old('search'), [
                    'class' => 'form-control',
                    'required',
                    'id' => 'search',
                ]) !!}
                {!! Form::hidden('option', null, ['id' => 'option']) !!}
            </div>
        </div>
    </div>
</div>
    
<!-- Modal -->
<div class="modal fade" id="eventDetailsModal" tabindex="-1" role="dialog" aria-labelledby="eventDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventDetailsModalLabel">Detalles de la Programación</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="environments"></div>
                <div id="instructor"></div>
                <div id="course"></div>
                <div id="modality"></div>
                <div id="date"></div>
                <div id="start_time"></div>
                <div id="end_time"></div>
                <div id="municipality"></div>
                <div id="quartelie"></div>
                <div id="learning_outcome"></div>
                <!-- Agrega más detalles del evento según sea necesario -->
                <br>
                @if(auth()->check() && checkRol('sigac.academic_coordinator'))
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Cambiar Programación
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <br>
                            {!! Form::open(['route' => 'sigac.'. $role .'.programming.management.novelty.store', 'method' => 'POST']) !!}
                            @csrf
                            {!! Form::hidden('instructor_program_id', null, ['id' => 'instructor_program_id']) !!}
                            <div class="form-group">
                                {!! Form::label('activity', trans('Tipo de actividad')) !!}
                                {!! Form::select('activity', ['Formación' => 'Formación',
                                    'Atención medios tecnológicos' => 'Atención medios tecnológicos',
                                    'Investigación' => 'Investigación',
                                    'Investigación' => 'Investigación',
                                    'Permiso' => 'Permiso',
                                    'Compromiso Institucional' => 'Compromiso Institucional'], null, [
                                    'id' => 'priority',
                                    'class' => 'form-control',
                                    'placeholder' => trans('Seleccione el tipo de actividad'),
                                    'required',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('observation', trans('agrocefa::labor.Observation')) !!}
                                {!! Form::textarea('observation', old('observation'), [
                                    'class' => 'form-control',
                                    'placeholder' => 'Ingrese el motivo',
                                    'style' => 'max-height: 100px;',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('checkbox_label', trans('Desea cancelar la programación')) !!}
                                <div>
                                    {!! Form::radio('option', 'yes', false, ['id' => 'option_yes']) !!}
                                    {!! Form::label('option_yes', 'Sí') !!}
                                </div>
                                <div>
                                    {!! Form::radio('option', 'no', true, ['id' => 'option_no']) !!}
                                    {!! Form::label('option_no', 'No') !!}
                                </div>
                            </div>
                            {!! Form::submit('Enviar Novedad', ['class'=>'btn btn-primary']) !!}
                            {!! Form::close() !!}
                        </div>
                        </div>
                    </div>
                    @endif
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="eventProgramDetailsModal" tabindex="-1" role="dialog" aria-labelledby="eventProgramDetailsModalModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventProgramDetailsModalModalLabela"></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="date_eventely"></div>
                <div id="observation_eventely"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="externalActivityDetailsModal" tabindex="-1" role="dialog" aria-labelledby="externalActivityDetailsModalModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ExternalActivityDetailsModalModalLabela"></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="responsible"></div>
                <div id="date_external_activity"></div>
                <div id="description_external_activity"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
</div>

@include('sigac::programming.delete')

@endsection

@php
    $rol = '';
    $user = Auth::user();
    if(auth()->check()){
        $rol  = checkRol('sigac.academic_coordinator');
    }
@endphp

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var holidays = {!! $holidays !!};

        
        var events = holidays.map(function(holiday) {

            return {
                title: holiday.issue,
                start: holiday.date,
                display: 'background',
                backgroundColor: '#ff0000', // Color de fondo para los días festivos
                borderColor: '#ff0000'
            };
        });

        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            },
            height: 'auto',
            aspectRatio: 1.0,
            editable: false,
            droppable: true,
            events: events,

            eventDidMount: function(info) {
                var eventData = info.event.extendedProps;

                // Verifica si `environment_instructor_programs` existe y es un array
                if (eventData.instructor_program && eventData.instructor_program.modality == 'Complementaria') {
                    info.el.classList.add('complementaria');
                }else if(eventData.instructor_program && eventData.instructor_program.modality == 'Medios Tecnologicos'){
                    info.el.classList.add('medios_tecnologicos');
                }
                
                if(eventData.hasExternalActivity){
                    info.el.classList.add('bienestar');
                }

                // Verifica si hay una novedad basada en la propiedad personalizada
                if (eventData.hasNovelty) {
                    info.el.classList.add('event-novelty');
                }
            },


            eventClick: function(info) {
                var eventData = info.event.extendedProps;

                // Verifica si el evento es un día festivo (evento de fondo)
                if (info.event.display === 'background') {
                    return; // No hacer nada si es un evento de fondo
                }
                
                var option = $('#option').val();

                if (option == 1) {
                    // Mostrar información de los ambientes
                    if(eventData.instructor_program.modality == 'Presencial'){
                        var environmentsHtml = 'Ambientes: <br>';
                        if (Array.isArray(eventData.environment_instructor_programs)) {
                            eventData.environment_instructor_programs.forEach(function(eip) {
                                environmentsHtml += '- ' + (eip.environment && eip.environment.name ? eip.environment.name : 'N/A') + '<br>';
                            });
                        } else {
                            environmentsHtml += '- N/A<br>';
                        }
                    }
                        $('#environments').html(environmentsHtml);
                        var learning_outcomesHtml = 'Resultados : <br>';
                        if (Array.isArray(eventData.instructor_program_outcomes)) {
                            eventData.instructor_program_outcomes.forEach(function(le) {
                                learning_outcomesHtml += '- ' + (le.learning_outcome && le.learning_outcome.name ? le.learning_outcome.name : 'N/A') + '<br>';
                            });
                        } else {
                            learning_outcomesHtml += '- N/A<br>';
                        }
                        $('#learning_outcome').html(learning_outcomesHtml);
                        $('#date').text('Fecha: ' + (info.event.start ? info.event.start.toLocaleDateString() : 'N/A'));
                        if (eventData.instructor_program && eventData.instructor_program.id) {
                            $('#instructor_program_id').val(eventData.instructor_program.id);
                        } else {
                            $('#instructor_program_id').val(''); // O un valor por defecto si no hay instructor_program
                        }
                        $('#course').text('Curso: ' + (eventData.course && eventData.course.program ? (eventData.course.program.name + ' - ' + eventData.course.code) : 'N/A'));
                        $('#modality').text('Modalidad: ' + (eventData.course && eventData.course.program.modality ? (eventData.course.program.modality) : 'N/A'));
                        $('#municipality').text('Municipio: ' + (eventData.course && eventData.course ? (eventData.course.municipality.name + ' - ' + eventData.course.municipality.department.name) : 'N/A'));
                        $('#start_time').text('Hora de inicio: ' + (info.event.start ? info.event.start.toLocaleTimeString() : 'N/A'));
                        $('#end_time').text('Hora fin: ' + (info.event.end ? info.event.end.toLocaleTimeString() : 'N/A'));
                        if(eventData.instructor_program.modality == 'Presencial' || eventData.instructor_program.modality == 'Medios Tecnologicos'){
                            $('#quartelie').text('Trimestre: ' + eventData.instructor_program.quarter_number);
                        }
                } else if (option == 2) {      
                        $('#date').text('Fecha: ' + (info.event.start ? info.event.start.toLocaleDateString() : 'N/A'));
                        $('#instructor_program_id').val(eventData.instructor_program.id);
                        var instructorsHtml = 'Instructores : <br>';
                        eventData.instructor_program_people.forEach(function(pe) {
                            instructorsHtml += '- ' + pe.person.first_name + ' ' + pe.person.first_last_name + ' ' + pe.person.second_last_name +'<br>' ;
                        });
                        $('#instructor').html(instructorsHtml);
                        $('#course').text('Curso: ' + (eventData.course && eventData.course.program ? (eventData.course.program.name + ' - ' + eventData.course.code) : 'N/A'));
                        $('#modality').text('Modalidad: ' + (eventData.course && eventData.course.program.modality ? (eventData.course.program.modality) : 'N/A'));
                        $('#municipality').text('Municipio: ' + (eventData.course && eventData.course ? (eventData.course.municipality.name) : 'N/A'));
                        $('#start_time').text('Hora de inicio: ' + (info.event.start ? info.event.start.toLocaleTimeString() : 'N/A'));
                        $('#quartelie').text('Trimestre: ' + eventData.instructor_program.quarter_number);
                        $('#end_time').text('Hora fin: ' + (info.event.end ? info.event.end.toLocaleTimeString() : 'N/A'));
                        var learning_outcomesHtml = 'Resultados : <br>';
                        eventData.instructor_program_outcomes.forEach(function(le) {
                            learning_outcomesHtml += '- ' + le.learning_outcome.name + '<br>' ;
                        });
                        $('#learning_outcome').html(learning_outcomesHtml);
                } else if (option == 3) {
                    if(eventData.instructor_program.modality == 'Presencial'){
                        var environmentsHtml = 'Ambientes: <br>';
                        if (Array.isArray(eventData.environment_instructor_programs)) {
                            eventData.environment_instructor_programs.forEach(function(eip) {
                                environmentsHtml += '- ' + (eip.environment && eip.environment.name ? eip.environment.name : 'N/A') + '<br>';
                            });
                        } else {
                            environmentsHtml += '- N/A<br>';
                        }
                    }
                        $('#environments').html(environmentsHtml);
                        $('#date').text('Fecha: ' + (info.event.start ? info.event.start.toLocaleDateString() : 'N/A'));
                        if(eventData.instructor_program && eventData.instructor_program.id){
                            $('#instructor_program_id').val(eventData.instructor_program.id);
                        }else{
                            $('#instructor_program_id').val('');
                        }
                        $('#modality').text('Modalidad: ' + (eventData.course && eventData.course.program.modality ? (eventData.course.program.modality) : 'N/A'));
                        if(eventData.instructor_program.modality == 'Presencial' || eventData.instructor_program.modality == 'Medios Tecnologicos'){
                            $('#quartelie').text('Trimestre: ' + eventData.instructor_program.quarter_number);
                        }
                        $('#municipality').text('Municipio: ' + (eventData.course && eventData.course ? (eventData.course.municipality.name) : 'N/A'));
                        if (Array.isArray(eventData.instructor_program_people) && eventData.instructor_program_people.length > 0){
                            var instructorsHtml = 'Instructores : <br>';
                            eventData.instructor_program_people.forEach(function(pe) {
                                instructorsHtml += '- ' + pe.person.first_name + ' ' + pe.person.first_last_name + ' ' + pe.person.second_last_name +'<br>' ;
                            });
                            $('#instructor').html(instructorsHtml);
                        }
                        $('#start_time').text('Hora de inicio: ' + (info.event.start ? info.event.start.toLocaleTimeString() : 'N/A'));
                        $('#end_time').text('Hora fin: ' + (info.event.end ? info.event.end.toLocaleTimeString() : 'N/A'));
                        if (Array.isArray(eventData.instructor_program_outcomes) && eventData.instructor_program_outcomes.length > 0){
                            var learning_outcomesHtml = 'Resultados : <br>';
                            eventData.instructor_program_outcomes.forEach(function(le) {
                                learning_outcomesHtml += '- ' + le.learning_outcome.name + '<br>' ;
                            });
                            $('#learning_outcome').html(learning_outcomesHtml);
                        }
                } else {
                        var environmentsHtml = 'Ambientes: <br>';
                        eventData.environment_instructor_programs.forEach(function(eip) {
                            environmentsHtml += '- ' + eip.environment.name + '<br>' ;
                        });
                        $('#environments').html(environmentsHtml);
                        $('#date').text('Fecha: ' + (info.event.start ? info.event.start.toLocaleDateString() : 'N/A'));
                        $('#instructor_program_id').val(eventData.instructor_program.id);
                        var instructorsHtml = 'Instructores : <br>';
                        eventData.instructor_program_people.forEach(function(pe) {
                            instructorsHtml += '- ' + pe.person.first_name + ' ' + pe.person.first_last_name + ' ' + pe.person.second_last_name +'<br>' ;
                        });
                        $('#instructor').html(instructorsHtml);
                        $('#course').text('Curso: ' + (eventData.course && eventData.course.program ? (eventData.course.program.name + ' - ' + eventData.course.code) : 'N/A'));
                        $('#start_time').text('Hora de inicio: ' + (info.event.start ? info.event.start.toLocaleTimeString() : 'N/A'));
                        $('#end_time').text('Hora fin: ' + (info.event.end ? info.event.end.toLocaleTimeString() : 'N/A'));
                        var learning_outcomesHtml = 'Resultados : <br>';
                        eventData.instructor_program_outcomes.forEach(function(le) {
                            learning_outcomesHtml += '- ' + le.learning_outcome.name + '<br>' ;
                        });
                        $('#learning_outcome').html(learning_outcomesHtml);
                }
                
                if (eventData.hasNovelty) {
                    if (Array.isArray(eventData.instructor_program_novelties) && eventData.instructor_program_novelties.length > 0) {
                        $('#eventProgramDetailsModalModalLabela').text((eventData.instructor_program_novelties[0].activity));
                        $('#date_eventely').text('Fecha: ' + (eventData.instructor_program_novelties[0].date));
                        $('#observation_eventely').text('Observación: ' + (eventData.instructor_program_novelties[0].observation));
                        // Muestra el modal con los detalles de la novedad
                        $('#eventProgramDetailsModal').modal('show');
                    }
                }

                if(eventData.hasExternalActivity){
                    $('#ExternalActivityDetailsModalModalLabela').text('Actividad externa');
                    var responsible = 'Responsable: ';
                    eventData.instructor_program.instructor_program_people.forEach(function(pe) {
                        responsible += pe.person.first_name + ' ' + pe.person.first_last_name + ' ' + pe.person.second_last_name;
                    });
                    $('#responsible').html(responsible);
                    $('#date_external_activity').text('Fecha: ' + info.event.start.toLocaleDateString());
                    $('#description_external_activity').text('Descripción: ' + (eventData.instructor_program.activity_description));

                    $('#externalActivityDetailsModal').modal('show');
                }else {
                    // Si no hay novedad, mostrar el modal normal
                    $('#eventDetailsModal').modal('show'); 
                }

                $('#eventDetailsModal').on('hidden.bs.modal', function () {
                    // Limpiar el contenido del modal
                    $('#environments').html('');
                    $('#instructor').html('');
                    $('#course').text('');
                    $('#modality').text('');
                    $('#date').text('');
                    $('#start_time').text('');
                    $('#end_time').text('');
                    $('#municipality').text('');
                    $('#quartelie').text('');
                    $('#learning_outcome').html('');
                                    
                    // Restablecer los valores del formulario
                    $('#instructor_program_id').val('');
                    $('#priority').val('');
                    $('textarea[name="observation"]').val('');
                    $('input[name="option"]').prop('checked', false);  // Restablecer los radios
                });

            }
        });

        // Inicializa el calendario
        calendar.render();

        $('#search').change(function() {
            var option = $('#option').val();
            var userHasRole = <?= json_encode($rol); ?>;

            if (option == 1 && userHasRole) {
                calendar.setOption('customButtons', {
                    myCustomButton: {
                        text: 'Borrar programación',
                        click: function() {
                            var personId = $('#search').val(); // Obtener el ID seleccionado
                            if (personId) {
                                $('#deleteModal').attr('id', 'delete' + personId);
                                $('#person_id').val(personId);
                                $('#delete' + personId).modal('show'); // Abrir el modal con la ID concatenada

                                $('#delete' + personId).on('shown.bs.modal', function() {
                                    $('#code_course').on('input', function() {
                                        var codeCourse = $('#code_course').val();
                                        var url = {!! json_encode(route('sigac.academic_coordination.programming.management.search_course')) !!};
                                        
                                        if (codeCourse) {
                                            $.ajax({
                                                type: 'GET',
                                                url: url,
                                                data: { code_course: codeCourse },
                                                success: function(response) {
                                                    // Manejar la respuesta aquí
                                                    if (response && response.program && response.program.length > 0) {
                                                        $('#program_name').html('<strong>Programa:</strong> ' + response.program).show();
                                                    } else {
                                                        $('#program_name').hide();
                                                    }
                                                },
                                                error: function(xhr) {
                                                    // Manejar el error aquí si es necesario
                                                }
                                            });
                                        } else {
                                            $('#program_name').hide();
                                        }
                                    });
                                });
                            } else {
                                alert('Por favor selecciona una opción primero.');
                            }
                        }
                    }
                });

                calendar.setOption('headerToolbar', {
                    left: 'prev,next today myCustomButton',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                });
            }else{
                calendar.setOption('headerToolbar', {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                });
            }

            var authUser = <?= json_encode($user); ?>;

            @if(auth()->check())
                var url = "{{ route('sigac.'. getRoleRouteName(Route::currentRouteName()) .'.programming.management.search') }}";
            @else  
                var url = "{{ route('cefa.sigac.programming.management.search') }}";
            @endif

            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    _token: "{{ csrf_token() }}",
                    search: $(this).val(),
                    option: option
                },
                success: function(response) {
                    calendar.removeAllEvents();
                    response.programmingEvents.forEach(function(eventData) {
                        var modality = eventData.modality;
                        var environmentName;
                        switch(modality){
                            case 'Complementaria':
                                environmentName = 'Complementaria';
                                break;
                            case 'Medios Tecnologicos':
                                environmentName = 'Medios Tecnologicos'; 
                                break;
                            case null: // Si la modalidad es nula
                            case undefined: // Si no existe la modalidad
                                environmentName = eventData.activity_name;
                                break;
                            default:
                            environmentName = eventData.environment_instructor_programs[0].environment.name;
                        }
                        
                        var titleWithInitials;
                        switch(option) {
                            case 1:
                                titleWithInitials = eventData.course.code + ' - ' + environmentName;
                                break;
                            case 2:
                                titleWithInitials = eventData.instructor_program_people[0].person.initials + ' - ' + eventData.course.code;
                                break;
                            case 3:
                                titleWithInitials = eventData.instructor_program_people[0].person.initials + ' - ' + environmentName;                               
                                break;
                            default:
                                if (eventData.instructor_program_people.length > 0) {
                                    titleWithInitials = eventData.instructor_program_people[0].person.initials + ' - ' + eventData.course.code;
                                }  else {
                                    titleWithInitials = eventData.activity_name; // Si no hay persona, solo muestra el nombre de la actividad
                                }
                        }
                                                
                        if (Array.isArray(eventData.instructor_program_novelties) && eventData.instructor_program_novelties.length > 0) {
                            calendar.addEvent({
                                title: eventData.instructor_program_novelties[0].activity,
                                start: eventData.instructor_program_novelties[0].date,
                                extendedProps: {
                                    timeRange : 'Novedad',
                                    hasNovelty: true, // Propiedad personalizada para indicar la existencia de una novedad
                                    instructor_program_novelties: eventData.instructor_program_novelties
                                }
                            });
                        } 

                        if(eventData.activity_name){
                            calendar.addEvent({
                                title: eventData.activity_name,
                                start: eventData.date,
                                extendedProps: {
                                    timeRange : `(${formatTime(eventData.start_time)} - ${formatTime(eventData.end_time)})`,
                                    hasExternalActivity: true, // Propiedad personalizada para indicar la existencia de una novedad
                                    instructor_program: eventData
                                }
                            });
                        }else {
                            calendar.addEvent({
                                title: titleWithInitials,
                                start: eventData.date + 'T' + eventData.start_time,
                                end: eventData.date + 'T' + eventData.end_time,
                                extendedProps: {
                                    timeRange: `(${formatTime(eventData.start_time)} - ${formatTime(eventData.end_time)})`,
                                    instructor_program: eventData,
                                    instructor_program_people: eventData.instructor_program_people,
                                    course: eventData.course,
                                    environment_instructor_programs: eventData.environment_instructor_programs || [],
                                    instructor_program_outcomes: eventData.instructor_program_outcomes
                                }
                            });
                        }

                        calendar.setOption('eventContent', function(arg) {
                            return { 
                                html: `<div><b><center>${arg.event.extendedProps.timeRange}<br>${arg.event.title}</center></b></div>`
                            }
                        });

                        function formatTime(timeString) {
                            const [hours, minutes] = timeString.split(':');
                            const formattedTime = `${hours}:${minutes}`;
                            return formattedTime;
                        }

                    });

                    // Agregar días festivos como eventos de fondo
                    holidays.forEach(function(holiday) {
                        calendar.addEvent({
                            title: holiday.issue,
                            start: holiday.date,
                            extendedProps: { 
                                timeRange: '',
                            },
                            display: 'background',
                            backgroundColor: '#ff0000', // Color de fondo para los días festivos
                            borderColor: '#ff0000'
                        });
                    });

                    calendar.refetchEvents();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        $('#filter').change(function() {
            var filter = $(this).val();
            var titulo = '';

            // Limpiar contenido del modal
            $('#environment').empty();
            $('#instructor').empty();
            $('#course').empty();
            $('#date').empty();
            $('#start_time').empty();
            $('#end_time').empty();

            // Determinar el título según la opción seleccionada
            switch(filter) {
                case '1':
                    titulo = 'Seleccionar Instructor';
                    break;
                case '2':
                    titulo = 'Seleccionar Ambiente';
                    break;
                case '3':
                    titulo = 'Seleccionar Curso';
                    break;
                default:
                    titulo = 'Seleccionar';
            }

            // Actualizar el título del <h4>
            $('#titulo').text(titulo);
            @if(auth()->check())
                var url = "{{ route('sigac.'. getRoleRouteName(Route::currentRouteName()) .'.programming.management.filter') }}";
            @else  
                var url = "{{ route('cefa.sigac.programming.management.filter') }}";
            @endif
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    _token: "{{ csrf_token() }}",
                    filter: filter
                },
                success: function(data) {   
                    var option = $('#option');
                    var search = $('#search');
                    search.empty();
                    search.append(new Option('Seleccionar', ''));

                    option.val(data.option);

                    $.each(data.results, function(index, result) {
                        search.append(new Option(result.name, result.id));
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        $('#search').select2();
    });
</script>
@endpush
