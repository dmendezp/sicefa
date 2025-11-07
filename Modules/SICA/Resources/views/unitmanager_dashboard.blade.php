@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <h3>Solicitudes</h3>
            <div class="mtop16">
                <p>No hay solucitudes pendientes</p>
            </div>
            <h3>Registros</h3>
            <div class="mtop16">
                <a class="btn btn-app btn-app-2">
                    <span class="badge bg-info">{{ number_format($environments, 0, ',', '.') }}</span>
                    <i class="fas fa-map-marked-alt"></i> Ambientes
                </a>
                <a class="btn btn-app btn-app-2">
                    <span class="badge bg-info">{{ number_format($productive_units, 0, ',', '.') }}</span>
                    <i class="fas fa-warehouse"></i> U. Productivas
                </a>
            </div>
        </div>
    </div>
@endsection
