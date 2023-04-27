@extends('ptventa::layouts.master')

@section('head')
    {{-- Estilos de la galería de imágenes --}}
    <link rel="stylesheet" href="{{ asset('modules/ptventa/css/image-gallery-styles.css') }}">
    {{-- Estilos de livewire --}}
    @livewireStyles()
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('ptventa.element.index') }}" class="text-decoration-none">Productos</a></li>
    <li class="breadcrumb-item active">Imágenes</li>
@endsection

@section('content')
    <div class="card card-success card-outline col-12 mx-auto">
        <div class="card-body">
            @livewire('modules.p-t-v-e-n-t-a.element.gallery.show-images')
        </div>
    </div>
@endsection

@section('scripts')
    {{-- Scripts de livewire --}}
    @livewireScripts()
@endsection
