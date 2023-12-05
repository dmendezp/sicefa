@extends('hangarauto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans ('hangarauto::general.Indicator_Homepage') }}</li>
@endpush

@push('head')
    <style>
        .highcharts-xaxis-labels text {
            fill: black !important;
        }
    </style>
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="text-center">{{ trans('hangarauto::general.title1') }}</h2>
            <hr>
            <div class="row">
                <div class="col-6">
                </div>
            </div>
        </div>
    </div>
@endsection
