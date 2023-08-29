@extends('bienestar::layouts.adminlte')

@section('content')
<div class="card w-100 mx-auto">
    <div class="card-body">
    <div class="row">
    <div class="col-md-6 mx-auto">
                <!-- Aquí puedes colocar tu tabla CRUD, por ejemplo: -->
                <table class="table table-bordered">
                    <!-- Encabezados de la tabla -->
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Porcentaje</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <!-- Datos de la tabla -->
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
                                <button class="btn btn-danger deleteButton" data-id="{{ $benefit->id }}" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash-alt"></i></button>

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
                                                <!-- Formulario de edición aquí -->
                                                <!-- Formulario de edición aquí -->
                                            <form id="editForm" action="{{ route('bienestar.benefits.update', ['id' => $benefit->id]) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <!-- Campos de edición aquí -->
                                                <div class="form-group">
                                                    <label for="editName">Nombre</label>
                                                    <input type="text" class="form-control" id="editName" name="name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="editPorcentaje">Porcentaje</label>
                                                    <input type="number" class="form-control" id="editPorcentaje" name="porcentege">
                                                </div>                     
                                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>                   
                                            </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal para la eliminación -->
                                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    <div class="col-md-4 mx-auto">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Agregar Beneficios</h3>
            </div>
            <div class="card-body">
                <!-- Primer campo de texto -->
                <form action="{{ route('bienestar.benefits.add')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="text1">Nombre</label>
                    <input type="text" class="form-control" id="text1" name="name" id="name">
                </div>
                
                <!-- Segundo campo de texto (solo números, sin fechas) -->
                <div class="form-group">
                    <label for="number1">Porcentaje</label>
                    <input type="number" class="form-control" id="number1" min="0" placeholder="Ej: 75" name="porcentege" id="porcentege">
                </div>
                
                <!-- Botón verde -->
                <button class="btn btn-success" type="submit">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
    </div>

</div>

<script>
    $(document).ready(function () {
        // Manejar el evento de hacer clic en el botón de editar
        $('.editButton').click(function () {
            // Obtener los datos del beneficio
            var id = $(this).data('id');
            var name = $(this).data('name');
            var porcentege = $(this).data('porcentege');
            
            // Llenar el formulario de edición con los datos del beneficio
            $('#editModal #editForm #editName').val(name);
            $('#editModal #editForm #editPorcentaje').val(porcentege);

        });


        // Manejar el evento de hacer clic en el botón de eliminar
        $('.deleteButton').click(function () {
            // Obtener el ID del beneficio a eliminar
            var id = $(this).data('id');

            // Agregar el ID al botón de confirmación de eliminación
            $('#deleteButton').attr('data-id', id);
        });

        // Manejar el evento de hacer clic en el botón de confirmación de eliminación
        $('#deleteButton').click(function () {
            // Obtener el ID del beneficio a eliminar
            var id = $(this).data('id');

            // Realizar la eliminación utilizando AJAX o un formulario POST
            // Aquí puedes enviar la solicitud de eliminación al servidor

            // Cerrar el modal de eliminación
            $('#deleteModal').modal('hide');
        });
    });
</script>

@endsection
