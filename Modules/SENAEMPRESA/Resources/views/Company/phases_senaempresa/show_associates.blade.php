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
                                        <label class="checkbox-container">
                                            <input class="association-checkbox" type="checkbox"
                                                data-course-id="{{ $course->id }}" value="1">
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
            function updateCheckboxes(associations) {
                $('.association-checkbox').prop('checked', false);
                associations.forEach(function(association) {
                    $('.association-checkbox[data-course-id="' + association + '"]').prop('checked', true);
                });
            }

            $('#senaempresa_id').change(function() {
                var senaempresaId = $(this).val();

                $.ajax({
                    url: '{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.phases.get_associations') }}',
                    method: 'GET',
                    data: {
                        senaempresa_id: senaempresaId
                    },
                    success: function(data) {
                        updateCheckboxes(data.associations);
                    },
                    error: function(error) {
                        // Handle errors
                    }
                });
            });

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
                        // Muestra una alerta al usuario
                        Swal.fire({
                            icon: 'success',
                            title: '{{ trans('senaempresa::menu.Success') }}',
                            text: data.success,
                        });
                    },
                    error: function(error) {
                        // Muestra una alerta de error al usuario
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: '{{ trans('senaempresa::menu.An error occurred while processing the request.') }}',
                        });
                        $(this).prop('checked', !isChecked);
                    }
                });
            });
        });
    </script>
@endsection