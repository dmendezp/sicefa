@extends('ptventa::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/ptventa/css/custom_styles.css') }}">
@endpush

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
                    <form class="row g-3" action="{{ route('ptventa.reports.generateInventoryEntries') }}" method="POST">
                        @csrf
                        <div class="col-md-3">
                            <label class="form-label">Fecha de Inicio: </label>
                            <input type="date" class="form-control" name="start_date" id="start_date" value="{{ $start_date }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Fecha Final: </label>
                            <input type="date" class="form-control" name="end_date" id="end_date" value="{{ $end_date }}" required>
                        </div>
                        <div class="col-md-2 align-self-end">
                            <button type="submit" class="btn btn-primary">Buscar <i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                    <hr>

                    @if (isset($movements) && $movements->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th class=text-center>#</th>
                                        <th class="text-center">Número de Voucher</th>
                                        <th>Responsable que entrega</th>
                                        <th>Fecha de ingreso</th>
                                        <th>Producto</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-center">Precio</th>
                                        <th class="text-center">Subtotal</th>
                                        <th class="text-center">Total</th>
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
                                                <td class="text-center" rowspan="{{ count($movement->movement_details) }}" style="vertical-align: middle;">{{ $key + 1 }}</td>
                                                <td class="text-center" rowspan="{{ count($movement->movement_details) }}" style="vertical-align: middle;">{{ $movement->voucher_number }}</td>
                                                <td rowspan="{{ count($movement->movement_details) }}" style="vertical-align: middle;">{{ $movement->movement_responsibilities->where('role', 'ENTREGA')->first()->person->full_name }}</td>
                                                <td rowspan="{{ count($movement->movement_details) }}" style="vertical-align: middle;">{{ $movement->registration_date }}</td>
                                            @endif
                                            <td>{{ $movement_detail->inventory->element->product_name}}</td>
                                            <td class="text-center">{{ $movement_detail->amount }}</td>
                                            <td class="text-center">{{ priceFormat($movement_detail->price) }}</td>
                                            <td class="text-center">{{ priceFormat($movement_detail->amount * $movement_detail->price) }}</td>
                                            @if ($index === 0) {{-- Solo mostrar el precio en la primera fila del movimiento --}}
                                                <td class="text-center fw-bold" rowspan="{{ count($movement->movement_details) }}" style="vertical-align: middle;">{{ priceFormat($movement->price) }}</td>
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
<script>
    // Función para actualizar los atributos min y max de los campos de fecha
    function updateDateAttributes() {
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
        
        endDateInput.min = startDateInput.value;
        startDateInput.max = endDateInput.value;
    }

    // Eventos para actualizar los atributos al cambiar las fechas
    document.getElementById('start_date').addEventListener('change', updateDateAttributes);
    document.getElementById('end_date').addEventListener('change', updateDateAttributes);
</script>
@endpush
