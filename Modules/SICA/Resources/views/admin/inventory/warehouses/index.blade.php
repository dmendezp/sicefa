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
                            <a href="" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Registrar bodega
                            </a>
                        </div>
                        <div class="mtop16">
                            <table id="example1" class="table table-bordered table-striped">
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
                                                <div class="opts">
                                                    <a href="" data-toggle='tooltip' data-placement="top" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a class="btn-delete" href="#" data-action="delete" data-toggle='tooltip' data-placement="top" title="Eliminar">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </div>
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
