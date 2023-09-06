@extends('bienestar::layouts.adminlte')

@section('content')
<!-- Main content -->
<div class="container-fluid">
    <div class="row justify-content-md-center pt-4">
        <div class="card card-green card-outline shadow col-md-8">
            <div class="card-header">
                <h3 class="card-title">Beneficios</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route('bienestar.benefits.add')}}" method="post">
                    @csrf
                    <div class="row p-4">
                        <div class="col-md-3">
                            <label for="text1">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="col-md-3">
                            <label for="number1">Porcentaje</label>
                            <input type="number" class="form-control" id="porcentege" min="0" max="100" placeholder="Ej: 75" name="porcentege">
                        </div>
                        <!-- Botón verde -->
                        <button class="btn btn-success" type="submit">Guardar</button>
                    </div>
                </form>
                <div class="mtop16">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Porcentaje</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $benefits as $benefit )
                            <tr>
                                <td>{{ $benefit->id }}</td>
                                <td>{{ $benefit->name }}</td>
                                <td>{{ $benefit->porcentege }}</td>
                                <td>
                                    <!-- Botones de acciones CRUD (Editar, Eliminar, etc.) -->
                                    <button class="btn btn-primary editButton" data-id="{{ $benefit->id }}" data-name="{{ $benefit->name }}" data-porcentege="{{ $benefit->porcentege }}" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></button>
                                    <!-- Botón para abrir el modal de eliminación -->
                                    <button class="btn btn-danger deleteButton" data-id="{{ $benefit->id }}" data-toggle="modal" data-target="#deleteModal{{ $benefit->id }}"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            <!-- Modal para la eliminación -->
                            <div class="modal fade" id="deleteModal{{ $benefit->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Contenido del modal de eliminación aquí -->
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Eliminar Beneficio</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>¿Estás seguro de que deseas eliminar este beneficio?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <form id="deleteForm" action="{{ route('bienestar.benefits.delete', ['id' => $benefit->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                                        <!-- Modal para la edición -->
                            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Contenido del modal de edición aquí -->
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Editar Beneficio</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="editForm" action="{{ route('bienestar.benefits.update', ['id' => $benefit->id]) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <!-- Campos de edición aquí -->
                                                <div class="form-group">
                                                    <label for="editName">Nombre</label>
                                                    <input type="text" class="form-control" id="editName" name="name" required pattern="[A-Za-z ]+">
                                                </div>
                                                <div class="form-group">
                                                    <label for="editPorcentaje">Porcentaje</label>
                                                    <input type="number" class="form-control" id="editPorcentaje" min="0" max="100" name="porcentege">
                                                </div>
                                                <!-- Botón para guardar cambios -->
                                                <button type="submit" form="editForm" class="btn btn-primary">Guardar Cambios</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>



<script>
    $(document).ready(function() {
        // Configura el evento para llenar el formulario de edición
        $('.editButton').on('click', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var porcentege = $(this).data('porcentege');

            $('#editName').val(name);
            $('#editPorcentaje').val(porcentege);
        });
    });
</script>
@endsection