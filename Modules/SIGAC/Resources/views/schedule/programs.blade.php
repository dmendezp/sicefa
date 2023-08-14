@extends('sigac::layouts.master')

@push('head')
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="#" class="text-decoration-none">{{ trans('sigac::schedule.Schedule') }}</a>
    </li>
    <li class="breadcrumb-item active breadcrumb-color">Programacion de instructores</li>
@endpush

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div>
                            <div class="mb-3">
                                <label for="instructor" class="form-label">Selecciona un instructor</label>
                                <select id="instrcutor" class="form-select" aria-label="Default select example">
                                    <option selected disabled>Seleccione...</option>
                                    <option value="1">Prueba 1</option>
                                    <option value="2">Prueba 2</option>
                                    <option value="3">Prueba 3</option>
                                </select>
                            </div>
                        </div>
                        <div id='external-events'>
                            <h5>Eventos Externos</h5>
                            <div class='external-event'>Evento 1</div>
                            <div class='external-event'>Evento 2</div>
                            <!-- Agrega más eventos externos aquí -->
                        </div>
                    </div>
                    <div class="col-8">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src='{{ asset('libs/fullcalendar-6.1.8/dist/index.global.min.js') }}'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var externalEventsEl = document.getElementById('external-events');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                events: [
                    // Agrega tus eventos aquí si los tienes
                ]
            });

            calendar.render();

            new FullCalendar.Draggable(externalEventsEl, {
                itemSelector: '.external-event',
                eventData: function(eventEl) {
                    return {
                        title: eventEl.innerText
                    };
                }
            });
        });
    </script>
@endpush
