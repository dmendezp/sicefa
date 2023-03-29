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

                <div class="col text-end">
                    <button type="button" class="btn btn-success btn-md shadow"><i class="fas fa-plus"></i> Agregar</button>
                </div>
            </div>
        </div>
    </div>


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
                                <th scope="col">Cantidad</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Fecha de Ingreso</th>
                                <th scope="col">Fecha de Vencimiento</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">09098</th>
                                <td>Yogurt Riquisimo</td>
                                <td>Lt</td>
                                <td>2</td>
                                <td>$ 2.500</td>
                                <td>Disponible</td>
                                <td>20/04/2023</td>
                                <td>20/06/2023</td>
                            </tr>
                            <tr>
                                <th scope="row">09098</th>
                                <td>Yogurt Riquisimo</td>
                                <td>Lt</td>
                                <td>2</td>
                                <td>$ 2.500</td>
                                <td>Disponible</td>
                                <td>20/04/2023</td>
                                <td>20/06/2023</td>
                            </tr>
                            <tr>
                                <th scope="row">09098</th>
                                <td>Yogurt Riquisimo</td>
                                <td>Lt</td>
                                <td>2</td>
                                <td>$ 2.500</td>
                                <td>Disponible</td>
                                <td>20/04/2023</td>
                                <td>20/06/2023</td>
                            </tr>
                            <tr>
                                <th scope="row">09098</th>
                                <td>Yogurt Riquisimo</td>
                                <td>Lt</td>
                                <td>2</td>
                                <td>$ 2.500</td>
                                <td>Disponible</td>
                                <td>20/04/2023</td>
                                <td>20/06/2023</td>
                            </tr>
                            <tr>
                                <th scope="row">09098</th>
                                <td>Yogurt Riquisimo</td>
                                <td>Lt</td>
                                <td>2</td>
                                <td>$ 2.500</td>
                                <td>Disponible</td>
                                <td>20/04/2023</td>
                                <td>20/06/2023</td>
                            </tr>
                            <tr>
                                <th scope="row">09098</th>
                                <td>Yogurt Riquisimo</td>
                                <td>Lt</td>
                                <td>2</td>
                                <td>$ 2.500</td>
                                <td>Disponible</td>
                                <td>20/04/2023</td>
                                <td>20/06/2023</td>
                            </tr>
                            <tr>
                                <th scope="row">09098</th>
                                <td>Yogurt Riquisimo</td>
                                <td>Lt</td>
                                <td>2</td>
                                <td>$ 2.500</td>
                                <td>Disponible</td>
                                <td>20/04/2023</td>
                                <td>20/06/2023</td>
                            </tr>
                            <tr>
                                <th scope="row">09098</th>
                                <td>Yogurt Riquisimo</td>
                                <td>Lt</td>
                                <td>2</td>
                                <td>$ 2.500</td>
                                <td>Disponible</td>
                                <td>20/04/2023</td>
                                <td>20/06/2023</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

  
@endsection
