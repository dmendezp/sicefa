@extends('sigac::layouts.master')

@push('head')
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="#" class="text-decoration-none">{{ trans('sigac::schedule.Schedule') }}</a>
    </li>
    <li class="breadcrumb-item active breadcrumb-color">{{ trans('sigac::schedule.Schedule Instructor') }}</li>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <h4>Tu Horario</h4>
                        <hr>
                        <div id='calendar'></div>
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
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth'
            });
            calendar.render();
        });
    </script>
@endpush