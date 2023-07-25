@extends('ptventa::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/ptventa/css/card_reports_styles.css') }}">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.reports.index') }}" class="text-decoration-none">Reporte</a>
    </li>
    <li class="breadcrumb-item active">Panel Principal</li>
@endpush

@section('content')
    <div class="container">
        <div class="card d-flex justify-content-evenly align-items-center">
            <div class="card-body">
                <h3>Selecciona aquí el tipo de reporte que deseas consultar</h3>
                <hr>
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <a class="card-custom card-resources" href="#">
                            <i class="fas fa-book-open icon-book"></i>
                            <p>Generar reporte de venta</p>
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <!-- Botón para generar el PDF -->
                        <form method="post" action="{{ route('ptventa.reports.inventory.generatePDF') }}">
                            @csrf
                            <button type="submit" class="card-custom card-resources">
                                <i class="fas fa-book-open icon-book"></i>
                                <p>Generar reporte de inventario</p>
                            </button>
                        </form>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <a class="card-custom card-resources" href="#">
                            <i class="fas fa-book-open icon-book"></i>
                            <p>Generar reporte de entrada de inventario</p>
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
