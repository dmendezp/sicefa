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
                <h3 class="text-center">Selecciona aquí el tipo de reporte que deseas consultar</h3>
                <hr>
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <!-- Botón para generar el PDF -->
                        <form method="post" action="{{ route('ptventa.reports.inventory.generatePDF') }}">
                            @csrf
                            <button type="submit" class="card-custom card-custom">
                                <div class="icon">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                <p class="title">Inventario</p>
                                <p class="text">Genera el reporte del inventario actual</p>
                            </button>
                        </form>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <a class="card-custom a-custom" href="{{ route('ptventa.reports.inventoryEntries') }}">
                            <div class="icon">
                                <i class="fas fa-book-open"></i>
                            </div>
                            <p class="title">Entrada de inventario</p>
                            <p class="text">Genera el reporte de entradas de inventario por fechas</p>
                        </a>
                    </div> 
                    <div class="col-md-4 col-sm-6">
                        <div class="card-custom">
                            <div class="icon">
                                <i class="fas fa-book-open"></i>
                            </div>
                            <p class="title">Ventas</p>
                            <p class="text">Genera el reporte de ventas</p>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
@endsection

@include('ptventa::layouts.partials.plugins.datatables')
@push('scripts')
@endpush
