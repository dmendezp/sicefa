@extends('bienestar::layouts.master')

@section('content')
<div class="container-fluid">
    <!-- Alerta de guardado exitoso -->
    <div class="alert alert-success col-md-12 text-center guardarExitoso" style="display: none;">
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
    <h1>{{ trans('bienestar::menu.Add Drivers')}} <i class="fas fa-bus"></i></h1>
    <div class="row justify-content-md-center pt-4">
        <div class="card shadow col-md-10">
            <div class="card-body">
                <div class="alert alert-success col-md-12 text-center guardarExitoso" style="display: none;">
                    Guardado exitoso.
                </div>

                <!-- Alerta de nombre repetido -->
                <div class="alert alert-danger col-md-12 text-center nombreRepetido" style="display: none;">
                    El conductor ya existe.
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        @if (Auth::user()->havePermission('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.save.drivers'))
                            <form action="{{ route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.save.drivers') }}" method="POST" onsubmit="return validarFormulario()">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-3 mb-2">
                                        <input type="text" id="bus_Driver" placeholder="{{ trans('bienestar::menu.Driver (Full Name)')}}" class="form-control namedriver" name="namedriver" required oninput="validarNombre(this)">
                                        <span class="nombreError" style="color: red;"></span>
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <input type="text" placeholder="{{ trans('bienestar::menu.Email')}}" class="form-control" name="email" id="email" required oninput="validarEmail(this)">
                                        <span id="emailError" style="color: red;"></span>
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <input type="text" placeholder="{{ trans('bienestar::menu.Phone')}}" class="form-control" name="phone" id="phone" required oninput="validarTelefono(this)">
                                        <span id="telefonoError" style="color: red;"></span>
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <button type="submit" class="btn btn-success btn-block">{{ trans('bienestar::menu.Save')}}</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>{{ trans('bienestar::menu.Driver')}}</th>
                                <th>{{ trans('bienestar::menu.Email')}}</th>
                                <th>{{ trans('bienestar::menu.Phone')}}</th>
                                <th>{{ trans('bienestar::menu.Actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($busdrivers as $busdriver)
                                <tr>
                                    <td>{{ $busdriver->id }}</td>
                                    <td>{{ $busdriver->name }}</td>
                                    <td>{{ $busdriver->email }}</td>
                                    <td>{{ $busdriver->phone }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="btn btn-info mr-2" data-toggle="modal" data-target="#modal-edit-{{ $busdriver->id }}"><i class="fas fa-edit"></i></button>
                                            <form action="{{ route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.delete.drivers', ['id' => $busdriver->id]) }}" method="POST" class="formEliminar">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal para editar conductor -->
                                <div class="modal fade" id="modal-edit-{{ $busdriver->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">{{ trans('bienestar::menu.Edit Driver')}}</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Formulario de edición para el conductor -->
                                                <form action="{{ route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.edit.drivers', ['id' => $busdriver->id]) }}" method="POST" onsubmit="return validarFormularioEditar('{{ $busdriver->id }}')">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="nameEditar_{{ $busdriver->id }}">{{ trans('bienestar::menu.Driver')}}</label>
                                                        <input type="text" class="form-control" id="nameEditar_{{ $busdriver->id }}" name="name" value="{{ $busdriver->name }}" required oninput="validarNombreEditar('{{ $busdriver->id }}')">
                                                        <span id="nombreErrorEditar_{{ $busdriver->id }}" style="color: red;"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="emailEditar_{{ $busdriver->id }}">{{ trans('bienestar::menu.Email')}}</label>
                                                        <input type="text" class="form-control" id="emailEditar_{{ $busdriver->id }}" name="email" value="{{ $busdriver->email }}" required oninput="validarEmailEditar('{{ $busdriver->id }}')">
                                                        <span id="emailErrorEditar_{{ $busdriver->id }}" style="color: red;"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="phoneEditar_{{ $busdriver->id }}">{{ trans('bienestar::menu.Phone')}}</label>
                                                        <input type="text" class="form-control" id="phoneEditar_{{ $busdriver->id }}" name="phone" value="{{ $busdriver->phone }}" required oninput="validarTelefonoEditar('{{ $busdriver->id }}')">
                                                        <span id="telefonoErrorEditar_{{ $busdriver->id }}" style="color: red;"></span>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">{{ trans('bienestar::menu.Save')}}</button>
                                                    </div>
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
        </div>
    </div>
</div>

<!-- Script para mostrar la alerta de guardado exitoso -->
<script>
    var conductoresExistentes = {!! json_encode($busdrivers->pluck('name')) !!};

    function mostrarAlerta(alerta) {
        alerta.style.display = 'block';
        setTimeout(function() {
            alerta.style.display = 'none';
        }, 3000);
    }

    function validarNombre(input) {
        var nombre = input.value.trim();
        var errorDiv = input.nextElementSibling.nextElementSibling;

        if (conductoresExistentes.includes(nombre)) {
            input.setCustomValidity("El conductor ya existe.");
            errorDiv.textContent = "El conductor ya existe.";
            mostrarAlerta(document.querySelector('.nombreRepetido'));
        } else if (!/^[A-Za-z\s]+$/.test(nombre)) {
            input.setCustomValidity("El nombre solo debe contener letras y espacios.");
            errorDiv.textContent = "El nombre solo debe contener letras y espacios.";
        } else {
            input.setCustomValidity("");
            errorDiv.textContent = "";
        }
    }

    function validarEmail(input) {
        var email = input.value.trim();
        var errorDiv = input.nextElementSibling.nextElementSibling;
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        if (!emailPattern.test(email)) {
            input.setCustomValidity("Ingrese una dirección de correo electrónico válida.");
            errorDiv.textContent = "Ingrese una dirección de correo electrónico válida.";
        } else {
            input.setCustomValidity("");
            errorDiv.textContent = "";
        }
    }

    function validarTelefono(input) {
        var telefono = input.value.trim();
        var errorDiv = input.nextElementSibling.nextElementSibling;

        if (telefono.length !== 10 || isNaN(telefono)) {
            input.setCustomValidity("El número de teléfono debe tener exactamente 10 caracteres numéricos.");
            errorDiv.textContent = "El número de teléfono debe tener exactamente 10 caracteres numéricos.";
        } else {
            input.setCustomValidity("");
            errorDiv.textContent = "";
        }
    }

    function validarFormulario() {
        var nombreInput = document.querySelector('.namedriver');
        var emailInput = document.getElementById("email");
        var telefonoInput = document.getElementById("phone");

        validarNombre(nombreInput);
        validarEmail(emailInput);
        validarTelefono(telefonoInput);

        mostrarAlerta(document.querySelector('.guardarExitoso'));

        return !nombreInput.validationMessage && !emailInput.validationMessage && !telefonoInput.validationMessage;
    }

    function validarEmailEditar(id) {
        var emailInput = document.getElementById("emailEditar_" + id);
        var email = emailInput.value.trim();
        var errorDiv = document.getElementById("emailErrorEditar_" + id);
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        if (!emailPattern.test(email)) {
            emailInput.setCustomValidity("Ingrese una dirección de correo electrónico válida.");
            errorDiv.textContent = "Ingrese una dirección de correo electrónico válida.";
        } else {
            emailInput.setCustomValidity("");
            errorDiv.textContent = "";
        }
    }

    function validarTelefonoEditar(id) {
        var telefonoInput = document.getElementById("phoneEditar_" + id);
        var telefono = telefonoInput.value.trim();
        var errorDiv = document.getElementById("telefonoErrorEditar_" + id);

        if (telefono.length !== 10 || isNaN(telefono)) {
            telefonoInput.setCustomValidity("El número de teléfono debe tener exactamente 10 caracteres numéricos.");
            errorDiv.textContent = "El número de teléfono debe tener exactamente 10 caracteres numéricos.";
        } else {
            telefonoInput.setCustomValidity("");
            errorDiv.textContent = "";
        }
    }

    function validarFormularioEditar(id) {
        var nombreInput = document.getElementById("nameEditar_" + id);
        var emailInput = document.getElementById("emailEditar_" + id);
        var telefonoInput = document.getElementById("phoneEditar_" + id);

        validarNombreEditar(id);
        validarEmailEditar(id);
        validarTelefonoEditar(id);

        return !nombreInput.validationMessage && !emailInput.validationMessage && !telefonoInput.validationMessage;
    }
</script>
@endsection
