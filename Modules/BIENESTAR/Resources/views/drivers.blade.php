@extends('bienestar::layouts.master')

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

                <!-- Alerta de nombre repetido -->
                <div class="alert alert-danger col-md-12 text-center" style="display: none;">
                    El conductor ya existe.
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <form action="{{ route('bienestar.drivers.add') }}" method="POST" onsubmit="return validarFormulario()">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-3 mb-2">
                                    <input type="text" placeholder="Conductor (Nombres/Apellidos)" class="form-control namedriver" name="namedriver" required oninput="validarNombre(this)">
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
                                            <!-- Formulario de edición para el conductor -->
                                            <form action="{{ route('bienestar.drivers.update', ['id' => $busdriver->id]) }}" method="POST" onsubmit="return validarFormularioEditar('{{ $busdriver->id }}')">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="nameEditar_{{ $busdriver->id }}">Nombre del Conductor</label>
                                                    <input type="text" class="form-control" id="nameEditar_{{ $busdriver->id }}" name="name" value="{{ $busdriver->name }}" required oninput="validarNombreEditar('{{ $busdriver->id }}')">
                                                    <span id="nombreErrorEditar_{{ $busdriver->id }}" style="color: red;"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="emailEditar_{{ $busdriver->id }}">Email Conductor</label>
                                                    <input type="text" class="form-control" id="emailEditar_{{ $busdriver->id }}" name="email" value="{{ $busdriver->email }}" required oninput="validarEmailEditar('{{ $busdriver->id }}')">
                                                    <span id="emailErrorEditar_{{ $busdriver->id }}" style="color: red;"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="phoneEditar_{{ $busdriver->id }}">Teléfono</label>
                                                    <input type="text" class="form-control" id="phoneEditar_{{ $busdriver->id }}" name="phone" value="{{ $busdriver->phone }}" required oninput="validarTelefonoEditar('{{ $busdriver->id }}')">
                                                    <span id="telefonoErrorEditar_{{ $busdriver->id }}" style="color: red;"></span>
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
    // Obtener la lista de nombres de conductores existentes
    var conductoresExistentes = {!! json_encode($busdrivers->pluck('name')) !!};

    function mostrarAlerta(alerta) {
        alerta.style.display = 'block';
        setTimeout(function () {
            alerta.style.display = 'none';
        }, 3000);
    }

    // Función para validar el nombre del conductor al agregar
    function validarNombre(input) {
        var nombre = input.value.trim(); // Obtener el valor del campo actual
        var errorDiv = input.nextElementSibling; // Div para mostrar el mensaje de error

        // Verificar si el nombre ya existe en la lista de conductores
        if (conductoresExistentes.includes(nombre)) {
            input.setCustomValidity("Invalid"); // Marcar el campo actual como inválido
            errorDiv.textContent = ""; // Limpiar el mensaje de error
            mostrarAlerta(document.querySelector('.alert-danger')); // Mostrar alerta de nombre repetido
        } else {
            input.setCustomValidity(""); // Marcar el campo actual como válido
            errorDiv.textContent = ""; // Limpiar el mensaje de error
        }
    }

    // Función para validar el correo electrónico al agregar
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

    // Función para validar el número de teléfono al agregar
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

    // Función para validar el formulario completo al agregar
    function validarFormulario() {
        validarNombre(document.querySelector('.namedriver'));
        validarEmail();
        validarTelefono();
        mostrarAlerta(document.querySelector('.alert-success')); // Mostrar la alerta de guardado exitoso

        // Devuelve true o false para permitir o prevenir el envío del formulario
        return !document.getElementById("nombreError").textContent &&
            !document.getElementById("emailError").textContent &&
            !document.getElementById("telefonoError").textContent;
    }

    // Función para validar el nombre del conductor al editar
    function validarNombreEditar(id) {
        var nombre = document.getElementById("nameEditar_" + id).value.trim();

        // Verificar si el nombre ya existe en la lista de conductores
        if (conductoresExistentes.includes(nombre)) {
            document.getElementById("nombreErrorEditar_" + id).textContent = "Este conductor ya existe.";
            mostrarAlerta(document.querySelector('.alert-danger')); // Mostrar alerta de nombre repetido
        } else {
            document.getElementById("nombreErrorEditar_" + id).textContent = ""; // Limpiar el mensaje de error
        }
    }

    // Función para validar el correo electrónico al editar
    function validarEmailEditar(id) {
        var email = document.getElementById("emailEditar_" + id).value.trim();
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; // Expresión regular para verificar una dirección de correo válida

        if (!emailPattern.test(email)) {
            document.getElementById("emailErrorEditar_" + id).textContent = "Ingrese una dirección de correo electrónico válida.";
        } else {
            document.getElementById("emailErrorEditar_" + id).textContent = ""; // Limpiar el mensaje de error
        }
    }

    // Función para validar el número de teléfono al editar
    function validarTelefonoEditar(id) {
        var telefono = document.getElementById("phoneEditar_" + id).value.trim();

        // Eliminar cualquier espacio en blanco del número
        telefono = telefono.replace(/\s/g, '');

        // Verificar si el número tiene exactamente 10 caracteres numéricos
        if (telefono.length !== 10 || isNaN(telefono)) {
            document.getElementById("telefonoErrorEditar_" + id).textContent = "El número de teléfono debe tener exactamente 10 caracteres numéricos.";
        } else {
            document.getElementById("telefonoErrorEditar_" + id).textContent = ""; // Limpiar el mensaje de error
        }
    }

    // Función para validar el formulario de edición específico
    function validarFormularioEditar(id) {
        validarNombreEditar(id);
        validarEmailEditar(id);
        validarTelefonoEditar(id);

        // Devuelve true o false para permitir o prevenir el envío del formulario de edición
        return !document.getElementById("nombreErrorEditar_" + id).textContent &&
            !document.getElementById("emailErrorEditar_" + id).textContent &&
            !document.getElementById("telefonoErrorEditar_" + id).textContent;
    }
</script>
@endsection
