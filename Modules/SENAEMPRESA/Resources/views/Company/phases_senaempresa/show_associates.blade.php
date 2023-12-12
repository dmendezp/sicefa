@extends('senaempresa::layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">{{ $title }}</div>
                    <div class="card-body">
                        <form id="association-form">
                            @csrf

                            <div class="form-group">
                                <label for="senaempresa_id">{{ trans('senaempresa::menu.Select a SenaEmpresa:') }}</label>
                                <select class="form-control" name="senaempresa_id" id="senaempresa_id">
                                    <option value="">{{ trans('senaempresa::menu.Select a SenaEmpresa:') }}</option>
                                    @foreach ($senaempresas as $senaempresa)
                                        <option value="{{ $senaempresa->id }}">{{ $senaempresa->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>{{ trans('senaempresa::menu.Select a course:') }}</label>
                                @foreach ($courses as $course)
                                    <div>
                                        @php
                                            // Verificar si existe una relación sin deleted_at para este curso y senaempresa
                                            $record = $courseofsenaempresa
                                                ->where('course_id', $course->id)
                                                ->where('senaempresa_id', $senaempresa->id)
                                                ->whereNull('deleted_at')
                                                ->first();
                                            $isChecked = $record ? true : false;
                                        @endphp

                                        <label class="checkbox-container">
                                            <input class="association-checkbox" type="checkbox"
                                                data-course-id="{{ $course->id }}" value="1"
                                                data-record-id="{{ $record ? $record->id : '' }}"
                                                {{ $isChecked ? 'checked' : '' }}>
                                            <span class="checkbox" for="checkbox"></span>

                                            {{ $course->code }} {{ $course->program->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Variable para almacenar el estado inicial de los checkboxes
            var initialCheckboxState = {};

            // Obtén el SenaEmpresa seleccionado y las relaciones asociadas (cursos)
            $('#senaempresa_id').change(function() {
                var senaempresaId = $(this).val();

                // Realiza una llamada Ajax para obtener las asociaciones
                $.ajax({
                    url: '{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.phases.get_associations') }}',
                    method: 'GET',
                    data: {
                        senaempresa_id: senaempresaId
                    },
                    success: function(data) {
                        // Almacena el estado inicial de los checkboxes
                        $('.association-checkbox').each(function() {
                            var courseId = $(this).data('course-id');
                            initialCheckboxState[courseId] = $(this).prop('checked');
                        });

                        // Marca los checkboxes según las asociaciones obtenidas
                        $('.association-checkbox').each(function() {
                            var courseId = $(this).data('course-id');
                            var isChecked = data.associations.includes(courseId);

                            // Marca el checkbox si está asociado y en su estado inicial estaba marcado
                            if (isChecked && initialCheckboxState[courseId]) {
                                $(this).prop('checked', true);
                            } else {
                                $(this).prop('checked', isChecked);
                            }
                        });
                    },
                    error: function(error) {
                        // Maneja errores, puedes mostrar mensajes de error si lo deseas.
                    }
                });
            });

            // Maneja los cambios en los checkboxes
            $('.association-checkbox').change(function() {
                var senaempresaId = $('#senaempresa_id').val();
                var courseId = $(this).data('course-id');
                var isChecked = $(this).prop('checked');

                $.ajax({
                    url: '{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.phases.associated_course') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        senaempresa_id: senaempresaId,
                        course_id: courseId,
                        checked: isChecked
                    },
                    success: function(data) {
                        // Maneja la respuesta del servidor, puedes mostrar mensajes si lo deseas.
                    },
                    error: function(error) {
                        // Maneja errores, puedes mostrar mensajes de error si lo deseas.
                        // Vuelve a restaurar el estado inicial del checkbox en caso de error
                        $(this).prop('checked', !isChecked);
                    }
                });
            });
        });
    </script>
@endsection
