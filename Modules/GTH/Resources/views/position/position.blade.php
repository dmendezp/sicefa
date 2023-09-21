@extends('gth::layouts.master')

@section('css')
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">vista de posición</h1>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearModal">
                            Gestión de Posición
                        </button>
                        <table id="position" class="table table-striped table-bordered shadow-lg mt-4"
                            style="width:100%">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($positions as $positio)

                                    <tr>
                                        <td>{{ $positio->id }}</td> <!-- Cambiado a $positio -->
                                        <td>{{ $positio->name }}</td> <!-- Cambiado a $positio -->
                                        <td>{{ $positio->description }}</td> <!-- Cambiado a $positio -->
                                        <td>
                                            <div class="d-flex">
                                                <a href="#" class="btn btn-warning editar-btn" data-bs-toggle="modal"
                                                    data-bs-target="#editarModal_{{ $positio->id }}"
                                                    data-id="{{ $positio->id }}" data-nombre="{{ $positio->name }}"
                                                    data-descripcion="{{ $positio->description }}">Editar</a> <!-- Cambiado a $positio -->
                                                <div style="width: 10px;"></div>
                                                <form action="{{ route('gth.positions.delete', $positio->id) }}"     
                                                    method="POST" class="btnEliminar ml-2" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        data-id="{{ $positio->id }}">Eliminar</button> <!-- Cambiado a $positio -->
                                                </form>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                                <!--  -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal de Creación -->
    <div class="modal fade" id="crearModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Una Nueva Posicion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('gth.positions.create') }}" method="POST" class="btnGuardar">
                        @csrf
                        <div class="mb-3">
                            <label for="professional_denomination" class="form-label">Denominación Profesional:</label>
                            <select name="professional_denomination" id="professional_denomination"
                                class="form-control @error('professional_denomination') is-invalid @enderror" required>
                                <option value="-- Seleccione --"></option>
                                <option value="Asesor">Asesor</option>
                                <option value="Directivo">Directivo</option>
                                <option value="Instructor">Instructor</option>
                                <option value="Profesiona">Profesiona</option>
                                <option value="Técnico">Técnico</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="grade" class="form-label">Calificaciones:</label>
                            <select name="grade" id="grade"
                                class="form-control @error('grade') is-invalid @enderror" required>
                                <option value="-- Seleccione --"></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                            </select>
                        </div>
                        <!-- Resto del formulario -->
                    <button type="submit" class="btn btn-primary"
                        onclick="return confirmarCambios()">Guardar
                        Cambios</button>
                        
    <!-- Modal de Edición -->
    @foreach ($positions as $positio)

        <div class="modal fade" id="editarModal_{{ $positio->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Posicion:</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if (isset($positio))
                            <!-- Cambiado a $position-->
                            <form id="editForm" method="POST"
                                action="{{ route('gth.positions.update', ['id' => $positio->id]) }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="id"
                                    value="{{ $positio->id }}"><!-- Cambiado a $posicion -->
                                <div class="mb-3">
                                    <label for="editName" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="editName" name="name"
                                        value="{{ old('name', $positio->name) }}"> <!-- Cambiado a $posicion -->
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="editName" class="form-label">Descripción</label>
                                    <input type="text" class="form-control" id="editDescription" name="description"
                                        value="{{ old('description', $positio->description) }}">
                                    <!-- Cambiado a $positon -->
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Resto del formulario -->
                                <button type="submit" class="btn btn-primary" onclick="return confirmarCambios()">Guardar
                                    Cambios</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('js')

    <script>
        new DataTable('#position');
    </script>
    <script>
        function confirmarCambios() {
            Swal.fire({
                title: 'Guardado exitoso',
                text: 'Los datos se han guardado de Posicion.',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
        }
    </script>
    <script>
        'use strict';
        // Selecciona todos los formularios con la clase "formEliminar"
        var forms = document.querySelectorAll('.btnEliminar');

        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    event.preventDefault(); // Evita que el formulario se envíe de inmediato

                    console.log('Formulario enviado'); // Evita que el formulario se envíe de inmediato

                    Swal.fire({
                        title: "¿Estas seguro que deseas eliminar?",
                        text: "Este proceso es irrevesible.",
                        icon: 'Advertencia',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "Si, Elimínalo",
                        cancelButtonText: "Cancelar" // Cambiar el texto del botón "Cancelar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Your work has been saved',
                                showConfirmButton: false,
                                timer: 1000
                            })
                        }
                    });
                });
            });
    </script>

    <script>
        'use strict';
        var Guardar = document.getElementById('Guardar');

        Guardar.addEventListener('click', function() {
            // Simulamos una operación de guardado exitosa (puedes reemplazar esto con tu lógica real de guardado)
            // Supongamos que aquí tienes tu lógica para guardar datos en el servidor

            // Luego de que se haya completado la operación de guardado, muestra el SweetAlert
            Swal.fire({
                title: 'Guardado exitoso',
                text: 'Los datos se han guardado correctamente.',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
        });
    </script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Exito!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000 // Tiempo en milisegundos (2 segundos en este caso)
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 2000 // Tiempo en milisegundos (2 segundos en este caso)
            });
        </script>
    @endif
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            $('.editar-btn').click(function() {
                var id = $(this).data('id');
                var nombre = $(this).data('nombre');

                $('#editId').val(id);
                $('#editName').val(nombre);

                // Obtener la ruta de actualización del formulario de edición
                var updateRoute = '{{ route('gth.positions.update', ['id' => ':id']) }}'.replace(
                    ':id', id);

                // Asignar la ruta de actualización al formulario de edición
                $('#editForm').attr('action', updateRoute);
            });

            $('#editForm').submit(function(event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'), // Usar la ruta de acción del formulario
                    method: 'PATCH',
                    data: formData,
                    success: function(response) {
                        // Actualizar la página después de un breve retraso
                        setTimeout(function() {
                            location.reload();
                        }, 1000); // Espera 1 segundo (1000 milisegundos) antes de recargar

                        // Cerrar el modal
                        var modal = new bootstrap.Modal(document.getElementById('editarModal'));
                        modal.hide();
                    }
                });
            });
        });
    </script>
@endpush
