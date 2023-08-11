@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Bodegas</h3>
                    </div>
                    <div class="card-body">
                        <div class="btns">
                            <a href="{{ route('sica.admin.inventory.warehouse.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Registrar bodega
                            </a>
                        </div>
                        <div class="mtop16">
                            <table id="warehouses_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Aplicación </th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($warehouses as $w)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $w->name }}</td>
                                            <td>{{ $w->description }}</td>
                                            <td>{{ $w->app->name }}</td>
                                            <td>
                                                <a href="{{ route('sica.admin.inventory.warehouse.edit', $w) }}" data-toggle='tooltip' data-placement="top" title="Editar">
                                                    <i class="fas fa-edit text-success"></i>
                                                </a>
                                                <a href="{{ route('sica.admin.inventory.warehouse.destroy', $w) }}" data-toggle='tooltip' data-placement="top" title="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar esta bodega?')">
                                                    <i class="fas fa-trash-alt text-danger"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function () {
            $("#warehouses_table").DataTable({
                "responsive": true
            });
        });
    </script>
@endsection
