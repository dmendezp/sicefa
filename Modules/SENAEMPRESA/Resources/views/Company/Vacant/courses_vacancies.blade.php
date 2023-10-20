@extends('senaempresa::layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-md-center pt-4">
        <div class="card card-primary card-outline shadow col-md-8">
            <div class="card-header">
                <h3 class="card-title">{{ $title }}</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="course_id">{{ trans('senaempresa::menu.Select Course') }}</label>
                    <select id="course_id" class="form-control">
                        <option value="" selected disabled>{{ trans('senaempresa::menu.Select a course') }}</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->code }} {{ $course->program->name }}</option>
                        @endforeach
                    </select>
                </div>
                    <table id="pivote" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{ trans('senaempresa::menu.Courses') }}</th>
                                <th>{{ trans('senaempresa::menu.Vacancies') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                                @if ($course->status === 'Activo')
                                    <tr>
                                        <td style="width:30px;">{{ $course->code }} {{ $course->program->name }}</td>
                                        <td>
                                            <ul>
                                                @foreach ($vacancies as $vacancy)
                                                    <li>
                                                        @php
                                                            // Verificar si existe un registro sin deleted_at para este beneficio y beneficiario
                                                            $record = $courseofvacancy
                                                                ->where('course_id', $course->id)
                                                                ->where('vacancy_id', $vacancy->id)
                                                                ->whereNull('deleted_at')
                                                                ->first();
                                                            $isChecked = $record ? true : false;
                                                        @endphp

                                                        <label class="checkbox-container">
                                                            <input id="checkbox" class="hidden" type="checkbox"
                                                                name="vacancy_{{ $course->id }}_{{ $vacancy->id }}"
                                                                value="1"
                                                                data-record-id="{{ $record ? $record->id : '' }}"
                                                                {{ $isChecked ? 'checked' : '' }}>
                                                            <span class="checkbox" for="checkbox"></span>

                                                            {{ $vacancy->name }}
                                                        </label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>

            <div class="form-group">
                <label>Selecciona las vacantes:</label>
                @foreach ($vacancies as $vacancy)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="vacancies[]" value="{{ $vacancy->id }}"
                            id="vacancy_{{ $vacancy->id }}">
                        <label class="form-check-label">{{ $vacancy->name }}</label>
                    </div>
                @endforeach
            </div>

            <button type="button" id="assignButton" class="btn btn-primary">Asignar Vacantes</button>
        </form>
        <!-- Resto del contenido aquí -->
    </div>
@endsection

<<<<<<< HEAD
@section('scripts')
=======
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

>>>>>>> 173ebf99ac8432c1916d23239d034ad871c39dd8
    <script>
        'use strict';

        // Cuando se cambia la selección del curso, marcar automáticamente las vacantes relacionadas
        $('#course_id').on('change', function() {
            var courseId = $(this).val();
            $.ajax({
                url: '{{ route('company.vacant.get_associations') }}',
                method: 'GET',
                data: {
                    course_id: courseId
                },
                success: function(data) {
                    // Desmarcar todas las casillas de verificación
                    $('input[type="checkbox"]').prop('checked', false);
                    // Marcar solo las vacantes relacionadas
                    data.associations.forEach(function(vacancyId) {
                        $('#vacancy_' + vacancyId).prop('checked', true);
                    });
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
<<<<<<< HEAD

        // Captura el evento de clic en el botón "Asignar Vacantes"
        $('#assignButton').on('click', function() {
            // Recolecta los datos del formulario
            var formData = new FormData(document.getElementById('assignForm'));

            // Realiza una solicitud AJAX para guardar las relaciones
            $.ajax({
                url: '{{ route('company.vacant.curso_asociado') }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Manejar la respuesta del servidor, por ejemplo, mostrar un mensaje de éxito
                    if (response && response.mensaje) {
                        Swal.fire({
                            title: 'Éxito',
                            text: response.mensaje,
                            icon: 'success'
                        });
=======

        $(document).ready(function() {
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            $('input[type="checkbox"]').on('change', function() {
                const checkbox = $(this);
                const checkboxName = checkbox.attr('name');
                const [_, courseId, vacancyId] = checkboxName.split('_');
                const isChecked = checkbox.is(':checked');

                $.ajax({
                    url: '{{ route('company.vacant.curso_asociado') }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        course_id: courseId,
                        vacancy_id: vacancyId,
                        checked: isChecked ? 'true' : 'false',
                    },
                    success: function(response) {
                        console.log(response);
                        alert(response.success); // Display success message
                    },
                    error: function(error) {
                        console.error(error);
                        alert('Ocurrió un error al procesar la solicitud.');
>>>>>>> 173ebf99ac8432c1916d23239d034ad871c39dd8
                    }
                },
                error: function(error) {
                    // Manejar errores si es necesario
                    console.error(error);
                }
            });
        });
    </script>
@endsection
