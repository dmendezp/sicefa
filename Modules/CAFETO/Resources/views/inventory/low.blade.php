@extends('cafeto::layouts.master')

@push('head')
    @livewireStyles()
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">
        <a href="{{ route('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.index') }}"
            class="text-decoration-none">{{ trans('cafeto::inventory.Breadcrumb_Inventory_1') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('cafeto::inventory.Breadcrumb_Active_Low_Inventory_1') }}</li>
@endpush

@section('content')
    @livewire('cafeto::inventory.register-low')
@endsection

@include('cafeto::layouts.partials.plugins.sweetalert2') {{-- Implementación de Sweetalert2 --}}
@include('cafeto::layouts.partials.plugins.toastr') {{-- Implementación de Toastr --}}
@push('scripts')
    @livewireScripts()
    @section('sripts-register-low') @show <!-- Scripts necesarios para registrar una baja de inventario -->
@endpush
