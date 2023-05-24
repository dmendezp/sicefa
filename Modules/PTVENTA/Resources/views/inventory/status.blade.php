@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">Productos</li>
    <li class="breadcrumb-item active">Estado de productos </li>
@endpush

@section('content')
<div class="card card-success card-outline shadow-sm">
        <div class="card-body">
            <div class="row bg-light">
                <div class="col-auto">
                    <i class="fas fa-search"></i>
                    <label class="form-label-sm">Productos: </label>
                </div>
<div class="col-auto pe-2">
                    <a href="{{ route('ptventa.inventory.status') }}" class="btn btn-success btn-sm"> Registro de bajas </a>
                </div> 
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
            <table class="table">
            <h6 class="text-center bg-secondary py-1 rounded-2"><strong>VENCIDOS</strong></h6>
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
                            <td>Mark</td>
                            <td>Otto</td>
                        </tr>
                    </tbody>
                </table>
             </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <h6 class="text-center bg-secondary py-1 rounded-2"><strong>POR VENCER </strong></h6>
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
                                                <td>Mark</td>
                                                <td>Otto</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection

@include('ptventa::layouts.partials.plugins.datatables')