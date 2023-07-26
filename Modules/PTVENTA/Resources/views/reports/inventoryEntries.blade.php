@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.reports.index') }}" class="text-decoration-none">Reporte</a>
    </li>
    <li class="breadcrumb-item active">Entradas de Inventario</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form class="row g-3" action="{{ route('ptventa.reports.inventoryEntries') }}" method="GET">
                        @csrf
                        <div class="col-md-6">
                            <label class="form-label">Fecha de Inicio: </label>
                            <input type="date" class="form-control" name="start_date" id="start_date" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Fecha Final: </label>
                            <input type="date" class="form-control" name="end_date" id="end_date" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </div>
                    </form>
                    <hr>

                    @if ($movements->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Número de Voucher</th>
                                        <th>Responsable que entrega</th>
                                        <th>Fecha de ingreso</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Subtotal</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $rowNumber = 0; // Variable para hacer un seguimiento del número de fila actual
                                    @endphp
                                
                                @foreach ($movements as $key => $movement)
                                    @foreach ($movement->movement_details as $index => $movement_detail)
                                        <tr>
                                            @if ($index === 0) {{-- Verificar si es la primera fila del movimiento --}}
                                                <td rowspan="{{ count($movement->movement_details) }}">{{ $key + 1 }}</td>
                                                <td rowspan="{{ count($movement->movement_details) }}">{{ $movement->voucher_number }}</td>
                                                <td rowspan="{{ count($movement->movement_details) }}">{{ $movement->movement_responsibilities->where('role', 'ENTREGA')->first()->person->full_name }}</td>
                                                <td rowspan="{{ count($movement->movement_details) }}">{{ $movement->registration_date }}</td>
                                            @endif
                                            <td>{{ $movement_detail->inventory->element->product_name}}</td>
                                            <td>{{ $movement_detail->amount }}</td>
                                            <td>{{ priceFormat($movement_detail->price) }}</td>
                                            <td>{{ priceFormat($movement_detail->amount * $movement_detail->price) }}</td>
                                            @if ($index === 0) {{-- Solo mostrar el precio en la primera fila del movimiento --}}
                                                <td rowspan="{{ count($movement->movement_details) }}">{{ priceFormat($movement->price) }}</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>No se encontraron registros para las fechas seleccionadas.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@include('ptventa::layouts.partials.plugins.datatables')

@push('scripts')

@endpush
