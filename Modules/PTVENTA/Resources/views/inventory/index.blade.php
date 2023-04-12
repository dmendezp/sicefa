@extends('ptventa::layouts.master')

@section('breadcrumb')
    {{-- The breadcrumb is the tracking af the displayed view --}}
    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Inventario</a></li>
    <li class="breadcrumb-item active">Página principal</li>
@endsection

@section('content')

<div class="row mx-3">
    <div class="col-md-3">
        <div class="card mb-3">
            <div class="card-header text-bg-success text-center">Detalle del Registro</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="person">Encargado:</label>
                    <input type="text" class="form-control" id="person" name="person" disabled>
                </div>
                <div class="form-group">
                    <label for="warehouse">Bodega:</label>
                    <input type="text" class="form-control" id="warehouse" name="warehouse" disabled>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9 h-100">
        <div class="row mx-3 align-items-end">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="producto">Producto:</label>
                    <input type="text" class="form-control" id="producto" name="producto">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input type="number" class="form-control" id="precio" name="precio">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" class="form-control" id="precio" name="precio">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="fechaProduccion">Fecha de Producción:</label>
                    <input type="date" class="form-control" id="fechaProduccion" name="fechaProduccion">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="numeroLote">Número de lote:</label>
                    <input type="number" class="form-control" id="numeroLote" name="numeroLote">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="fechaExpiracion">Fecha de Expiración:</label>
                    <input type="date" class="form-control" id="fechaExpiracion" name="fechaExpiracion">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="marca">Marca:</label>
                    <input type="text" class="form-control" id="marca" name="marca">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="descripcion">Observación:</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="codInventario">Código de Inventario:</label>
                    <input type="number" class="form-control" id="codInventario" name="codInventario">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <div class="input-group">
                        <button type="button" class="btn btn-success form-control text-truncate">Guardar Todo <i class="fas fa-save"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mx-3">
    <div class="card shadow-sm">
        <div class="col-md-12 h-100">
            <div class="card-body">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Marca (Producto)</th>
                            <th scope="col" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Código de Inventario"><i class="fas fa-barcode"></i></th>
                            <th scope="col" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Observación"><i class="far fa-file-alt"></i></th>
                            <th scope="col">Precio</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Fecha Producción</th>
                            <th scope="col">Núm Lote</th>
                            <th scope="col">Fecha Expiración</th>
                            <th scope="col" class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Acciones"><i class="fas fa-arrow-circle-down"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Yogurt Alpine</td>
                            <td><i class="fas fa-times text-danger"></i></td>
                            <td><i class="fas fa-check text-success"></i></td>
                            <td>$ 1.200</td>
                            <td>16</td>
                            <td>11/04/23</td>
                            <td>340-FCH</td>
                            <td>15/06/23</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-outline-info btn-sm py-0" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Ver a detalle el producto">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button type="button" class="btn btn-outline-danger btn-sm py-0" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Eliminar Producto">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Croquetas</td>
                            <td><i class="fas fa-check text-success"></i></td>
                            <td><i class="fas fa-times text-danger"></i></td>
                            <td>$ 2.200</td>
                            <td>20</td>
                            <td>14/04/23</td>
                            <td>355-GCH</td>
                            <td>17/06/23</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-outline-info btn-sm py-0" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Ver a detalle el producto">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button type="button" class="btn btn-outline-danger btn-sm py-0" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Eliminar Producto">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </td>
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