@extends('cafeto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('cafeto.inventory.index') }}" class="text-decoration-none">Inventario</a></li>
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
                        <a href="{{ route('cafeto.inventory.create') }}" class="btn btn-success btn-sm me-1">
                            <i class="fa-solid fa-thumbs-up mr-2"></i>Registrar entrada
                        </a>
                        {{-- <a href="" class="btn btn-danger btn-sm me-1">
                            <i class="fa-solid fa-thumbs-down mr-2"></i>Registrar baja
                        </a> --}}
                        {{-- <a href="" class="btn btn-danger btn-sm me-1">PDF</a>--}}
                        <a href="" class="btn btn-secondary btn-sm">
                            <i class="fa-solid fa-triangle-exclamation mr-2"></i>Vencidos / Por vencer
                        </a>
                    </div>
                </div>

            <hr>

            <div class="table-responsive" data-aos="zoom-in">
                <table class="table table-hover" id="inventories-table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">N°</th>
                            <th>Producto</th>
                            <th class="text-center">Categoría</th>
                            <th class="text-center">Precio Unitario</th>
                            <th class="text-center">Stock</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                      
                            <tr>
                                <th scope="row"></th>
                                <td><strong></strong></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                    
                                        <b class="bg-success rounded-5 ps-2 pe-2" style="font-size: 12px;">Disponible</b>
                                    
                                        <b class="bg-gradient-dark rounded-5 ps-2 pe-2" style="font-size: 12px;">No disponible</b>
                                    
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-outline-secondary btn-sm py-0" title="Ver detalles">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
