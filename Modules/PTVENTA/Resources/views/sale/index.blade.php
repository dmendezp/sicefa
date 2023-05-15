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

@push('scripts')
    @livewireScripts()
    @section('inputs') @show <!-- Configuración de campos de datos necesarios para la venta -->
@endpush
