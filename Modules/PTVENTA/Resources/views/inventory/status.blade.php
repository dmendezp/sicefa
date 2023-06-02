@extends('ptventa::layouts.master')
<style type="text/css">
    
    .table-status{
        top:20px;
        width:600px;
        float: left;
        margin-right: 18px;
        

    }

    .table-status{
        top:20px;
        width:650px;
        float: left;
        margin-right: 28px;
        
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
                    <div style="overflow-y: auto; height: 400px;">
                    <table class="table table-hover" id="status-table">
                    <h6 class="text-center bg-success py-1 rounded-2"><strong>VENCIDOS</strong></h6>
                        <thead class="table-dark">
                            <thead>
                                <tr>
                                <th class="text-center">Cantidad</th>
                                    <th class="text-center">Productos</th>
                                    <th class="text-center">Fecha</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                    @foreach ($productosVencidos as $producto)
                                    <tr>
                                    <td><strong>{{ $producto->amount}}</strong></td>
                                    <td><strong>{{ $producto->element->name }}</strong></td>
                                    <td class="text-center">{{ $producto->expiration_date }}</td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </thead>
                        </table>
                    </div>
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
                    <div style="overflow-y: auto; height: 400px;">
                    <table class="table table-hover" id="status-table">
                    <h6 class="text-center bg-success py-1 rounded-2"><strong>POR VENCER</strong></h6>
                        <thead class="table-dark">
                            <thead>
                                <tr>
                                <th class="text-center">Cantidad</th>
                                    <th class="text-center">Productos</th>
                                    <th class="text-center">Fecha</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                    @foreach ($productosPorVencer as $producto)
                                <tr>
                                    <td><strong>{{ $producto->amount}}</strong></td>
                                    <td><strong>{{ $producto->element->name }}</strong></td>
                                    <td class="text-center">{{ $producto->expiration_date }}</p>
                                </tr>

                                    @endforeach
                            </tbody>
                        </thead>
                    </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@include('ptventa::layouts.partials.plugins.datatables')

