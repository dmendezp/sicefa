@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.report.form') }}" class="text-decoration-none">Reporte</a>
    </li>
    <li class="breadcrumb-item active">Reporte de producto</li>
@endpush

@section('content')
   <h1>holaaaaaaaaaa</h1>
@endsection

@include('ptventa::layouts.partials.plugins.datatables')
@push('scripts')

@endpush
