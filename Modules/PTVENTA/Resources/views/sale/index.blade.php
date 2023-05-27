@extends('ptventa::layouts.master')

@push('head')
    @livewireStyles()
@endpush

@push('breadcrumbs')
    <div class="col-sm-6">
        <h1 class="m-0">{{ $view['titleView'] }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('ptventa.sale.index') }}" class="text-decoration-none">Ventas</a></li>
            <li class="breadcrumb-item active">Registro</li>
        </ol>
    </div>
@endpush

@section('content')
    @livewire('ptventa::sale.generate-sale')
@endsection

@push('scripts')
    @livewireScripts()
    @section('inputs') @show <!-- Configuración de campos de datos necesarios para la venta -->
@endpush
