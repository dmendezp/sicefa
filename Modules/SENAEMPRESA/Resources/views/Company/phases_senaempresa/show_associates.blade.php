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
                                <label for="course_id">{{ trans('senaempresa::menu.Select a course:') }}</label>
                                <select class="form-control" name="course_id" id="course_id">
                                    <option value="">{{ trans('senaempresa::menu.Select a course:') }}
                                    </option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->code }} {{ $course->program->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @foreach ($senaempresas as $senaempresa)
                                <li>
                                    @php
                                        // Verificar si existe una relación sin deleted_at para este curso y vacante
                                        $record = $courseofsenaempresa
                                            ->where('course_id', $course->id) // Cambia $course por $course_id
                                            ->where('senaempresa_id', $senaempresa->id)
                                            ->whereNull('deleted_at')
                                            ->first();
                                        $isChecked = $record ? true : false;
                                    @endphp

                                    <label class="checkbox-container">
                                        <input class="association-checkbox" type="checkbox"
                                            data-senaempresa-id="{{ $senaempresa->id }}" value="1"
                                            data-record-id="{{ $record ? $record->id : '' }}"
                                            {{ $isChecked ? 'checked' : '' }}>
                                        <span class="checkbox" for="checkbox"></span>

                                        {{ $senaempresa->name }}
                                    </label>
                                </li>
                            @endforeach


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

            // Obtén el curso seleccionado y las relaciones asociadas (vacantes)
            $('#course_id').change(function() {
                var courseId = $(this).val();

                // Realiza una llamada Ajax para obtener las asociaciones
                $.ajax({
                    url: '{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.phases.get_associations') }}',
                    method: 'GET',
                    data: {
                        course_id: courseId
                    },
                    success: function(data) {
                        // Almacena el estado inicial de los checkboxes
                        $('.association-checkbox').each(function() {
                            var senaempresaId = $(this).data('senaempresa-id');
                            initialCheckboxState[senaempresaId] = $(this).prop(
                                'checked');
                        });

                        // Marca los checkboxes según las asociaciones obtenidas
                        $('.association-checkbox').each(function() {
                            var senaempresaId = $(this).data('senaempresa-id');
                            var isChecked = data.associations.includes(senaempresaId);

                            // Marca el checkbox si está asociado y en su estado inicial estaba marcado
                            if (isChecked && initialCheckboxState[senaempresaId]) {
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
                var courseId = $('#course_id').val();
                var senaempresaId = $(this).data('senaempresa-id');
                var isChecked = $(this).prop('checked');

                $.ajax({
                    url: '{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.phases.associated_course') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        course_id: courseId,
                        senaempresa_id: senaempresaId,
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
