@extends('ptventa::layouts.master')

@push('head')
    <!-- Estilos de la galería de imágenes -->
    <link rel="stylesheet" href="{{ asset('modules/ptventa/css/image-gallery-styles.css') }}">
    @livewireStyles()
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.'.getRoleRouteName(Route::currentRouteName()).'.element.index') }}" class="text-decoration-none">{{ trans('ptventa::element.Breadcrumb_Element')}}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('ptventa::element.Breadcrumb_Active_Element')}}</li>
@endpush

@section('content')
    <div class="card card-success card-outline col-12 mx-auto">
        <div class="card-body">
            @livewire('ptventa::element.show-images')
        </div>
    </div>
@endsection

@include('ptventa::layouts.partials.plugins.sweetalert2') {{-- Implementación de Sweetalert2 --}}
@push('scripts')
    @livewireScripts()
@endpush
