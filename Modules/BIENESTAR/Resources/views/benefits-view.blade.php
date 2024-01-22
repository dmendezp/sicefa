@php
    $role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
@endphp
@extends('bienestar::layouts.master')

@section('content')
<!-- Main content -->
<div class="container-fluid">
    <h1 class="mb-4">{{ trans('bienestar::menu.Benefits')}}
        <i class="fas fa-handshake"></i>
    </h1>
    <div class="row justify-content-md-center pt-4">
        <div class="card shadow col-md-8">
            <div class="card-body">
                @if (Auth::user()->havePermission('bienestar.'.$role_name.'.save.benefits'))
                <form action="{{ route('bienestar.'.$role_name.'.save.benefits')}}" method="post" onsubmit="return validarFormulario()" class="formGuardar">
                    @csrf
                    <div class="row align-items-center p-4">
                        <div class="col-md-3">
                            <label for="text1">{{ trans('bienestar::menu.Name')}}</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-md-3">
                            <label for="number1">{{ trans('bienestar::menu.Porcentege')}}</label>
                            <input type="number" class="form-control" id="porcentaje" min="0" max="100" placeholder="Ej: 75" name="porcentege" required>
                        </div>
                        <div class="col-md-2 align-self-end">
                            <div class="btns mt-3">
                                <button class="btn btn-success btn-block" type="submit">{{ trans('bienestar::menu.Save')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
                @endif
                <div class="mtop16">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{ trans('bienestar::menu.Name')}}</th>
                                <th>{{ trans('bienestar::menu.Porcentege')}}</th>
                                <th>{{ trans('bienestar::menu.Actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($benefits as $benefit)
                            <tr>
                                <td>{{ $benefit->id }}</td>
                                <td>{{ $benefit->name }}</td>
                                <td>{{ $benefit->porcentege }}</td>
                                <td>
                                    @if (Auth::user()->havePermission('bienestar.admin.buttons.benefits'))
                                    <div class="d-flex">
                                        <!-- Botones de acciones CRUD (Editar, Eliminar, etc.) -->
                                        <button class="btn btn-primary editButton mr-2" data-id="{{ $benefit->id }}" data-name="{{ $benefit->name }}" data-porcentege="{{ $benefit->porcentege }}" data-toggle="modal" data-target="#editModal-{{ $benefit->id }}"><i class="fas fa-edit"></i></button>

                                        <!-- Modal para la edición -->
                                        <div class="modal fade" id="editModal-{{ $benefit->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <!-- Contenido del modal de edición aquí -->
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">{{ trans('bienestar::menu.Edit Benefit')}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @if (Auth::user()->havePermission('bienestar.'.$role_name.'.edit.benefits'))
                                                        <form id="editForm-{{ $benefit->id }}" action="{{ route('bienestar.'.$role_name.'.edit.benefits', ['id' => $benefit->id]) }}" method="post" class="formEditar">
                                                            @csrf
                                                            @method('PUT')
                                                            <!-- Campos de edición aquí -->
                                                            <input type="hidden" name="id" value="{{ $benefit->id }}">
                                                            <div class="form-group">
                                                                <label for="editName-{{ $benefit->id }}">{{ trans('bienestar::menu.Name')}}</label>
                                                                <input type="text" class="form-control" id="editName-{{ $benefit->id }}" name="name" required pattern="[A-Za-z ]+">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="editPorcentaje-{{ $benefit->id }}">{{ trans('bienestar::menu.Porcentege')}}</label>
                                                                <input type="number" class="form-control" id="editPorcentaje-{{ $benefit->id }}" min="0" max="100" name="porcentege">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('bienestar::menu.Close')}}</button>
                                                                <button type="submit" form="editForm-{{ $benefit->id }}" class="btn btn-primary">{{ trans('bienestar::menu.Save')}}</button>
                                                            </div>
                                                            <!-- Botón para guardar cambios -->
                                                        </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if (Auth::user()->havePermission('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.delete.benefits'))
                                        <form action="{{ route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.delete.benefits', ['id' => $benefit->id]) }}" method="POST" class="formEliminar">
                                            @csrf
                                            @method("DELETE")
                                            <!-- Botón para abrir el modal de eliminación -->
                                            <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                        @endif
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<script>
    $(document).ready(function() {
        // Configura el evento para llenar el formulario de edición
        $('.editButton').on('click', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var porcentege = $(this).data('porcentege');

            $('#editName-' + id).val(name);
            $('#editPorcentaje-' + id).val(porcentege);
        });

        // Configura el evento input para el campo "Nombre"
        // Configura el evento input para el campo "Nombre"
        $('#name').on('input', function() {
            var name = $(this).val();

            // Verifica que el campo "Nombre" solo contenga letras
            if (!/^[A-Za-z]+$/.test(name)) {
                Swal.fire({
                    title: 'Alerta',
                    text: 'El campo Nombre solo debe contener letras',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                }); // Borra cualquier carácter no válido
            }
        });


        // Configura el evento input para el campo "Porcentaje"
        $('#porcentaje').on('input', function() {
            var porcentaje = $(this).val();

            if (porcentaje < 0 || porcentaje > 100) {
                alert('El campo Porcentaje debe ser un número entre 0 y 100');
                // Borra cualquier número fuera de rango
            }

            // Limita la longitud del campo a 3 caracteres
            if (porcentaje.length > 3) {
                $(this).val(porcentaje.slice(0, 3));
            }
        });


    });

    function validarFormulario() {
        var name = document.getElementById('name').value;
        var porcentaje = document.getElementById('porcentaje').value;

        if (name.trim() === '') {
            alert('El campo Nombre no puede estar vacío');
            return false; // Evita que se envíe el formulario
        }

        if (porcentaje < 0 || porcentaje > 100) {
            alert('El campo Porcentaje debe ser un número entre 0 y 100');
            return false; // Evita que se envíe el formulario
        }

        return true; // Envía el formulario si todo está correcto
    }

    function validarFormularioEdit() {
        var nameInput = document.getElementById('editName');
        var porcentaje = document.getElementById('editPorcentaje').value;

        if (nameInput.type !== 'text') {
            alert('El campo Nombre debe ser un campo de texto');
            return false; // Evita que se envíe el formulario
        }

        var name = nameInput.value;

        if (name.trim() === '') {
            alert('El campo Nombre no puede estar vacío');
            return false; // Evita que se envíe el formulario
        }

        if (!/^[A-Za-z]+$/.test(name)) {
            alert('El campo Nombre solo puede contener letras');
            nameInput.value = ''; // Borra cualquier carácter no válido
            return false; // Evita que se envíe el formulario
        }

        if (porcentaje < 0 || porcentaje > 100) {
            alert('El campo Porcentaje debe ser un número entre 0 y 100');
            return false; // Evita que se envíe el formulario
        }

        return true; // Envía el formulario si todo está correcto
    }
</script>

@endsection