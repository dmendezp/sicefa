@extends('ptventa::layouts.master')

@push('head')
    @livewireStyles()
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('ptventa.sale.index') }}" class="text-decoration-none">Ventas</a></li>
    <li class="breadcrumb-item active">Registro</li>
@endpush

@section('content')
    @livewire('ptventa::sale.generate-sale')
@endsection

@include('ptventa::layouts.partials.plugins.sweetalert2') {{-- Implementación de Sweetalert2 --}}
@push('scripts')
    @livewireScripts()
    @section('sripts-generate-sale') @show <!-- Scripts necesario para los elementos de generar venta -->
@endpush
