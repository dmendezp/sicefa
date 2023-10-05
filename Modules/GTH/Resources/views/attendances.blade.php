@extends('gth::layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Vista Asistencia</h1>
            <p class="lead">Bienvenido a la página de asistencia. Aquí podrás ver y gestionar la asistencia de los empleados.</p>

            <div class="card">
                <div class="card-header">
                    Lista de Asistencia
                </div>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agregarAsistenciaModal">Agregar Asistencia</button>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Nombre</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th>Acciones</th> <!-- Agregamos esta columna para las acciones -->
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Juan Pérez</td>
                                <td>2023-08-12</td>
                                <td><span class="badge bg-success">Presente</span></td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm">Editar</a>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminarAsistenciaModal">Eliminar</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>María López</td>
                                <td>2023-08-12</td>
                                <td><span class="badge bg-warning text-dark">Ausente</span></td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm">Editar</a>
                                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminarAsistenciaModal">Eliminar</button>
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
                <h5 class="modal-title" id="agregarAsistenciaModalLabel">Agregar Asistencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cefa.attendance.view') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" required>
                    </div>
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <select class="form-select" id="estado" name="estado" required>
                            <option value="presente">Presente</option>
                            <option value="ausente">Ausente</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
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
                <h5 class="modal-title" id="eliminarAsistenciaModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar esta asistencia?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="#" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
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
                <h5 class="modal-title" id="editarAsistenciaModalLabel">Editar Asistencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="Juan Pérez">
                    </div>
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" value="2023-08-12">
                    </div>
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <select class="form-select" id="estado" name="estado">
                            <option value="presente">Presente</option>
                            <option value="ausente">Ausente</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
