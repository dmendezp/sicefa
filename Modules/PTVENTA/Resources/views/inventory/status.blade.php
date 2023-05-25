@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">Productos</li>
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
                                                        <td scope="col">1</td>
                                                        <td class="text-center">Yogur de fresa</td>
                                                        <th class="text-center">25/05/23</th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                    </div>
                                </div>
                                </div>
                                </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card ">
                                        <div class="card-body">
                                            <table class="table">
                                                <h6 class="text-center bg-black py-1 rounded-2"><strong>POR VENCER </strong></h6>
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
                                                                <td scope="col">1</td>
                                                                <td class="text-center">Queso Doble Crema</td>
                                                                <th class="text-center">30/05/23</th>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
    
@endsection

@include('ptventa::layouts.partials.plugins.datatables')