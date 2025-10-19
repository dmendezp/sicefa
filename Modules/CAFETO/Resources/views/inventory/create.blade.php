@extends('cafeto::layouts.master')

@push('head')
    @livewireStyles()
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('cafeto.'.getRoleRouteName(Route::currentRouteName()).'.inventory.index') }}" class="text-decoration-none">{{ trans('cafeto::inventory.Breadcrumb_Inventory_1') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('cafeto::inventory.Breadcrumb_Active_Register_Inventory_1') }}</li>
@endpush

@section('content')
    @livewire('cafeto::inventory.register-entry')
@endsection

@include('cafeto::layouts.partials.plugins.sweetalert2')
@include('cafeto::layouts.partials.plugins.toastr')

@push('scripts')
    @livewireScripts()
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @section('sripts-register-entry') @show
@endpush