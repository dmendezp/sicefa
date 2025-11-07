@extends('cafeto::layouts.master')

@push('head')
    <!-- Estilos de la galería de imágenes -->
    <link rel="stylesheet" href="{{ asset('modules/cafeto/css/image-gallery-styles.css') }}">
    @livewireStyles()
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('cafeto.'.getRoleRouteName(Route::currentRouteName()).'.element.index') }}" class="text-decoration-none">{{ trans('cafeto::element.Breadcrumb_Element')}}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('cafeto::element.Breadcrumb_Active_Element')}}</li>
@endpush

@section('content')
    <div class="card card-success card-outline col-12 mx-auto custom-border-color">
        <div class="card-body">
            @livewire('cafeto::element.show-images')
        </div>
    </div>
@endsection

@include('cafeto::layouts.partials.plugins.sweetalert2') {{-- Implementación de Sweetalert2 --}}
@push('scripts')
    @livewireScripts()
@endpush