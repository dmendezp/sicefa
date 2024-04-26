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
                                        <option value="{{ $course->id }}">{{ $course->code }}
                                            {{ $course->program->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>{{ trans('senaempresa::menu.Select Vacancies') }}</label>
                                @foreach ($vacancies as $vacancy)
                                    <div>
                                        <label class="checkbox-container">
                                            <input class="association-checkbox" type="checkbox"
                                                data-vacancy-id="{{ $vacancy->id }}" value="1">
                                            <span class="checkbox" for="checkbox"></span>
                                            {{ $vacancy->name }}
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
                    $('.association-checkbox[data-vacancy-id="' + association + '"]').prop('checked', true);
                });
            }

            $('#course_id').change(function() {
                var courseId = $(this).val();

                $.ajax({
                    url: '{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.vacancies.get_associations') }}',
                    method: 'GET',
                    data: {
                        course_id: courseId
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
                var courseId = $('#course_id').val();
                var vacancyId = $(this).data('vacancy-id'); // Use data-vacancy-id
                var isChecked = $(this).prop('checked');

                $.ajax({
                    url: '{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.vacancies.show_associates') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        course_id: courseId,
                        vacancy_id: vacancyId,
                        checked: isChecked
                    },
                    success: function(data) {
                        // Show a user alert
                        Swal.fire({
                            icon: 'success',
                            title: '{{ trans('senaempresa::menu.Success') }}',
                            text: data.success,
                        });
                    },
                    error: function(error) {
                        // Show an error alert to the user
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
