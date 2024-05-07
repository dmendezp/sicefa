@extends('sigac::layouts.master')

@push('head')
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="#">{{ trans('sigac::attendance.Breadcrumb_Active_Attendance') }}</a>
    </li>
    <li class="breadcrumb-item active breadcrumb-color">{{ trans('sigac::attendance.Breadcrumb_Attendance_Consult') }}</li>
@endpush

@section('content')
<div class="card">
    <div class="card-body">
        <h3 class="text-center">{{ trans('sigac::attendance.Title_Card_Consult') }}</h3>
        <div class="row">
            <div class="d-flex justify-content-evenly">
                <div class="col-md-2">
                    <a href="#" style="text-decoration: none;">
                        <div class="card-custom">
                            <h2>{{ trans('sigac::attendance.Title_Card_Apprentice') }}</h2>
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="#" style="text-decoration: none;">
                        <div class="card-custom">
                            <h2>{{ trans('sigac::attendance.Title_Card_Titled') }}</h2>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
@endpush
