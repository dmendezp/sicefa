@extends('cafeto::layouts.master')

@push('head')
    <!-- Estilos de la galería de imágenes -->
    <link rel="stylesheet" href="{{ asset('modules/cafeto/css/image-gallery-styles.css') }}">
    @livewireStyles()
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('cafeto.element.index') }}" class="text-decoration-none">Productos</a></li>
    <li class="breadcrumb-item active">Imágenes</li>
@endpush

@section('content')
    <div class="card card-success card-outline col-12 mx-auto">
        <div class="card-body">
            @livewire('cafeto::element.show-images')
        </div>
    </div>
@endsection

@include('cafeto::layouts.partials.plugins.sweetalert2')
@push('scripts')
    @livewireScripts()
@endpush
