@extends('sigac::layouts.master')

@push('head')
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="#" class="text-decoration-none">{{ trans('sigac::reports.Reports') }}</a>
    </li>
    <li class="breadcrumb-item active breadcrumb-color">{{ trans('sigac::reports.Principal') }}</li>
@endpush

@section('content')

@endsection

@push('scripts')

@endpush
