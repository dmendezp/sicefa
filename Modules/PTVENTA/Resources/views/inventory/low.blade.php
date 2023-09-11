@extends('ptventa::layouts.master')

@push('head')
    @livewireStyles()
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">
        <a href="{{ route('ptventa.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.index') }}"
            class="text-decoration-none">{{ trans('ptventa::inventory.Breadcrumb_Inventory_1') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('ptventa::inventory.Breadcrumb_Active_Low_Inventory_1') }}</li>
@endpush

@section('content')
    @livewire('ptventa::inventory.register-low')
@endsection

@include('ptventa::layouts.partials.plugins.sweetalert2') {{-- Implementación de Sweetalert2 --}}
@include('ptventa::layouts.partials.plugins.toastr') {{-- Implementación de Toastr --}}
@push('scripts')
    @livewireScripts()
    @section('sripts-register-low') @show <!-- Scripts necesarios para registrar una baja de inventario -->
@endpush
