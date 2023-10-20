@extends('senaempresa::layouts.master')

@section('content')
    <div class="container mt-5">
        <!-- Resto del contenido aquí -->
        <form id="assignForm">
            <div class="form-group">
                <label for="course_id">Selecciona un curso:</label>
                <select class="form-control" name="course_id" id="course_id">
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->id }} - {{ $course->code }}
                            {{ $course->program->name }}</option>
                    @endforeach
                </select>
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

@section('scripts')
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
