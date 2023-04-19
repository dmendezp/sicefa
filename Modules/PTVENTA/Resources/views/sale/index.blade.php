@extends('ptventa::layouts.master')

@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('breadcrumb')
    {{-- The breadcrumb is the tracking af the displayed view --}}
    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Ventas</a></li>
    <li class="breadcrumb-item active">Página principal</li>
@endsection

@section('content')
    <div class="row mx-3">
        <div class="col-md-5">
            <div class="form-group">
                <label for="producto">Producto:</label>
                <input type="text" class="form-control" id="producto" name="producto">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="producto">Cantidad:</label>
                <input type="number" class="form-control" id="precio" name="precio">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" class="form-control" id="precio" name="precio">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="subtotal">Subtotal:</label>
                <input type="number" class="form-control" id="subtotal" name="subtotal">
            </div>
        </div>
    </div>

    <div class="row mx-3">
        <div class="col-md-9 h-100">
            <div class="card shadow-sm">
                <div class="card-body">
                    <table id="element">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-outline-warning btn-sm py-0" data-toggle="tooltip"
                                        data-placement="top" title="Actualizar producto">
                                        <i class="fas fa-pen-alt"></i>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger btn-sm py-0" data-toggle="tooltip"
                                        data-placement="top" title="Eliminar producto">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-outline-warning btn-sm py-0" data-toggle="tooltip"
                                        data-placement="top" title="Actualizar producto">
                                        <i class="fas fa-pen-alt"></i>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger btn-sm py-0" data-toggle="tooltip"
                                        data-placement="top" title="Eliminar producto">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-outline-warning btn-sm py-0" data-toggle="tooltip"
                                        data-placement="top" title="Actualizar producto">
                                        <i class="fas fa-pen-alt"></i>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger btn-sm py-0" data-toggle="tooltip"
                                        data-placement="top" title="Eliminar producto">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-outline-warning btn-sm py-0" data-toggle="tooltip"
                                        data-placement="top" title="Actualizar producto">
                                        <i class="fas fa-pen-alt"></i>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger btn-sm py-0" data-toggle="tooltip"
                                        data-placement="top" title="Eliminar producto">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-header text-bg-success text-center">Cliente</div>
                <div class="card-body">
                    <h5 class="card-title">Success card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Detalle de venta actual</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                        <div class="text-center">

                            <button class="btn btn-primary"><i class="far fa-plus-square"></i> Registrar Venta</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script>
    let table = new DataTable('#element', {
});
</script>

@endsection