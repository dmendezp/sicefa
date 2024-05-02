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
                        <h1 class="card-title">{{ trans('gth::menu.Types of Contracts') }}</h1>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#crearModal">
                            {{ trans('gth::menu.Create Contract Type') }}
                        </button>
                        <table id="contractortype" class="table table-striped table-bordered shadow-lg mt-4"
                            style="width:100%">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ trans('gth::menu.Name') }}</th>
                                    <th scope="col">{{ trans('gth::menu.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contractortype as $contractor)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $contractor->name }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="#" class="btn btn-warning editar-btn" data-bs-toggle="modal"
                                                    data-bs-target="#editarModal_{{ $contractor->id }}"
                                                    data-id="{{ $contractor->id }}"
                                                    data-nombre="{{ $contractor->name }}">{{ trans('gth::menu.Edit') }}</a>
                                                    <div style="width: 10px;"></div>
                                                    <div style="width: 10px;"></div>
                                                    <form action="{{ route('cefa.gth.contractortypes.delete', $contractor->id) }}"
                                                        method="POST" class="btnEliminar" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            data-id="{{ $contractor->id }}">Eliminar</button>
                                                    </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                <!-- Repite este bloque para cada tipo de contrato -->
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
                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('gth::menu.Add New Contract Type') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('cefa.gth.contractortypes.create') }}" method="POST" class="btnGuardar">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ trans('gth::menu.Type of contract:') }}</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <!-- Agrega más campos de formulario según tus necesidades -->
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success" id="Guardar">{{ trans('gth::menu.Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Edición -->
    @foreach ($contractortype as $contractor)
        <div class="modal fade" id="editarModal_{{ $contractor->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ trans('gth::menu.Edit Contract Type') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if (isset($contractor))
                            <!-- Cambiado a $contractor -->
                            <form id="editForm" method="POST"
                                action="{{ route('cefa.gth.contractortypes.update', ['id' => $contractor->id]) }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="id"
                                    value="{{ $contractor->id }}"><!-- Cambiado a $contractor -->
                                <div class="mb-3">
                                    <label for="editName" class="form-label">{{ trans('gth::menu.Name') }}</label>
                                    <input type="text" class="form-control" id="editName" name="name"
                                        value="{{ old('name', $contractor->name) }}"> <!-- Cambiado a $contractor -->
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Resto del formulario -->
                                <button type="submit" class="btn btn-primary" onclick="return confirmarCambios()">{{ trans('gth::menu.Save Changes') }}</button>
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
        new DataTable('#contractortype');
    </script>

    <script>
        function confirmarCambios() {
            Swal.fire({
                title: '{{ trans('gth::menu.Saved successful') }}',
                text: '{{ trans('gth::menu.The data has been saved correctly.') }}',
                icon: '{{ trans('gth::menu.success') }}',
                confirmButtonText: '{{ trans('gth::menu.Accept') }}',
            });
        }
    </script>
<!-- SweetAlert CDN -->

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
                title: '{{ trans('gth::menu.Saved successful') }}',
                text: '{{ trans('gth::menu.The data has been saved correctly.') }}',
                icon: '{{ trans('gth::menu.success') }}',
                confirmButtonText: '{{ trans('gth::menu.Accept') }}',
            });
        });
    </script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: '{{ trans('gth::menu.success') }}',
                title: '{{ trans('gth::menu.success') }}',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000 // Tiempo en milisegundos (2 segundos en este caso)
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: '{{ trans('gth::menu.Error') }}',
                title: '{{ trans('gth::menu.Error') }}',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 2000 // Tiempo en milisegundos (2 segundos en este caso)
            });
        </script>
    @endif
    @if (session('success'))
        <script>
            Swal.fire({
                icon: '{{ trans('gth::menu.success') }}',
                title: '{{ trans('gth::menu.success') }}',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000 // Tiempo en milisegundos (2 segundos en este caso)
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: '{{ trans('gth::menu.Error') }}',
                title: '{{ trans('gth::menu.Error') }}',
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
                var updateRoute = '{{ route('cefa.gth.contractortypes.update', ['id' => ':id']) }}'.replace(
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

