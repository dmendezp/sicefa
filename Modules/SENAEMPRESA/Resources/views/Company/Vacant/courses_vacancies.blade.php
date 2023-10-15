@extends('senaempresa::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center pt-4">
            <div class="card card-primary card-outline shadow col-md-8">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                </div>
                <div class="card-body">
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
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"
        integrity="sha512-F636MAkMAhtTplahL9F6KmTfxTmYcAcjcCkyu0f0voT3N/6vzAuJ4Num55a0gEJ+hRLHhdz3vDvZpf6kqgEa5w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(function() {
            $("#pivote").DataTable({
                "responsive": true,
                "autoWidth": false,
                language: {
                    "search": "Buscar:",
                    "Show": "Mostrar",
                    "entries": "Registros",
                }
            });

        });
        $(document).ready(function() {
            // Obtener el token CSRF desde la etiqueta meta en tu vista Blade
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Manejar el evento change de los checkboxes
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
                        checked: isChecked,
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endsection
