@extends('ptventa::layouts.master')

@push('head')
    <!-- Estilos de la galería de imágenes -->
    <link rel="stylesheet" href="{{ asset('modules/ptventa/css/image-gallery-styles.css') }}">
    @livewireStyles()
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('ptventa.element.image.index') }}" class="text-decoration-none">Productos</a></li>
    <li class="breadcrumb-item active">Imágenes</li>
@endpush

@section('content')
    <div class="card card-success card-outline col-12 mx-auto">
        <div class="card-body">
            @livewire('ptventa::element.show-images')
        </div>
    </div>
@endsection

@include('ptventa::layouts.partials.plugins.sweetalert2')
@push('scripts')
    @livewireScripts()
@endpush
