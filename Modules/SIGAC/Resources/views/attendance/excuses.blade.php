@extends('sigac::layouts.master')

@push('head')

@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="#" class="text-decoration-none">{{ trans('sigac::consult.Breadcrumb_Active_Attendance') }}</a>
    </li>
    <li class="breadcrumb-item active breadcrumb-color">{{ trans('sigac::consult.Breadcrumb_Consult_Excuses') }}</li>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <form class="row g-3">
                        <div class="col-12">
                            <label class="form-label">{{ trans('sigac::consult.Card_Title_Technologist') }}</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>{{ trans('sigac::consult.Card_Select') }}</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">{{ trans('sigac::consult.Card_Title_Apprentice') }}</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>{{ trans('sigac::consult.Card_Select') }}</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ trans('sigac::consult.Card_Title_Start_Date') }}</label>
                            <input type="date" class="form-control" id="start-date">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ trans('sigac::consult.Card_Title_End_Date') }}</label>
                            <input type="date" class="form-control" id="end-date">
                        </div>
                        <div class="col-md-6 d-flex align-items-end justify-content-md-start">
                            <button type="submit"
                                class="btn btn-primary btn-block">{{ trans('sigac::consult.Btn_Consult') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h5 class="font-weight-bold">{{ trans('sigac::consult.Title_Aprentice_Attendance') }} Usuario de prueba
                        </h5>
                    </div>
                    <hr>
                    <div id='calendar' class="calendar"></div>
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
