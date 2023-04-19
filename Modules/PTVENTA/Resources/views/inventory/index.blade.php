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
    <div class="card card-success card-outline shadow-sm">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-auto">
                    <i class="fas fa-search"></i>
                    <label class="form-label-sm">Buscar por: </label>
                </div>
                <div class="col-auto">
                    <select class="form-select form-select-sm" aria-label="Default select example">
                        <option selected>Selecciona ...</option>
                        <option value="1">Disponibles</option>
                        <option value="2">Productos por vencer</option>
                        <option value="3">Productos vencidos</option>
                    </select>
                </div>
                <div class="col"></div>
                <div class="col-auto">
                    <a href="{{ route('ptventa.inventory.create') }}" class="btn btn-success btn-sm"> Registrar </a>
                </div>
            </div>

            <hr>

            <table id="inventory">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Producto</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Cantidad Existente</th>
                        <th scope="col">Cantidad minima</th>
                        <th scope="col">Estado</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        let table = new DataTable('#inventory', {});
    </script>
@endsection
