@extends('sigac::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/sigac/css/customStyles.css') }}">
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
                <div id="environment"></div>
                <div id="instructor"></div>
                <div id="course"></div>
                <div id="date"></div>
                <div id="start_time"></div>
                <div id="end_time"></div>
                <!-- Agrega más detalles del evento según sea necesario -->
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
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

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

            eventClick: function(info) {
                var eventData = info.event.extendedProps;
                var option = $('#option').val();
                console.log(option)

                if (option == 1) {
                    $('#environment').text('Ambiente: ' + (eventData.environment ? eventData.environment.name : 'N/A'));
                        $('#date').text('Fecha: ' + (info.event.start ? info.event.start.toLocaleDateString() : 'N/A'));
                        $('#course').text('Curso: ' + (eventData.course && eventData.course.program ? (eventData.course.program.name + ' - ' + eventData.course.code) : 'N/A'));
                        $('#start_time').text('Hora de inicio: ' + (info.event.start ? info.event.start.toLocaleTimeString() : 'N/A'));
                        $('#end_time').text('Hora fin: ' + (info.event.end ? info.event.end.toLocaleTimeString() : 'N/A'));
                } else if (option == 2) {
                    console.log('paso');
                    $('#date').text('Fecha: ' + (info.event.start ? info.event.start.toLocaleDateString() : 'N/A'));
                        $('#instructor').text('Instructor: ' + (eventData.person ? eventData.person.first_name : 'N/A'));
                        $('#course').text('Curso: ' + (eventData.course && eventData.course.program ? (eventData.course.program.name + ' - ' + eventData.course.code) : 'N/A'));
                        $('#start_time').text('Hora de inicio: ' + (info.event.start ? info.event.start.toLocaleTimeString() : 'N/A'));
                        $('#end_time').text('Hora fin: ' + (info.event.end ? info.event.end.toLocaleTimeString() : 'N/A'));
                } else if (option == 3) {
                    $('#environment').text('Ambiente: ' + (eventData.environment ? eventData.environment.name : 'N/A'));
                        $('#date').text('Fecha: ' + (info.event.start ? info.event.start.toLocaleDateString() : 'N/A'));
                        $('#instructor').text('Instructor: ' + (eventData.person ? eventData.person.first_name : 'N/A'));
                        $('#start_time').text('Hora de inicio: ' + (info.event.start ? info.event.start.toLocaleTimeString() : 'N/A'));
                        $('#end_time').text('Hora fin: ' + (info.event.end ? info.event.end.toLocaleTimeString() : 'N/A'));
                } else {
                    $('#environment').text('Ambiente: ' + (eventData.environment ? eventData.environment.name : 'N/A'));
                        $('#date').text('Fecha: ' + (info.event.start ? info.event.start.toLocaleDateString() : 'N/A'));
                        $('#instructor').text('Instructor: ' + (eventData.person ? eventData.person.first_name : 'N/A'));
                        $('#course').text('Curso: ' + (eventData.course && eventData.course.program ? (eventData.course.program.name + ' - ' + eventData.course.code) : 'N/A'));
                        $('#start_time').text('Hora de inicio: ' + (info.event.start ? info.event.start.toLocaleTimeString() : 'N/A'));
                        $('#end_time').text('Hora fin: ' + (info.event.end ? info.event.end.toLocaleTimeString() : 'N/A'));
                }

                $('#eventDetailsModal').modal('show');
            }

        });

        // Inicializa el calendario
        calendar.render();

        // Cargar todas las programaciones al cargar la página
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
        });

        $('#search').change(function() {
            var option = $('#option').val();

            $.ajax({
                type: 'POST',
                url: "{{ route('sigac.academic_coordination.programming.management.search') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    search: $(this).val(),
                    option: option
                },
                success: function(response) {
                    calendar.removeAllEvents();
                    response.programmingEvents.forEach(function(eventData) {
                        // Concatenar las iniciales al principio del título del evento
                        if (option == 1) {
                            var titleWithInitials = eventData.course.code + ' - ' + eventData.environment.name;
                        } else if (option == 2) {
                            var titleWithInitials = eventData.person.initials + ' - ' + eventData.course.code;
                        } else if (option == 3) {
                            var titleWithInitials = eventData.person.initials + ' - ' + eventData.environment.name;
                        } else {
                            var titleWithInitials = eventData.person.initials + ' - ' + eventData.course.code;
                        }
                        

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
                url: "{{ route('sigac.academic_coordination.programming.management.filter') }}",
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
