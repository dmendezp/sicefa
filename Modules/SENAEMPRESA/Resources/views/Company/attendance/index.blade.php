@extends('senaempresa::layouts.master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">{{ trans('senaempresa::menu.Register attendance') }}</div>
                    <div class="card-body">
                        @if (Route::is('senaempresa.admin.*') ||
                                (Route::is('senaempresa.passant.*') &&
                                    Auth::user()->havePermission(
                                        'senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.attendances.register')))
                            <form
                                action="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.attendances.register') }}"
                                method="POST" id="form-element" enctype="multipart/form-data">
                                @csrf
                        @endif
                        <div class="mb-3">
                            <label for="document_number"
                                class="form-label">{{ trans('senaempresa::menu.document number:') }}</label>
                            <input type="text" name="document_number" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="person_name">{{ trans('senaempresa::menu.Name of individual:') }}</label>
                            <input type="text" name="person_name" class="form-control" readonly>
                        </div>
                        <input type="hidden" name="person_id" id="person_id" value="">
                        @if (Route::is('senaempresa.admin.*') ||
                                (Route::is('senaempresa.passant.*') &&
                                    Auth::user()->havePermission(
                                        'senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.attendances.register')))
                            <button type="submit"
                                class="btn btn-primary">{{ trans('senaempresa::menu.Register attendance') }}</button>
                        @endif
                        <button type="button" class="btn btn-success" id="query-attendance-button">
                            {{ trans('senaempresa::menu.Consult Attendances') }}
                        </button>
                        <button type="button" class="btn btn-warning"
                            id="show-hide-table-button">{{ trans('senaempresa::menu.Registered Attendance') }}</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" id="attendance-query-results" style="display: none;">
        <h1 class="text-center">
            <strong><em><span>{{ trans('senaempresa::menu.Registered Attendance') }}</span></em></strong>
        </h1>
        <div class="col-md-12">
            <div class="card card-primary card-outline shadow">
                <div class="card-body">
                    <table id="attendance-query-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>{{ trans('senaempresa::menu.Name') }}</th>
                                <th>{{ trans('senaempresa::menu.Document') }}</th>
                                <th>{{ trans('senaempresa::menu.Date and Time of Entry') }}</th>
                                <th>{{ trans('senaempresa::menu.Date and time of departure') }}</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="container" id="attendance-table-container" style="display: none;">
        <h1 class="text-center">
            <strong><em><span>{{ trans('senaempresa::menu.Registered Attendance') }}</span></em></strong>
        </h1>
        <div class="col-md-12">
            <div class="card card-primary card-outline shadow">
                <div class="card-body">
                    <table id="attendance-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>{{ trans('senaempresa::menu.Name') }}</th>
                                <th>{{ trans('senaempresa::menu.Document') }}</th>
                                <th>{{ trans('senaempresa::menu.Date and Time of Entry') }}</th>
                                <th>{{ trans('senaempresa::menu.Date and time of departure') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $attendance)
                                <tr>
                                    <td>{{ $attendance->staffSenaempresa->apprentice->person->full_name }}</td>
                                    <td>{{ $attendance->staffSenaempresa->apprentice->person->document_number }}</td>
                                    <td>{{ $attendance->start_datetime }}</td>
                                    <td>{{ $attendance->end_datetime }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#attendance-table').DataTable({});

            $('input[name="document_number"]').on('input', function() {
                var documentNumber = $(this).val();

                $.ajax({
                    url: '{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.attendances.getPersonData') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        document_number: documentNumber
                    },
                    success: function(response) {
                        if (response && response.is_registered) {
                            var personId = response.id;
                            var name = response.full_name;

                            $('input[name="person_name"]').val(name);
                            console.log("ID de la persona: " + personId);
                            console.log("NAME de la persona: " + name);
                            $('input[name="person_id"]').val(personId);
                        }
                    },
                });
            });

            $('#query-attendance-button').on('click', function() {
                var documentNumber = $('input[name="document_number"]').val();

                $.ajax({
                    url: '{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.attendances.queryAttendance') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        document_number: documentNumber
                    },
                    success: function(response) {
                        if (response && response.attendances) {
                            $('#attendance-query-results').show();
                            $('#attendance-query-table tbody').empty();

                            $.each(response.attendances, function(index, attendance) {
                                var row = $('<tr>');
                                row.append($('<td>').text(attendance.name));
                                row.append($('<td>').text(attendance.document_number));
                                row.append($('<td>').text(attendance.start_datetime));
                                row.append($('<td>').text(attendance.end_datetime));
                                $('#attendance-query-table tbody').append(row);
                            });

                            $('#attendance-query-table').DataTable();
                        } else {
                            console.log('No attendances found or an error occurred.');
                        }
                    },
                });
            });
        });


        $(document).ready(function() {
            $('#attendance-table').DataTable();

            // Agregar un evento clic al botón "Asistencias Registradas"
            $('#show-hide-table-button').on('click', function() {
                // Obtener el contenedor de la tabla
                var tableContainer = $('#attendance-table-container');

                // Toggle (mostrar/ocultar) la tabla
                tableContainer.toggle();

                // Si la tabla se muestra, inicializa el DataTable
                if (tableContainer.is(':visible')) {
                    $('#attendance-table').DataTable().draw();
                }
            });
        });
    </script>
@endsection
