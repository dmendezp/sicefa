@extends('gth::layouts.master')

@section('css')
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">{{ trans('gth::menu.View of Grades') }}</h1>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearModal">
                            {{ trans('gth::menu.Create Grades') }}
                        </button>
                        <table id="position" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ trans('gth::menu.Professional Title') }}</th>
                                    <th scope="col">{{ trans('gth::menu.Qualifications') }}</th>
                                    <th scope="col">{{ trans('gth::menu.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($positions as $positio)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td> <!-- Cambiado a $positio -->
                                        <td>{{ $positio->professional_denomination }}</td> <!-- Cambiado a $positio -->
                                        <td>{{ $positio->grade }}</td> <!-- Cambiado a $positio -->
                                        <td>

                                            <div class="d-flex">
                                                <a href="#" class="btn btn-warning editar-btn" data-bs-toggle="modal"
                                                    data-bs-target="#editar{{ $positio->id }}"
                                                    data-id="{{ $positio->id }}" data-nenominación
                                                    Profesional="{{ $positio->nenominación_Profesional }}"
                                                    data-nenominación
                                                    Profesional="{{ $positio->professional_denomination }}">{{ trans('gth::menu.Edit') }}</a>
                                                <div style="width: 10px;"></div>
                                                <form action="{{ route('cefa.gth.positions.delete', $positio->id) }}"
                                                    method="POST" class="btnEliminar ml-2" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        data-id="{{ $positio->id }}">{{ trans('gth::menu.Delete') }}</button>
                                                    <!-- Cambiado a $positio -->
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
                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('gth::menu.Add a New Position') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('cefa.gth.positions.create') }}" method="POST" class="btnGuardar">
                        @csrf
                        <div class="mb-3">
                            <label for="professional_denomination"
                                class="form-label">{{ trans('gth::menu.Professional Designation:') }}</label>
                            <select name="professional_denomination" id="professional_denomination"
                                class="form-control @error('professional_denomination') is-invalid @enderror" required>
                                <option value="-- Seleccione --">{{ trans('gth::menu.-- Select --') }}</option>
                                <option value="Asesor">{{ trans('gth::menu.Advisor') }}</option>
                                <option value="Directivo">{{ trans('gth::menu.Executive') }}</option>
                                <option value="Instructor">{{ trans('gth::menu.Instructor') }}</option>
                                <option value="Profesional">{{ trans('gth::menu.Professional') }}</option>
                                <option value="Técnico">{{ trans('gth::menu.Technician') }}</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="grade" class="form-label">{{ trans('gth::menu.Qualifications:') }}</label>
                            <select name="grade" id="grade" class="form-control @error('grade') is-invalid @enderror"
                                required>
                                <option value="-- Seleccione --">{{ trans('gth::menu.-- Select --') }}</option>
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
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                            </select>
                        </div>
                        <!-- Resto del formulario -->
                        <button type="submit" class="btn btn-primary"
                            onclick="return confirmarCambios()">{{ trans('gth::menu.Save') }}</button>



                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal de Edición -->
    @foreach ($positions as $positio)
        <div class="modal fade" id="editar{{ $positio->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ trans('gth::menu.Edit Position Management:') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if (isset($positio))
                            <!-- Cambiado a $positio -->
                            <form id="editForm" method="POST"
                                action="{{ route('cefa.gth.positions.update', ['id' => $positio->id]) }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="id"
                                    value="{{ $positio->id }}"><!-- Cambiado a $positio -->
                                <div class="mb-3">
                                    <label for="editprofessional_denomination"
                                        class="form-label">{{ trans('gth::menu.Professional Designation:') }}</label>
                                    <select class="form-control" id="editprofessional_denomination"
                                        name="professional_denomination">
                                        <option
                                            value="{{ old('professional_denomination', $positio->professional_denomination) }}">
                                            {{ old('professional_denomination', $positio->professional_denomination) }}
                                        </option>
                                        <option value="Asesor">{{ trans('gth::menu.Advisor') }}</option>
                                        <option value="Asistencial">{{ trans('gth::menu.Assistant') }}</option>
                                        <option value="Directivo">{{ trans('gth::menu.Executive') }}</option>
                                        <option value="Instructor">{{ trans('gth::menu.Instructor') }}</option>
                                        <option value="Profesional">{{ trans('gth::menu.Technician') }}</option>
                                        <option value="Técnico">{{ trans('gth::menu.Executive') }}</option>
                                    </select> <!-- Cambiado a $positio -->
                                    @error('professional_denomination')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="editName"
                                        class="form-label">{{ trans('gth::menu.Qualifications:') }}</label>
                                    <select class="form-control" id="editgrade" name="grade">
                                        <option value="{{ old('grade', $positio->grade) }}">
                                            {{ old('grade', $positio->grade) }}</option>
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
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                    </select>
                                    <!-- Cambiado a $positio -->
                                    @error('grade')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Resto del formulario -->
                                <button type="submit" class="btn btn-primary"
                                    onclick="return confirmarCambios()">{{ trans('gth::menu.Save Changes') }}</button>
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
                title: '{{ trans('gth::menu.Saved successful') }}',
                text: '{{ trans('gth::menu.The data has been saved from Position.') }}',
                icon: '{{ trans('gth::menu.success') }}',
                confirmButtonText: '{{ trans('gth::menu.success') }}',
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
                        title: '{{ trans('gth::menu.¿Are you sure you want to delete?') }}',
                        text: '{{ trans('gth::menu.This process is irreversible.') }}',
                        icon: '{{ trans('gth::menu.Warning') }}',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: '{{ trans('gth::menu.Yes, delete it') }}',
                        cancelButtonText: '{{ trans('gth::menu.Cancel') }}',// Cambiar el texto del botón "Cancelar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                            Swal.fire({
                                position: 'center',
                                icon: '{{ trans('gth::menu.success') }}',
                                title: '{{ trans('gth::menu.Your work has been saved') }}',
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
                title: '{{ trans('gth::menu.success!') }}',
                text: '{{ trans('gth::menu.success') }}',
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
                var Denominación_Profesional = $(this).data('Denominación Profesional');
                var Calificaciones = $(this).data('Calificaciones');


                $('#editId').val(id);
                $('#editprofessional_denomination').val(Denominación Profesional);
                $('#editprofessional_denomination').val(Calificaciones);

                // Obtener la ruta de actualización del formulario de edición
                var updateRoute = '{{ route('cefa.gth.positions.update', ['id' => ':id']) }}'.replace(
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
                        var modal = new bootstrap.Modal(document.getElementById('editar'));
                        modal.hide();
                    }
                });
            });
        });
    </script>
@endpush
