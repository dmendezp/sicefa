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
        <h4>Filtrar Por :</h4>
        <select name="filter" id="filter" class="form-select form-select-sm" aria-label="Small select example">
            <option selected>Seleccionar Filtro</option>
            <option value="1">Instructor</option>
            <option value="2">Ambiente</option>
            <option value="3">Curso</option>
        </select>
        <br>
        <h4>{{ trans('sigac::programming.Select_Environment') }}</h4>
        {!! Form::select('search', [], old('search'), [
            'class' => 'form-control',
            'required',
            'id' => 'search',
        ]) !!}
        {!! Form::hidden('option', null, ['id' => 'option']) !!}
        <br>
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
            var externalEventsEl = document.getElementById('external-events');

            // Define la función getTimePeriod en JavaScript
            function getTimePeriod(startTime) {
                // Lógica para determinar si es día o tarde
                // Aquí debes implementar tu lógica para determinar si startTime es de día o tarde
                // Por ejemplo, si la hora de inicio es antes de las 12 p.m., es de día; de lo contrario, es tarde.
                var hour = parseInt(startTime.split(':')[0]);
                return hour < 12 ? 'Día' : 'Tarde';
            }

            // Inicializa el calendario
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listWeek'
                },
                height: 'auto',
                aspectRatio: 1.0,
                editable: true, // Habilita la edición (arrastrar y soltar) de eventos
                droppable: true, // Habilita la opción de arrastrar y soltar en el calendario

                // Evento para cuando un evento externo se arrastra y se suelta en el calendario
                eventReceive: function(info) {
                    // Aquí puedes realizar acciones cuando un evento externo se coloca en el calendario
                    // Por ejemplo, guardar el evento en tu base de datos
                },

                // Eventos programados
                events: [
                    @foreach($programmingEvents as $event)
                        {
                            title: '{{$event->environment->name}}',
                            start: '{{ \Carbon\Carbon::parse($event->date . ' ' . $event->start_time)->toIso8601String() }}',
                            end: '{{ \Carbon\Carbon::parse($event->date . ' ' . $event->end_time)->toIso8601String() }}',
                            instructor: '{{ $event->person ? $event->person->first_name : '' }}',
                            program: '{{ $event->course->program->name ?? '' }}',
                            course: '{{ $event->course->code ?? '' }}',
                            time_period: getTimePeriod('{{$event->start_time}}')
                        },
                    @endforeach
                ],

                // Evento al hacer clic en un evento del calendario
                eventClick: function(info) {
                    $('#environment').text('Ambiente: ' + info.event.title);
                    $('#date').text('Fecha: ' + info.event.start.toLocaleDateString());
                    $('#instructor').text('Instructor: ' + info.event.extendedProps.instructor);
                    $('#course').text('Curso: ' + info.event.extendedProps.program + ' - ' + info.event.extendedProps.course);
                    $('#start_time').text('Hora de inicio: ' + info.event.start.toLocaleTimeString() + ' ' + info.event.extendedProps.time_period);
                    $('#end_time').text('Hora fin: ' + info.event.end.toLocaleTimeString() + ' ' + info.event.extendedProps.time_period);

                    $('#eventDetailsModal').modal('show');
                }
            });

            calendar.render();
        });

        // Cuando cambia la selección de categoría
        $('#filter').change(function() {
            var filter = $(this).val();

            // Realizar una solicitud AJAX para obtener los resultados filtrados
            $.ajax({
                type: 'POST',
                url: "{{ route('sigac.academic_coordination.programming.filter') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    filter: filter
                },
                success: function(data) {   
                    var option = $('#option');
                    var search = $('#search');
                    search.empty(); // Vaciar las opciones actuales
                    search.append(new Option('Seleccionar', '')); // Agregar opción vacía

                    option.val(data.option); // Asignar el valor al campo oculto option

                    // Agregar las nuevas opciones 
                    $.each(data.results, function(index, result) {
                        search.append(new Option(result.name, result.id));
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        // Cuando cambia la selección de categoría
        $('#search').change(function() {
            var option = $('#option').val();
            console.log(option);
            $.ajax({
                type: 'POST',
                url: "{{ route('sigac.academic_coordination.programming.search') }}", // Ruta para obtener los eventos filtrados
                data: {
                    _token: "{{ csrf_token() }}",
                    eventId: $(this).val() // ID del evento seleccionado en el campo de búsqueda
                },
                success: function(response) {
                    // Actualizar los eventos del calendario con los nuevos datos
                    calendar.removeAllEvents(); // Elimina todos los eventos actuales
                    calendar.addEventSource(response.programmingEvents); // Agrega los nuevos eventos
                    calendar.refetchEvents(); // Actualiza el calendario para mostrar los nuevos eventos
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        $(document).ready(function() {
        $('#search').select2(); // Inicializa el campo course como select2
    });
    </script>
@endpush
