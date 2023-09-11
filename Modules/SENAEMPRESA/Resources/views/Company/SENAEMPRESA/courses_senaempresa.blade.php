@extends('senaempresa::layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">{{ $title }}</div>
                    <div class="card-body">
                        <form action="{{ route('company.senaempresa.curso_asociado_senaempresa') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="course_id">{{ trans('senaempresa::menu.Select a course:') }}</label>
                                <select class="form-control" name="course_id" id="course_id">
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->code }}
                                            {{ $course->program->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="senaempresa_id">{{ trans('senaempresa::menu.Select a SenaEmpresa:') }}</label>
                                <select class="form-control" name="senaempresa_id" id="senaempresa_id">
                                    @foreach ($senaempresas as $senaempresa)
                                        <option value="{{ $senaempresa->id }}">{{ $senaempresa->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit"
                                class="btn btn-primary">{{ trans('senaempresa::menu.Assign Course to SenaEmpresa') }}</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">{{ $title }}</div>
                        <div class="card-body">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('senaempresa::menu.Course ID') }}</th>
                                        <th>{{ trans('senaempresa::menu.SenaEmpresa ID') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($courses)
                                        @foreach ($courses as $course)
                                            @foreach ($course->senaempresa as $senaempresa)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $course->code }} {{ $course->program->name }}</td>
                                                    <!-- Accede al atributo "name" del modelo Course -->
                                                    <td>{{ $senaempresa->name }}</td>
                                                    <!-- Accede al atributo "name" del modelo Senaempresa -->
                                                    <td>
                                                        <form
                                                            action="{{ route('company.senaempresa.eliminar_asociacion_empresa') }}"
                                                            method="POST" id="asociacionEliminar">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="course_id"
                                                                value="{{ $course->id }}">
                                                            <input type="hidden" name="senaempresa_id"
                                                                value="{{ $senaempresa->id }}">
                                                            <button type="submit" class="btn btn-danger"><i
                                                                    class="fas fa-trash-alt"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @else
                                        <p>{{ trans('senaempresa::menu.No associated courses were found.') }}</p>
                                    @endif
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
<!--scripts utilizados para procesos-->
@section('scripts')
    <script>
        'use strict';
        // Selecciona todos los formularios con la clase "formEliminar"
        var forms = document.querySelectorAll('#asociacionEliminar');

        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    event.preventDefault(); // Evita que el formulario se envíe de inmediato

                    Swal.fire({
                        title: "{{ trans('senaempresa::menu.Are you sure?') }}",
                        text: "{{ trans('senaempresa::menu.It is an irreversible process.') }}",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "{{ trans('senaempresa::menu.Yes, delete it') }}",
                        cancelButtonText: "{{ trans('senaempresa::menu.Cancel') }}" // Cambiar el texto del botón "Cancelar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Enviar el formulario usando AJAX
                            axios.post(form.action, new FormData(form))
                                .then(function(response) {
                                    // Manejar la respuesta JSON del servidor
                                    if (response.data && response.data.mensaje) {
                                        Swal.fire({
                                            title: '{{ trans('senaempresa::menu.Association deleted!') }}',
                                            text: response.data.mensaje,
                                            icon: 'success'
                                        }).then(() => {
                                            // Recargar la página u otra acción según sea necesario
                                            location
                                                .reload(); // Recargar la página después de eliminar
                                        });
                                    }
                                })
                                .catch(function(error) {
                                    // Manejar errores si es necesario
                                    console.error(error);
                                });
                        }
                    });
                });
            });
    </script>
@endsection
