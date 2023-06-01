@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.report.form') }}" class="text-decoration-none">Reporte</a>
    </li>
    <li class="breadcrumb-item active">Reporte de inventario</li>
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
                        <th class="text-center">Producto</th> nombre del elemento
                        <th class="text-center">Fecha entrada</th> moviment->date
                        <th class="text-center">Valor</th> miviment detail -> price
                        <th class="text-center">Cantidad</th> movimen detaiol->amount
                        <th class="text-center">Subtotal</th>  multiplicacion de moviment detail->price + moviemnt delail amount
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($report as $r)
                        <tr>
                            <td class="text-center">{{ $r->movement_details->inventory->element->name }}</td>
                            <td class="text-center">xxxxxxxx</td>
                            <td class="text-center">{{ $r->price }}</td>
                            <td class="text-center">{{ $r->amount }}</td>
                            <td class="text-center">kmogmnotg</td>
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
