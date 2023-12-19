@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">{{ trans('senaempresa::menu.Register attendance') }}</div>
                    <div class="card-body">
                        @if (Route::is('senaempresa.admin.*') ||
                                (Route::is('senaempresa.human_talent_leader.*') &&
                                    Auth::user()->havePermission(
                                        'senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.attendances.register')))
                            <form
                                action="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.attendances.register') }}"
                                method="POST" id="form-element" enctype="multipart/form-data">
                                @csrf
                        @endif
                        <div class="mb-3">
                            <label for="senaempresa_id" class="form-label">Selecciona una Fase (Senaempresa)</label>
                            <select class="form-control" name="senaempresa_id" id="senaempresa-select" required>
                                <option value="" selected>Selecciona una Fase</option>
                                @foreach ($senaempresas as $senaempresa)
                                    <option value="{{ $senaempresa->id }}">{{ $senaempresa->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="document_number"
                                class="form-label">{{ trans('senaempresa::menu.document number:') }}</label>
                            <input type="text" name="document_number" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="person_name">{{ trans('senaempresa::menu.Name of individual:') }}</label>
                            <input type="text" name="person_name" class="form-control" readonly>
                        </div>
                        <input type="text" name="person_id" id="person_id" value="">
                        @if (Route::is('senaempresa.admin.*') ||
                                (Route::is('senaempresa.human_talent_leader.*') &&
                                    Auth::user()->havePermission(
                                        'senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.attendances.register')))
                            <button type="submit"
                                class="btn btn-primary">{{ trans('senaempresa::menu.Register attendance') }}</button>
                        @endif
                        <button type="button" class="btn btn-success" id="query-attendance-button">
                            {{ trans('senaempresa::menu.Consult Attendances') }}
                        </button>
                        @if (Route::is('senaempresa.admin.*') ||
                                (Route::is('senaempresa.human_talent_leader.*') &&
                                    Auth::user()->havePermission(
                                        'senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.attendances.register')))
                            <button type="button" class="btn btn-warning"
                                id="show-hide-table-button">{{ trans('senaempresa::menu.Registered Attendance') }}</button>
                        @endif
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
                                    <td>
                                        @if (
                                            $attendance->staffSenaempresa &&
                                                $attendance->staffSenaempresa->apprentice &&
                                                $attendance->staffSenaempresa->apprentice->person)
                                            {{ $attendance->staffSenaempresa->apprentice->person->full_name }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if (
                                            $attendance->staffSenaempresa &&
                                                $attendance->staffSenaempresa->apprentice &&
                                                $attendance->staffSenaempresa->apprentice->person)
                                            {{ $attendance->staffSenaempresa->apprentice->person->document_number }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
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

            $('#senaempresa-select').on('change', function() {
                var selectedSenaempresaId = $(this).val();

                if (selectedSenaempresaId) {
                    // Realizar una solicitud AJAX para obtener el personal de la fase seleccionada
                    $.ajax({
                        url: '{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.attendances.loadStaffBySenaempresa') }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            senaempresa_id: selectedSenaempresaId
                        },
                        success: function(response) {
                            // Llenar el input de personal con la respuesta
                            var staffInput = $('input[name="person_name"]');
                            var personIdInput = $('input[name="person_id"]');

                            if (response && response.staff && response.staff.name) {
                                staffInput.val(response.staff.name);
                                personIdInput.val(response.staff.id);
                            } else {
                                staffInput.val('N/A');
                                personIdInput.val('');
                            }

                            // Mostrar el contenedor de personal
                            $('#staff-container').show();
                        }
                    });
                } else {
                    // Ocultar el contenedor de personal si no se ha seleccionado ninguna fase
                    $('#staff-container').hide();
                }
            });

            $('input[name="document_number"]').on('input', function() {
                var documentNumber = $(this).val();
                var selectedSenaempresaId = $('#senaempresa-select').val();

                $.ajax({
                    url: '{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.attendances.loadStaffBySenaempresa') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        senaempresa_id: selectedSenaempresaId,
                        document_number: documentNumber
                    },
                    success: function(response) {
                        // Log de información
                        console.log(response); // Agrega este log para verificar la respuesta
                        console.log("Senaempresa ID: " + selectedSenaempresaId);
                        console.log("Staff: " + JSON.stringify(response.staff));

                        // Verifica si la respuesta contiene la información esperada
                        if (response && response.staff && response.staff.name) {
                            console.log("Nombre de la persona: " + response.staff.name);
                            console.log("ID de la persona: " + response.staff.id);

                            // Resto del código...
                            var staffInput = $('input[name="person_name"]');
                            var personIdInput = $('input[name="person_id"]');

                            staffInput.val(response.staff.name);
                            personIdInput.val(response.staff.id);

                            // Mostrar el contenedor de personal
                            $('#staff-container').show();
                        } else {
                            console.log("La respuesta no contiene la información esperada");

                            // Si no hay personal asociado, establece los valores en N/A y oculta el contenedor
                            var staffInput = $('input[name="person_name"]');
                            var personIdInput = $('input[name="person_id"]');

                            staffInput.val('N/A');
                            personIdInput.val('');

                            $('#staff-container').hide();
                        }
                    },
                    // Manejo de errores (puedes agregar esto si lo necesitas)
                    error: function(xhr, status, error) {
                        console.error("Error en la solicitud AJAX: " + error);
                    }
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
                        if (response && response.attendances && response.attendances.length >
                            0) {
                            // Display the DataTable if there are attendances
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

                            // Initialize DataTable only if there are attendances
                            $('#attendance-query-table').DataTable();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'No hay asistencias registradas para este documento',
                                showConfirmButton: false,
                                timer: 3000 // Tiempo en milisegundos (2 segundos en este caso)
                            });
                        }
                    },
                });
            });

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
