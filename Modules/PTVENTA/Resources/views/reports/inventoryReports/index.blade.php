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
                <form class="row g-3" method="post" action="{{ route('ptventa.reports.inventory.show') }}">
                    @csrf
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
                        <!-- Botón para generar el PDF -->
                        <button type="submit" class="btn btn-danger" formaction="{{ route('ptventa.reports.inventory.generatePDF') }}">Generar PDF</button>
                    </div>
                </form>                
            </div>
        </div>
    </div>
</div>

@if(isset($inventories))
    @if($inventories->count() > 0)
        <div class="row">
            <div class="col-12">
                <div class="card mt-4">
                    <div class="card-body">
                        <h4>Reportes de ventas desde {{ $startDateTime->toDateString() }} a {{ $endDateTime->toDateString() }}</h4>
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
                                @foreach ($inventories as $inventory)
                                    <tr>
                                        <th scope="row">{{ $inventory->id }}</th>
                                        <td>{{ $inventory->element->name }}</td>
                                        <td>{{ $inventory->price }}</td>
                                        <td>{{ $inventory->amount }}</td>
                                        <td>{{ $inventory->stock }}</td>
                                        <td>{{ $inventory->production_date }}</td>
                                        <td>{{ $inventory->expiration_date }}</td>
                                        <td>{{ $inventory->lot_number }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4>No se encontraron resultados para el intervalo de fechas seleccionado.</h4>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif
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
