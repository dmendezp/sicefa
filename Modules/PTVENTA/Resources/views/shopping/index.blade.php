@extends('ptventa::layouts.master')

@push('head')
    <!-- Estilos de la galería de imágenes -->
    <link rel="stylesheet" href="{{ asset('modules/ptventa/css/image-gallery-styles.css') }}">
    @livewireStyles()
@endpush

@section('content')
    <div class="card card-success card-outline col-12 mx-auto">
        <div class="card-body">
            @livewire('shopping')
        </div>
    </div>
        <!-- Boton de carrito -->
        <div class="container-fluid">
                <a href="{{ route('cefa.ptventa.shopping') }}" class="button-register-sale bg-success pt-2 pe-1" >
                    <i class="fa-solid fa-cart-shopping fa-bounce"></i>
                </a>
        </div>
        <!--/. Boton de carrito -->
@endsection

@include('ptventa::layouts.partials.plugins.sweetalert2') {{-- Implementación de Sweetalert2 --}}
@push('scripts')
    @livewireScripts()
@endpush
