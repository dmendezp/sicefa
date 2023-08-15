@extends('sigac::layouts.master')

@push('head')
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('sigac::general.BTitle') }}</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form class="row g-3">
                        <div class="col-md-12">
                            <label for="inputEnvironment" class="form-label">Selecciona el ambiente</label>
                            <select id="inputEnvironment" class="form-select">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="inputInstructor" class="form-label">Selecciona el instructor</label>
                            <select id="inputInstructor" class="form-select">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="inputPrograms" class="form-label">Selecciona el tecnologo</label>
                            <select id="inputPrograms" class="form-select">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="inputDate1" class="form-label">Selecciona una fecha</label>
                            <input type="date" id="inputDate1" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="inputDate2" class="form-label">Selecciona otra fecha</label>
                            <input type="date" id="inputDate2" class="form-control">
                        </div>
                        
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Programar</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div id='calendar'></div>
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
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listWeek'
                },
                height: 'auto', // Puedes ajustar la altura automáticamente según el contenido
                aspectRatio: 1.0, // Cambia la relación de aspecto para ajustar el ancho
            });
            calendar.render();
        });
    </script>
@endpush
