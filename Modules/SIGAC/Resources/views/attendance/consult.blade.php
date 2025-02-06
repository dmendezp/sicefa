@extends('sigac::layouts.master')

@push('title')
    <h1 class="m-0">{{ $view['titleView'] }}</h1>
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="#" class="text-decoration-none">{{ trans('sigac::attendance.Attendance') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('sigac::consult.Consultation') }}</li>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form class="row g-3">
                        <div class="col-12">
                            <label class="form-label">{{ trans('sigac::consult.CardLabel1') }}</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>{{ trans('sigac::consult.CardSelect1') }}</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">{{ trans('sigac::consult.CardLabel2') }}</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>{{ trans('sigac::consult.CardSelect2') }}</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">{{ trans('sigac::consult.CardLabel3') }}</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>{{ trans('sigac::consult.CardSelect3') }}</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ trans('sigac::consult.CardLabel4') }}</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>{{ trans('sigac::consult.CardSelect4') }}</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ trans('sigac::consult.CardLabel5') }}</label>
                            <input type="date" class="form-control" id="start-date">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ trans('sigac::consult.CardLabel6') }}</label>
                            <input type="date" class="form-control" id="end-date">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">{{ trans('sigac::consult.Consult') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3>{{ trans('sigac::consult.AprenticeAttendance') }} Usuario de prueba</h3>
                    <hr>
                    <div id='calendar' class="calendar"></div>
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
