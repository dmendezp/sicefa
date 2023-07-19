@extends('ptventa::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/ptventa/css/card_reports_styles.css') }}">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.reports.index') }}" class="text-decoration-none">Reporte</a>
    </li>
    <li class="breadcrumb-item active">Reporte de inventario</li>
@endpush

@section('content')
    <div class="container">
        <div class="card d-flex justify-content-evenly align-items-center">
            <div class="card-body">
                <h3>Selecciona aquí el tipo de reporte que deseas consultar</h3>
                <hr>
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <a class="card-custom human-resources" href="#">
                            <div class="overlay"></div>
                            <p>Repotes de Ventas</p>
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <a class="card-custom human-resources" href="#">
                            <div class="overlay"></div>
                            <p>Reportes de Bajas</p>
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <a class="card-custom human-resources" href="#">
                            <div class="overlay"></div>
                            <p>Reportes de Inventario</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('ptventa::layouts.partials.plugins.datatables')
@push('scripts')
@endpush
