@extends('ptventa::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/ptventa/css/card_reports_styles.css') }}">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.reports.inventory.index') }}" class="text-decoration-none">Reporte</a>
    </li>
    <li class="breadcrumb-item active">Inventario</li>
@endpush

@section('content')
<div class="row">
    <div class="card">
        <div class="card-body">
            <div class="col-12">
                <form class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Fecha Inicio</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Fecha Fin</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Consultar</button>
                        <button type="submit" class="btn btn-danger">Generar reporte</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4>Reportes de ventas de la fecha xxxxxxx a la fecha xxxxxxx</h4>
                <hr>
                <table class="table" id="reportInventory">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@include('ptventa::layouts.partials.plugins.datatables')
@push('scripts')
<script>
    // Permite la aplicacion de datatables y la vez la traduccion de las tablas
    $(document).ready(function() {
        /* Initialización of Datatables Results */
        $('#reportInventory').DataTable({
            language: language_datatables, // Agregar traducción a español
        });
    });
</script>
@endpush
