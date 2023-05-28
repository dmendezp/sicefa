@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">
        <a href="{{ route('ptventa.inventory.index') }}" class="text-decoration-none">Inventario</a>
    </li>
    <li class="breadcrumb-item active">Estado de productos </li>
@endpush

@section('content')

<div class="card-body">
    <div class="row bg-light">
        <div class="col-auto">
            <label class="form-label-sm">PRODUCTOS </label>
        </div>
        <div class="col"></div>
        <div class="col-auto pe-2">
            <a href="{{ route('ptventa.inventory.low') }}" class="btn btn-success btn-sm"> Registro de bajas </a>
        </div>
    </div>
    <hr>
    <h6 class="text-center bg-black py-1 rounded-2"><strong>Todos los productos</strong></h6>
    <div class="table-responsive">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover" id="inventories-table">
                        <h6 class="text-center bg-black py-1 rounded-2"><strong>VENCIDOS</strong></h6>
                        <div class="table-responsive">
                            <table class="table table-hover" id="inventories-table">
                                <thead class="table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
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
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6 text-right">
                    <div class="col-auto pe-2">
                        <div class="card">
                            <div class="card-body">
                                <table class="table">
                                    <h6 class="text-center bg-black py-1 rounded-2"><strong>POR VENCER </strong></h6>
                                    <div class="table-responsive style="max-height: 500px">
                                    <table class="table table-hover">
                                        <thead class="table-dark"></thead>
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th class="text-center">Productos</th>
                                                <th class="text-center">Fecha</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-group-divider">
                                            <tr>
                                            @foreach ($productosVencidos as $producto)
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
