@extends('sigac::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/sigac/css/customStyles.css') }}">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">Programación de horarios</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <h4>Selecciona el tipo de Programación</h4>
                    <select class="form-select form-select-sm" aria-label="Small select example">
                        <option selected>Selecciona...</option>
                        <option value="1">Instructor</option>
                        <option value="2">Titulada</option>
                    </select>
                    <br>
                    <h4>Selecciona el tecnologo</h4>
                    <select class="form-select form-select-sm" aria-label="Small select example">
                        <option selected>Selecciona el tecnologo disponible</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    <br>
                    <h4>Selecciona el tipo de horario</h4>
                    <select class="form-select form-select-sm" aria-label="Small select example">
                        <option selected>Selecciona...</option>
                        <option value="1">Lectiva</option>
                        <option value="2">Electiva</option>
                    </select>
                    <br>
                    <h4>Selecciona la Programación</h4>
                    <div id="external-events">
                        <div class="fc-event">Evento 1</div>
                        <div class="fc-event">Evento 2</div>
                        <div class="fc-event">Evento 3</div>
                        <!-- Agrega más eventos externos según sea necesario -->
                    </div>
                </div>
                <div class="col-md-8">
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
                }
            });

            // Inicializa los eventos externos para que se puedan arrastrar
            new FullCalendar.Draggable(externalEventsEl, {
                itemSelector: '.fc-event',
                eventData: function(eventEl) {
                    return {
                        title: eventEl.innerText,
                    };
                }
            });

            calendar.render();
        });
    </script>
@endpush
