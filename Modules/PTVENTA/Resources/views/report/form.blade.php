@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.report.form') }}" class="text-decoration-none">Reporte</a>
    </li>
    <li class="breadcrumb-item active">Reporte de producto</li>
@endpush

@section('content')
<div class="card w-50 mb-3">
    <div class="card-body">
        <label>Fecha inicio</label>
        <input type="date" id="fecha" name="fecha" class="form-control" required>

        <label>Fecha final</label>
        <input type="date" id="fecha" name="fecha" class="form-control" required>
    </div>
  </div>
@endsection

@include('ptventa::layouts.partials.plugins.datatables')
@push('scripts')

@endpush
