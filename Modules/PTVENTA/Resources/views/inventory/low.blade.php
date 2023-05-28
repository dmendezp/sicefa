@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">
        <a href="{{ route('ptventa.inventory.index') }}" class="text-decoration-none">Inventario</a>
    </li>
    <li class="breadcrumb-item active">Registrar baja</li>
@endpush

@section('content')
    <div class="card card-success card-outline shadow-sm">
        <div class="card-body">
            <div class="row bg-light">
                <div class="col-auto">
                    <i class="fas fa-search"></i>
                    <label class="form-label-sm">Registro de bajas</label>
                </div>
                <div class="col-auto">
                </div>

            <hr>
            <h6 class="text-center bg-secondary py-1 rounded-2"><strong>Todos los productos</strong></h6>
            <div class="table-responsive">
                <table class="table table-hover" id="inventories-table">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">Producto</th>
                            <th class="text-center">Categoría</th>
                            <th class="text-center">Precio Unitario</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">F.Vencimiento</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">

                            <td class="text-center">yogurt mora</td>
                            <td class="text-center">Lacteos</td>
                            <td class="text-center">1200</td>
                            <td class="text-center">3</td>
                            <td class="text-center">21/25/2023</td>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@include('ptventa::layouts.partials.plugins.datatables')
