@extends('ptventa::layouts.master')

@push('head')
    @livewireStyles()
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">
        <a href="{{ route('ptventa.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.index') }}"
            class="text-decoration-none">{{ trans('ptventa::inventory.Inventory') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('ptventa::inventory.B6') }}</li>
@endpush

@section('content')
    @livewire('ptventa::inventory.register-low')
@endsection

@push('scripts')
    @livewireScripts()
@endpush
