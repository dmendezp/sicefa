@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.inventory.index') }}" class="text-decoration-none">Inventario</a>
    </li>
    <li class="breadcrumb-item active">Productos</li>
@endpush

@section('content')
    <div class="card card-success card-outline shadow-sm">
        <div class="card-body">

            <div class="row">
                <div class="col">
                    <h5 class="text-center"><em>Lista de productos disponibles actualmente</em></h5>
                </div>
                <div class="col-auto">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('ptventa.inventory.create') }}" class="btn btn-success btn-sm me-1">
                            <i class="fa-solid fa-thumbs-up mr-2"></i>Registrar entrada
                        </a>
                        {{-- <a href="{{ route('ptventa.inventory.low') }}" class="btn btn-danger btn-sm me-1">
                            <i class="fa-solid fa-thumbs-down mr-2"></i>Registrar baja
                        </a> --}}
                        {{-- <a href="{{ route('ptventa.inventory.pdf') }}" class="btn btn-danger btn-sm me-1">PDF</a> --}}
                        <a href="{{ route('ptventa.inventory.status') }}" class="btn btn-secondary btn-sm">
                            <i class="fa-solid fa-triangle-exclamation mr-2"></i>Vencidos / Por vencer
                        </a>
                    </div>
                </div>
            </div>

            <hr>

            <div class="table-responsive px-1" data-aos="zoom-in">
                <table class="table table-bordered border-secondary table-hover">
                    <thead class="table-dark">
                        <tr class="border-dark">
                            <th class="text-center">#</th>
                            <th>Producto</th>
                            <th class="text-center"># Lote</th>
                            <th class="text-center">
                                <i class="fa-solid fa-calendar-days"></i>
                                Producción
                            </th>
                            <th class="text-center">
                                <i class="fa-solid fa-calendar-days"></i>
                                Vencimiento
                            </th>
                            <th class="text-center">$ Entrada</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">$ Venta</th>
                            <th class="text-center">Existencias</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($groupedInventories as $group)
                            @php
                                $firstRecord = $group->first();
                                $rowspan = $group->count();
                            @endphp
                            <tr>
                                <td rowspan="{{ $rowspan }}" class="text-center border-secondary align-middle">{{ $loop->iteration }}</td>
                                <td rowspan="{{ $rowspan }}" class="border-secondary align-middle">
                                    <strong>{{ $firstRecord->element->name }}</strong>
                                </td>
                                <td class="text-center border-secondary">{{ $firstRecord->lot_number }}</td>
                                <td class="text-center border-secondary">{{ $firstRecord->production_date }}</td>
                                <td class="text-center border-secondary">{{ $firstRecord->expiration_date }}</td>
                                <td class="text-center border-secondary">{{ priceFormat($firstRecord->price) }}</td>
                                <td class="text-center border-secondary">{{ $firstRecord->amount }}</td>
                                <td rowspan="{{ $rowspan }}" class="text-center border-secondary align-middle">
                                    <strong>{{ priceFormat($firstRecord->element->price) }}</strong>
                                </td>
                                <td rowspan="{{ $rowspan }}" class="text-center border-secondary align-middle">
                                    <strong>{{ $group->sum('amount') }}</strong>
                                </td>
                            </tr>
                            @foreach ($group->slice(1) as $record)
                                <tr>
                                    <td class="text-center border-secondary">{{ $record->lot_number }}</td>
                                    <td class="text-center border-secondary">{{ $record->production_date }}</td>
                                    <td class="text-center border-secondary">{{ $record->expiration_date }}</td>
                                    <td class="text-center border-secondary">{{ priceFormat($record->price) }}</td>
                                    <td class="text-center border-secondary">{{ $record->amount }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
