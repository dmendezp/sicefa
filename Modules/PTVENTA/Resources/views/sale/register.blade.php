@extends('ptventa::layouts.master')

@push('head')
    @livewireStyles()
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.' . getRoleRouteName(Route::currentRouteName()) . '.sale.index') }}" class="text-decoration-none">{{ trans('ptventa::sales.Breadcrumb_Register_1') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('ptventa::sales.Breadcrumb_Active_Register_1') }}</li>
@endpush

@section('content')
    {{-- Se incluye el componente para registrar una venta --}}
    @livewire('ptventa::sale.generate-sale')
@endsection

@include('ptventa::layouts.partials.plugins.sweetalert2') {{-- Implementación de Sweetalert2 --}}
@include('ptventa::layouts.partials.plugins.toastr') {{-- Implementación de Toastr --}}
@push('scripts')
    @livewireScripts()
    @section('sripts-generate-sale') @show <!-- Scripts necesarios para generar una venta -->
@endpush
