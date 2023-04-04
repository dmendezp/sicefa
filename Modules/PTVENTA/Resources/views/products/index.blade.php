@extends('ptventa::layouts.master')

@section('breadcrumb')
    {{-- The breadcrumb is the tracking af the displayed view --}}
    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Ventas</a></li>
    <li class="breadcrumb-item active">Página principal</li>
@endsection

@section('content')

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row mx-3">
                <div class="col-auto">
                    <label class="col-form-label">Buscar por: </label>
                </div>
                <div class="col-auto">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Selecciona...</option>
                        <option value="1">Disponibles</option>
                        <option value="2">Productos por vencer</option>
                        <option value="3">Productos vencidos</option>
                      </select>
                </div>
            </div>
        </div>
    </div>

    @foreach ($product as $p)
    <div class="row mx-3">
        <div class="col-md-12 h-100">
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Cod Producto</th>
                                <th scope="col">Nombre del producto</th>
                                <th scope="col">Unidad de medida</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Tipo de compra</th>
                                <th scope="col">Categoria</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">09098</th>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->measurement_unit->name }}</td>
                                <td>{{ $p->description }}</td>
                                <td>{{ $p->kind_of_purchase->name }}</td>
                                <td>{{ $p->category->name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection

@section('scripts')

  
@endsection
