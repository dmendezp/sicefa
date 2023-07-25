@extends('ptventa::layouts.master')
@push('head')
    <link rel="stylesheet" href="{{ asset('modules/ptventa/css/card_reports_styles.css') }}">
@endpush
@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.reports.index') }}" class="text-decoration-none">Reporte</a>
    </li>
    <li class="breadcrumb-item active">Inventario</li>
@endpush
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="col-12">
                    <form class="row g-3">
                        <form class="row g-3" method="post" action="#">
                            <div class="col-md-6">
                                <label class="form-label">Fecha Inicio</label>
                                <input type="date" class="form-control" name="start_date" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Fecha Fin</label>
                                <input type="date" class="form-control" name="end_date" required>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Consultar</button>
                                <button type="submit" class="btn btn-danger">Generar reporte</button>
                            </div>
                        </form>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mt-4">
                                <div class="card-body">
                                    <h4>Reportes de ventas desde xxxxxxx a xxxxxxx</h4>
                                    <hr>
                                    <table class="table" id="reportInventory">
                                        <thead class="table-dark">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Elemento</th>
                                                <th scope="col">Precio</th>
                                                <th scope="col">Cantidad</th>
                                                <th scope="col">Stock</th>
                                                <th scope="col">Fecha de Prodcción </th>
                                                <th scope="col">Fecha de Vencimiento </th>
                                                <th scope="col">Número de Lote</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Prodcuto Prueba</td>
                                                <td>2000</td>
                                                <td>40</td>
                                                <td>2</td>
                                                <td>19-09-20</td>
                                                <td>19-09-20</td>
                                                <td>1234</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
