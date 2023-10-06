@extends('senaempresa::layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">{{ $title }}</div>
                    <div class="card-body">
                        <form action="{{ route('company.vacant.curso_asociado') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="course_id"
                                    class="form-label">{{ trans('senaempresa::menu.Select a course:') }}</label>
                                <input type="text" class="form-control" id="search-input" name="search-input"
                                    placeholder="Ingresar ficha o curso">
                                <select class="form-control" name="course_id" aria-label="Selecciona un curso"
                                    id="course-select" multiple="multiple" required>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->code }}
                                            {{ $course->program->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="vacancy_id">{{ trans('senaempresa::menu.Select a vacancy:') }}</label>
                                <select class="form-control" name="vacancy_id" id="vacancy_id">
                                    @foreach ($vacancies as $vacancy)
                                        <option value="{{ $vacancy->id }}">{{ $vacancy->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit"
                                class="btn btn-primary">{{ trans('senaempresa::menu.Assign Course to Vacant') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-md-12">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">{{ $title }}</div>
                    <div class="card-body">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('senaempresa::menu.Course ID') }}</th>
                                    <th>{{ trans('senaempresa::menu.Vacant ID') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($courses)
                                    @foreach ($courses as $course)
                                        @foreach ($course->vacancy as $vacant)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $course->code }} {{ $course->program->name }}</td>
                                                <td>{{ $vacant->name }}</td>
                                                <td>
                                                    <form action="{{ route('company.vacant.eliminar_asociacion') }}"
                                                        method="POST" id="asociacionEliminar">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                        <input type="hidden" name="vacancy_id"
                                                            value="{{ $vacant->id }}">
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
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

        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById("search-input");
            const courseSelect = document.getElementById("course-select");

            searchInput.addEventListener("input", function() {
                const searchText = this.value.trim().toLowerCase();

                for (let option of courseSelect.options) {
                    const optionText = option.text.toLowerCase();
                    const isMatch = optionText.includes(searchText);
                    option.hidden = !isMatch;
                }
            });
        });
    </script>
@endsection
