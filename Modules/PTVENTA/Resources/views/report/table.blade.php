@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.report.form') }}" class="text-decoration-none">Reporte</a>
    </li>
    <li class="breadcrumb-item active">Reporte de producto</li>
@endpush

@section('content')
<div class="card w-80 mb-3">
    <div class="card-header">
        Reporte
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">Producto</th>
                        <th class="text-center">Fecha entrada</th>
                        <th class="text-center">Valor</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Subtotal</th>
                        <th class="text-center">Total</th>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($element as $e)
                        <tr>
                            <td class="text-center">{{ $e->name }}</td>
                            <td class="text-center">xxxxxxxx</td>
                            <td class="text-center">{{ $e->}}</td>
                            <td class="text-center">mbrpmbr</td>
                            <td class="text-center">kmogmnotg</td>
                            <td class="text-center">65265872365326</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
  </div>
@endsection

@include('ptventa::layouts.partials.plugins.datatables')
@push('scripts')

@endpush
