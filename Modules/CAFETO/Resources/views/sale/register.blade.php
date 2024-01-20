@extends('cafeto::layouts.master')

@push('head')
    @livewireStyles()
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.sale.index') }}" class="text-decoration-none">{{ trans('cafeto::sales.Breadcrumb_Register_1') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('cafeto::sales.Breadcrumb_Active_Register_1') }}</li>
@endpush

@section('content')
    {{-- Se incluye el componente para registrar una venta --}}
    @livewire('cafeto::sale.generate-sale')
@endsection

@include('cafeto::layouts.partials.plugins.sweetalert2') {{-- Implementación de Sweetalert2 --}}
@include('cafeto::layouts.partials.plugins.toastr') {{-- Implementación de Toastr --}}
@push('scripts')
    @livewireScripts()
    @section('sripts-generate-sale') @show <!-- Scripts necesarios para generar una venta -->
@endpush
