@extends('hdc::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hdc::parameters.parameters') }}</li>
@endpush

@section('content')
    <link rel="stylesheet" href="{{ asset('modules/agrocefa/css/specie.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<div class="container" style="margin-left: 20px">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">{{ trans('hdc::parameters.parameters') }}</h1>
        </div>
    </div>
    <div class="row">
        {{-- Columna 1 --}}
        <div class="col-md-12">
            @include('hdc::Parameters.resource')
        </div>
        {{-- Columna 2 --}}
        <div class="col-md-12">
            @include('hdc::Parameters.environment_aspects')
        </div>
        <br>
    </div>
</div>
<br>
<br>
<br>
@endsection