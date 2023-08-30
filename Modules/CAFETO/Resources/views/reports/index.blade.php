@extends('cafeto::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/cafeto/css/card_reports_styles.css') }}">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('cafeto.reports.index') }}"
            class="text-decoration-none">Reportes</a>
    </li>
    <li class="breadcrumb-item active">Panel de Reportes</li>
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
                            {{-- <form method="post" action="{{ route('cafeto.'.getRoleRouteName(Route::currentRouteName()).'.reports.inventory.generate.pdf') }}"> --}}
                                @csrf
                                <button type="submit" class="card-custom card-custom">
                                    <div class="icon">
                                        <i class="fa-solid fa-file-pdf"></i>
                                    </div>
                                    <p class="title">Inventario</p>
                                    <p class="text">Generar el reporte de inventario actual</p>
                                </button>
                            {{-- </form> --}}
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <a class="card-custom a-custom" href="{{-- {{ route('cafeto.reports.inventory.entries') }} --}}">
                                <div class="icon">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </div>
                                <p class="title">Entradas de inventario</p>
                                <p class="text">Generar el reporte de entradas de inventario por fechas</p>
                            </a>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <a class="card-custom a-custom" href="{{-- {{ route('cafeto.reports.sales') }} --}}">
                                <div class="icon">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </div>
                                <p class="title">Ventas</p>
                                <p class="text">Generar repote de ventas por fechas</p>
                            </a>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush