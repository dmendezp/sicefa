@extends('bienestar::layouts.adminlte')

@section('content')
<!-- Main content -->
<div class="container-fluid">
    <div class="row justify-content-md-center pt-4">
        <div class="card card-green card-outline shadow col-md-10">
            <div class="card-header">
                <h3 class="card-title">{{ __('Agregar conductores') }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-12">                
                            <form action="{{ route('bienestar.drivers.add') }}" method="POST" onsubmit="return validarFormulario()">
    @csrf
    <div class="form-row">
        <div class="col-md-3 mb-2">
            <input type="text" placeholder="Conductor" class="form-control" name="namedriver" id="namedriver" oninput="validarNombre()">
        </div>
        <div class="col-md-3 mb-2">
            <input type="text" placeholder="Email" class="form-control" name="email" id="email" onblur="validarEmail()">
        </div><div class="col-md-3 mb-2">
            <input type="number" placeholder="Telefono" class="form-control" name="phone" id="phone" onblur="validarTelefono()">
        </div>

        <div class="col-md-3 mb-2">
            <button type="submit" class="btn btn-success btn-block">Guardar</button>
        </div>
    </div>
</form>

<script>
    function validarNombre() {
        var nombre = document.getElementById("namedriver").value;
        var regex = /^[A-Za-z]+$/; // Expresión regular para permitir solo letras

        if (!regex.test(nombre)) {
            alert("El campo 'Conductor' debe contener solo letras.");
            document.getElementById("namedriver").value = ""; // Limpiar el campo
        }
    }

    function validarFormulario() {
        // Agregar aquí más validaciones si es necesario
        return validarTelefono(); // Devuelve true o false para permitir o prevenir el envío del formulario
    }
</script>
<script>
    function validarEmail() {
        var email = document.getElementById("email").value;
        var gmailPattern = /@gmail\.com$/; // Expresión regular para verificar si termina con @gmail.com

        if (!gmailPattern.test(email)) {
            alert("El correo electrónico debe tener '@gmail.com' al final.");
            document.getElementById("email").value = ""; // Limpiar el campo
        }
    }
</script>
<script>
    function validarTelefono() {
        var telefono = document.getElementById("phone").value;

        // Eliminar cualquier espacio en blanco del número
        telefono = telefono.replace(/\s/g, '');

        // Verificar si el número tiene exactamente 10 caracteres numéricos
        if (telefono.length !== 10 || isNaN(telefono)) {
            alert("El número de teléfono debe tener exactamente 10 caracteres numéricos.");
            document.getElementById("phone").value = ""; // Limpiar el campo
        }
    }
</script>



                        </form>
                    </div>
                </div>
            
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Conductor</th>
                                <th>Email</th>
                                <th>Telefono</th>
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
                                            <button class="btn btn-info" data-toggle="modal" data-target="#modal-edit-{{ $busdriver->id }}">Editar</button>
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#modal-delete-{{ $busdriver->id }}">Eliminar</button>
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
                                                <form action="{{ route('bienestar.drivers.update', ['id' => $busdriver->id]) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="driver_name">Nombre del Conductor</label>
                                                        <input type="text" class="form-control" id="name" name="name" value="{{ $busdriver->name }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="driver_email">Email Conductor</label>
                                                        <input type="text" class="form-control" id="email" name="email" value="{{ $busdriver->email }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="driver_phone">Teléfono</label>
                                                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $busdriver->phone }}">
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
                                                <p>¿Estás seguro de que deseas eliminar este conductor?</p>
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
@endsection
