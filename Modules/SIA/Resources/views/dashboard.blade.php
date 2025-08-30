@extends('sia::layouts.master')

@push('head')
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('sigac::index.Breadcrumb_Active_Main') }}</li>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-8 col-12">
                <h1>{{ trans('sigac::index.Title_General') }}</h1>
            </div>
        </div>
    </div>
@endsection
