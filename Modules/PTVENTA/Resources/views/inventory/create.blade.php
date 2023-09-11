@extends('ptventa::layouts.master')

@push('head')
    @livewireStyles()
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.'.getRoleRouteName(Route::currentRouteName()).'.inventory.index') }}" class="text-decoration-none">{{ trans('ptventa::inventory.Breadcrumb_Inventory_1')}}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('ptventa::inventory.Breadcrumb_Active_Register_Inventory_1')}}</li>
@endpush

@section('content')
    {{-- Se incluye el componente para registrar una entrada de inventario --}}
    @livewire('ptventa::inventory.register-entry')
@endsection

@include('ptventa::layouts.partials.plugins.sweetalert2') {{-- Implementación de Sweetalert2 --}}
@include('ptventa::layouts.partials.plugins.toastr') {{-- Implementación de Toastr --}}
@push('scripts')
    @livewireScripts()
    @section('sripts-register-entry') @show <!-- Scripts necesarios para registrar una entrada de inventario -->
@endpush
