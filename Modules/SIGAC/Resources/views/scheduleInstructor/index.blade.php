@extends('sigac::layouts.master')

@push('title')
    <h1 class="m-0">{{ $view['titleView'] }}</h1>
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="#" class="text-decoration-none">{{ trans('sigac::schedule.Schedule') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('sigac::schedule.Schedule Instructor') }}</li>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

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
@endsection
