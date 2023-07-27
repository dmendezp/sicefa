@extends('ptventa::layouts.master')

@push('head')
    @livewireStyles()
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.inventory.index') }}" class="text-decoration-none">Inventario</a>
    </li>
    <li class="breadcrumb-item active">Registro entrada</li>
@endpush

@section('content')
    {{-- Se incluye el componente para registrar una entrada de inventario --}}
    @livewire('ptventa::inventory.register-entry')
@endsection

@include('ptventa::layouts.partials.plugins.sweetalert2') {{-- Implementación de Sweetalert2 --}}
@push('scripts')
    @livewireScripts()
    @section('sripts-register-entry') @show <!-- Scripts necesarios para registrar una entrada de inventario -->
@endpush
