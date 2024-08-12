@extends('sigac::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/sigac/css/customStyles.css') }}">
    <style>
        .event-no-environment {
            background-color: #ff5733 !important; /* Color de fondo para eventos sin ambiente */
            color: #FFFFFF !important; /* Color del texto si es necesario */
            border: 1px solid #FF5733 !important; /* Borde opcional */
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
                <div id="learning_outcome"></div>
                
                <!-- Agrega más detalles del evento según sea necesario -->
                <br>
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                          Cambiar Programación
                        </button>
                      </h2>
                      <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <br>
                        {!! Form::open(['route' => 'sigac.academic_coordination.programming.management.novelty.store', 'method' => 'POST']) !!}
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
                left: 'prev,next today myCustomButton',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            },
            customButtons: {
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
                                    
                                    if(codeCourse){
                                        $.ajax({
                                            type: 'GET',
                                            url: url,
                                            data: { code_course: codeCourse },
                                            success: function(response) {
                                                // Manejar la respuesta aquí
                                                if (response && response.program && response.program.length > 0) {
                                                    $('#program_name').html('<strong>Programa:</strong> ' + response.program).show();
                                                }else{
                                                    $('#program_name').hide();
                                                }
                                                // Puedes hacer algo con los datos recibidos
                                            },
                                            error: function(xhr) {
                                                
                                            }
                                        });
                                    }else{
                                        $('#program_name').hide();
                                    }
                                });
                            });
                        } else {
                            alert('Por favor selecciona una opción primero.');
                        }
                    }
                }
            }, 
            height: 'auto',
            aspectRatio: 1.0,
            editable: false,
            droppable: true,
            events: events,

            eventDidMount: function(info) {
                var eventData = info.event.extendedProps;
                console.log(eventData);

                // Verifica si `environment_instructor_programs` existe y es un array
                if (eventData && Array.isArray(eventData.environment_instructor_programs) && eventData.environment_instructor_programs.length === 0) {
                    info.el.classList.add('event-no-environment');
                }
            },


            eventClick: function(info) {
                var eventData = info.event.extendedProps;
                var option = $('#option').val();

                if (option == 1) {
                    // Mostrar información de los ambientes
                        var environmentsHtml = 'Ambientes: <br>';
                        eventData.environment_instructor_programs.forEach(function(eip) {
                            environmentsHtml += '- ' + eip.environment.name + '<br>' ;
                        });
                        $('#environments').html(environmentsHtml);
                        var learning_outcomesHtml = 'Resultados : <br>';
                        eventData.instructor_program_outcomes.forEach(function(le) {
                            learning_outcomesHtml += '- ' + le.learning_outcome.name + '<br>' ;
                        });
                        $('#learning_outcome').html(learning_outcomesHtml);
                        $('#date').text('Fecha: ' + (info.event.start ? info.event.start.toLocaleDateString() : 'N/A'));
                        $('#instructor_program_id').val(eventData.instructor_program.id);
                        $('#course').text('Curso: ' + (eventData.course && eventData.course.program ? (eventData.course.program.name + ' - ' + eventData.course.code) : 'N/A'));
                        $('#modality').text('Modalidad: ' + (eventData.course && eventData.course.program.modality ? (eventData.course.program.modality) : 'N/A'));
                        $('#municipality').text('Municipio: ' + (eventData.course && eventData.course ? (eventData.course.municipality.name + ' - ' + eventData.course.municipality.department.name) : 'N/A'));
                        $('#start_time').text('Hora de inicio: ' + (info.event.start ? info.event.start.toLocaleTimeString() : 'N/A'));
                        $('#end_time').text('Hora fin: ' + (info.event.end ? info.event.end.toLocaleTimeString() : 'N/A'));

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
                        $('#end_time').text('Hora fin: ' + (info.event.end ? info.event.end.toLocaleTimeString() : 'N/A'));
                        var learning_outcomesHtml = 'Resultados : <br>';
                        eventData.instructor_program_outcomes.forEach(function(le) {
                            learning_outcomesHtml += '- ' + le.learning_outcome.name + '<br>' ;
                        });
                        $('#learning_outcome').html(learning_outcomesHtml);
                } else if (option == 3) {
                        var environmentsHtml = 'Ambientes: <br>';
                        eventData.environment_instructor_programs.forEach(function(eip) {
                            environmentsHtml += '- ' + eip.environment.name + '<br>' ;
                        });
                        $('#environments').html(environmentsHtml);
                        $('#date').text('Fecha: ' + (info.event.start ? info.event.start.toLocaleDateString() : 'N/A'));
                        $('#instructor_program_id').val(eventData.instructor_program.id);
                        $('#modality').text('Modalidad: ' + (eventData.course && eventData.course.program.modality ? (eventData.course.program.modality) : 'N/A'));
                        $('#municipality').text('Municipio: ' + (eventData.course && eventData.course ? (eventData.course.municipality.name) : 'N/A'));
                        var instructorsHtml = 'Instructores : <br>';
                        eventData.instructor_program_people.forEach(function(pe) {
                            instructorsHtml += '- ' + pe.person.first_name + ' ' + pe.person.first_last_name + ' ' + pe.person.second_last_name +'<br>' ;
                        });
                        $('#instructor').html(instructorsHtml);
                        $('#start_time').text('Hora de inicio: ' + (info.event.start ? info.event.start.toLocaleTimeString() : 'N/A'));
                        $('#end_time').text('Hora fin: ' + (info.event.end ? info.event.end.toLocaleTimeString() : 'N/A'));
                        var learning_outcomesHtml = 'Resultados : <br>';
                        eventData.instructor_program_outcomes.forEach(function(le) {
                            learning_outcomesHtml += '- ' + le.learning_outcome.name + '<br>' ;
                        });
                        $('#learning_outcome').html(learning_outcomesHtml);
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

                $('#eventDetailsModal').modal('show');
            }

        });

        // Inicializa el calendario
        calendar.render();

        /* // Cargar todas las programaciones al cargar la página
        $.ajax({
            type: 'GET',
            url: "{{ route('sigac.academic_coordination.programming.get') }}",
            success: function(response) {
                response.programmingEvents.forEach(function(eventData) {
                    // Concatenar las iniciales al principio del título del evento
                    var titleWithInitials = eventData.person.initials + ' - ' + eventData.course.code;

                    calendar.addEvent({
                        title: titleWithInitials, // Usar el título con las iniciales
                        start: eventData.date + 'T' + eventData.start_time,
                        end: eventData.date + 'T' + eventData.end_time,
                        person: eventData.person,
                        course: eventData.course,
                        environment: eventData.environment
                    });
                });

                calendar.refetchEvents();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        }); */

        $('#search').change(function() {
            var option = $('#option').val();

            $.ajax({
                type: 'POST',
                url: "{{ route('sigac.programming.management.search') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    search: $(this).val(),
                    option: option
                },
                success: function(response) {
                    calendar.removeAllEvents();
                    response.programmingEvents.forEach(function(eventData) {
                        var environmentName = Array.isArray(eventData.environment_instructor_programs) && eventData.environment_instructor_programs.length > 0
                            ? eventData.environment_instructor_programs[0].environment.name
                            : 'Complementaria';
                        var titleWithInitials = option == 1
                            ? eventData.course.code + ' - ' + environmentName
                            : option == 2
                            ? eventData.instructor_program_people[0].person.initials + ' - ' + eventData.course.code
                            : option == 3
                            ? eventData.instructor_program_people[0].person.initials + ' - ' + environmentName
                            : eventData.instructor_program_people[0].person.initials + ' - ' + eventData.course.code;
                        
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
            $.ajax({
                type: 'POST',
                url: "{{ route('sigac.programming.management.filter') }}",
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
