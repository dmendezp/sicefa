@extends('gth::layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">{{ trans('gth::menu.Attendance View') }}</h1>
            <p class="lead">{{ trans('gth::menu.Welcome to the attendance page. Here you can view and manage employee attendance.') }}</p>

            <div class="card">
                <div class="card-header">
                    {{ trans('gth::menu.List of Attendance') }}
                </div>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agregarAsistenciaModal">{{ trans('gth::menu.Add Attendance') }}</button>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>{{ trans('gth::menu.ID') }}</th>
                                <th>{{ trans('gth::menu.Name') }}</th>
                                <th>{{ trans('gth::menu.Date') }}</th>
                                <th>{{ trans('gth::menu.Status') }}</th>
                                <th>{{ trans('gth::menu.actions') }}</th> <!-- Agregamos esta columna para las acciones -->
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Juan Pérez</td>
                                <td>2023-08-12</td>
                                <td><span class="badge bg-success">Presente</span></td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm">{{ trans('gth::menu.Edit') }}</a>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminarAsistenciaModal">{{ trans('gth::menu.Delete') }}</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>María López</td>
                                <td>2023-08-12</td>
                                <td><span class="badge bg-warning text-dark">Ausente</span></td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm">{{ trans('gth::menu.Edit') }}</a>
                                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminarAsistenciaModal">{{ trans('gth::menu.Delete') }}</button>
                                            </td>
                            </tr>
                            <!-- Agrega más filas de datos aquí -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="agregarAsistenciaModal" tabindex="-1" aria-labelledby="agregarAsistenciaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarAsistenciaModalLabel">{{ trans('gth::menu.Add Attendance') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cefa.attendance.view') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label">{{ trans('gth::menu.Name') }}</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha" class="form-label">{{ trans('gth::menu.Date') }}</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" required>
                    </div>
                    <div class="mb-3">
                        <label for="estado" class="form-label">{{ trans('gth::menu.Status') }}</label>
                        <select class="form-select" id="estado" name="estado" required>
                            <option value="presente">Presente</option>
                            <option value="ausente">Ausente</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ trans('gth::menu.Save') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal para Eliminar Asistencia -->
<div class="modal fade" id="eliminarAsistenciaModal" tabindex="-1" aria-labelledby="eliminarAsistenciaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarAsistenciaModalLabel">{{ trans('gth::menu.Confirm Deletion') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>{{ trans('gth::menu.¿Are you sure you want to delete this attendance?') }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('gth::menu.Cancel') }}</button>
                <form action="#" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ trans('gth::menu.Delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Editar Asistencia -->
<div class="modal fade" id="editarAsistenciaModal" tabindex="-1" aria-labelledby="editarAsistenciaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarAsistenciaModalLabel">{{ trans('gth::menu.Edit Attendance') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nombre" class="form-label">{{ trans('gth::menu.Name') }}</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="Juan Pérez">
                    </div>
                    <div class="mb-3">
                        <label for="fecha" class="form-label">{{ trans('gth::menu.Date') }}</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" value="2023-08-12">
                    </div>
                    <div class="mb-3">
                        <label for="estado" class="form-label">{{ trans('gth::menu.Status') }}</label>
                        <select class="form-select" id="estado" name="estado">
                            <option value="presente">Presente</option>
                            <option value="ausente">Ausente</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ trans('gth::menu.Save Changes') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
