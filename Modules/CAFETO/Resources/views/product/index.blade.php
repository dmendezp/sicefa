@extends('cafeto::layouts.master')

@section('head')
    {{-- Estilos de la galería de imágenes --}}
    <link rel="stylesheet" href="{{ asset('cafeto/css/image-gallery-styles.css') }}">
    {{-- Estilos de livewire --}}
    @livewireStyles()
@endsection

@section('breadcrumb')

    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Productos</a></li>
    <li class="breadcrumb-item active">Imágenes</li>
@endsection

@section('content')
    <div class="card card-outline col-12 mx-auto">
        <div class="card-body">
            @livewire('modules.cafeto.product.gallery.show-images')
        </div>
    </div>
@endsection

@section('scripts')
    {{-- Scripts de livewire --}}
    @livewireScripts()
@endsection