@extends('ptventa::layouts.master')
<style type="text/css">
    
    .table-status{
        top:20px;
        width:400px;
        float: left;
        margin-right: 10px;

    }

    .table-status{
        top:20px;
        width:600px;
        float: left;
        margin-right: 10px;
    }
</style>

@push('breadcrumbs')
    <li class="breadcrumb-item active">
        <a href="{{ route('ptventa.inventory.index') }}" class="text-decoration-none">Inventario</a>
    </li>
    <li class="breadcrumb-item active">Estado de productos</li>
@endpush

@section('content')
<div class="container">
    <div class="text-end">
    <div class="col-auto pe-2">
            <a href="{{ route('ptventa.inventory.low') }}" class="btn btn-success btn-sm"> Registro de bajas </a>
        </div>
    </div>
</div>
    <hr>
    <h6 class="text-center bg-secondary py-2 rounded-2"><strong>Todos los productos</strong></h6>
    <div class="table-status">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                    <div class="card-body">
                    <table class="table table-hover" id="status-table">
                    <h6 class="text-center bg-success py-1 rounded-2"><strong>VENCIDOS</strong></h6>
                        <thead class="table-dark">
                            <thead>
                                <tr>
                                    <th class="text-center">Productos</th>
                                    <th class="text-center">Fecha</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <tr>
                                    @foreach ($productosVencidos as $producto)
                                    <td><strong>{{ $producto->element->name }}</strong></td>
                                    <td class="text-center">{{ $producto->expiration_date }}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="table-status">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover" id="status-table">
                            <h6 class="text-center bg-success py-1 rounded-2"><strong>POR VENCER </strong></h6>
                            <thead class="table-dark"></thead>
                            <thead>
                                <tr>
                                    <th class="text-center">Productos</th>
                                    <th class="text-center">Fecha</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <tr>
                                    @foreach ($productosPorVencer as $producto)
                                    <td><strong>{{ $producto->element->name }}</strong></td>
                                    <td class="text-center">{{ $producto->expiration_date }}</p>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@include('ptventa::layouts.partials.plugins.datatables')

