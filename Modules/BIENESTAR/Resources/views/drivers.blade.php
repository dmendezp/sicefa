@extends('bienestar::layouts.adminlte')

@section('content')
<div class="container-fluid">
    <!-- Alerta de guardado exitoso -->
    <div class="alert alert-success col-md-12 text-center" style="display: none;">
        Guardado exitoso.
    </div>
    <!-- Alerta de eliminación exitosa -->
    <div class="alert alert-danger col-md-12 text-center" style="display: none;">
        Eliminación exitosa.
    </div>
    <!-- Resto de tu contenido aquí -->
</div>
<!-- Main content -->
<div class="container-fluid">
    <div class="row justify-content-md-center pt-4">
        <div class="card card-green card-outline shadow col-md-10">
            <div class="card-header">
                <h3 class="card-title">{{ __('Agregar conductores') }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- Alerta de guardado exitoso -->
                <div class="alert alert-success col-md-12 text-center" style="display: none;">
                    Guardado exitoso.
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <form action="{{ route('bienestar.drivers.add') }}" method="POST" onsubmit="return validarFormulario()">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-3 mb-2">
                                    <input type="text" placeholder="Conductor (Nombres/Apellidos)" class="form-control" name="namedriver" id="namedriver" required oninput="validarNombre()">

                                    <span id="nombreError" style="color: red;"></span>
                                </div>

                                <div class="col-md-3 mb-2">
                                    <input type="text" placeholder="Email" class="form-control" name="email" id="email" required oninput="validarEmail()">

                                    <span id="emailError" style="color: red;"></span>
                                </div>

                                <div class="col-md-3 mb-2">
                                    <input type="text" placeholder="Teléfono" class="form-control" name="phone" id="phone" required oninput="validarTelefono()">
                                    <span id="telefonoError" style="color: red;"></span>
                                </div>

                                <div class="col-md-3 mb-2">
                                    <button type="submit" class="btn btn-success btn-block">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Conductor</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Aquí deberías iterar sobre los conductores y llenar las filas de la tabla -->
                            @foreach($busdrivers as $busdriver)
                            <tr>
                                <td>{{ $busdriver->name }}</td>
                                <td>{{ $busdriver->email }}</td>
                                <td>{{ $busdriver->phone }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-info" data-toggle="modal" data-target="#modal-edit-{{ $busdriver->id }}"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#modal-delete-{{ $busdriver->id }}"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal para editar conductor -->
                            <div class="modal fade" id="modal-edit-{{ $busdriver->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Editar Conductor</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Aquí puedes agregar los campos de edición para el conductor -->
                                            <form action="{{ route('bienestar.drivers.update', ['id' => $busdriver->id]) }}" method="POST" onsubmit="return validarFormularioEditar()">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="driver_name">Nombre del Conductor</label>
                                                    <input type="text" class="form-control" id="nameEditar" name="name" value="{{ $busdriver->name }}" required oninput="validarNombreEditar()">
                                                    <span id="nombreErrorEditar" style="color: red;"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="driver_email">Email Conductor</label>
                                                    <input type="text" class="form-control" id="emailEditar" name="email" value="{{ $busdriver->email }}" required oninput="validarEmailEditar()">
                                                    <span id="emailErrorEditar" style="color: red;"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="driver_phone">Teléfono</label>
                                                    <input type="text" class="form-control" id="phoneEditar" name="phone" value="{{ $busdriver->phone }}" required oninput="validarTelefonoEditar()">
                                                    <span id="telefonoErrorEditar" style="color: red;"></span>
                                                </div>
                                                <!-- Agrega más campos de edición según tus necesidades -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal para eliminar conductor -->
                            <div class="modal fade" id="modal-delete-{{ $busdriver->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Eliminar Conductor</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>¿Estás seguro de que deseas eliminar al conductor <strong>{{ $busdriver->name }}</strong>?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                            <form action="{{ route('bienestar.drivers.delete', ['id' => $busdriver->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
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

<!-- Script para mostrar la alerta de guardado exitoso -->
<script>
    function mostrarAlerta() {
        var alerta = document.querySelector('.alert-success');
        alerta.style.display = 'block';
        setTimeout(function () {
            alerta.style.display = 'none';
        }, 3000);
    }

    // Función para validar el nombre del conductor
    function validarNombre() {
        var nombreInput = document.getElementById("namedriver");
        var nombre = nombreInput.value.trim(); // Eliminar espacios en blanco al principio y al final del texto

        // Expresión regular para permitir letras y espacios (para nombres y apellidos)
        var regex = /^[A-Za-z\s]+$/;

        if (!regex.test(nombre)) {
            document.getElementById("nombreError").textContent = "El campo 'Conductor' debe contener solo letras y espacios.";
            nombreInput.setCustomValidity("Invalid"); // Marcar el campo como inválido
        } else {
            document.getElementById("nombreError").textContent = ""; // Limpiar el mensaje de error
            nombreInput.setCustomValidity(""); // Marcar el campo como válido
        }
    }

    // Función para validar el correo electrónico
    function validarEmail() {
        var emailInput = document.getElementById("email");
        var email = emailInput.value.trim(); // Eliminar espacios en blanco al principio y al final del texto

        // Expresión regular para verificar una dirección de correo electrónico válida
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        if (!emailPattern.test(email)) {
            document.getElementById("emailError").textContent = "Ingrese una dirección de correo electrónico válida.";
            emailInput.setCustomValidity("Invalid"); // Marcar el campo como inválido
        } else {
            document.getElementById("emailError").textContent = ""; // Limpiar el mensaje de error
            emailInput.setCustomValidity(""); // Marcar el campo como válido
        }
    }

    // Función para validar el número de teléfono
    function validarTelefono() {
        var telefonoInput = document.getElementById("phone");
        var telefono = telefonoInput.value.trim(); // Eliminar cualquier caracter que no sea un dígito

        var telefonoError = document.getElementById("telefonoError");

        if (telefono.length !== 10 || isNaN(telefono)) {
            telefonoError.textContent = "El número de teléfono debe tener exactamente 10 caracteres numéricos.";
            telefonoInput.setCustomValidity("Invalid"); // Marcar el campo como inválido
        } else {
            telefonoError.textContent = ""; // Limpiar el mensaje de error
            telefonoInput.setCustomValidity(""); // Marcar el campo como válido
        }
    }

    // Función para validar el formulario completo
    function validarFormulario() {
        validarNombre();
        validarEmail();
        validarTelefono();
        mostrarAlerta(); // Mostrar la alerta de guardado exitoso

        // Devuelve true o false para permitir o prevenir el envío del formulario
        return !document.getElementById("nombreError").textContent &&
            !document.getElementById("emailError").textContent &&
            !document.getElementById("telefonoError").textContent;
    }

    // Función para validar el formulario de edición
    function validarNombreEditar() {
        var nombre = document.getElementById("nameEditar").value;
        // Expresión regular para permitir letras y espacios (para nombres y apellidos)
        var regex = /^[A-Za-z\s]+$/;

        if (!regex.test(nombre)) {
            document.getElementById("nombreErrorEditar").textContent = "El campo 'Conductor' debe contener solo letras y espacios.";
        } else {
            document.getElementById("nombreErrorEditar").textContent = ""; // Limpiar el mensaje de error
        }
    }

    function validarEmailEditar() {
        var email = document.getElementById("emailEditar").value;
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; // Expresión regular para verificar una dirección de correo válida

        if (!emailPattern.test(email)) {
            document.getElementById("emailErrorEditar").textContent = "Ingrese una dirección de correo electrónico válida.";
        } else {
            document.getElementById("emailErrorEditar").textContent = ""; // Limpiar el mensaje de error
        }
    }

    function validarTelefonoEditar() {
        var telefono = document.getElementById("phoneEditar").value;

        // Eliminar cualquier espacio en blanco del número
        telefono = telefono.replace(/\s/g, '');

        // Verificar si el número tiene exactamente 10 caracteres numéricos
        if (telefono.length !== 10 || isNaN(telefono)) {
            document.getElementById("telefonoErrorEditar").textContent = "El número de teléfono debe tener exactamente 10 caracteres numéricos.";
        } else {
            document.getElementById("telefonoErrorEditar").textContent = ""; // Limpiar el mensaje de error
        }
    }

    // Función para validar el formulario de edición
    function validarFormularioEditar() {
        validarNombreEditar();
        validarEmailEditar();
        validarTelefonoEditar();

        // Devuelve true o false para permitir o prevenir el envío del formulario de edición
        return !document.getElementById("nombreErrorEditar").textContent &&
            !document.getElementById("emailErrorEditar").textContent &&
            !document.getElementById("telefonoErrorEditar").textContent;
    }
</script>
@endsection
