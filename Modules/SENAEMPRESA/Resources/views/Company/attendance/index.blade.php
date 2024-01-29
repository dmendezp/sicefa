@extends('senaempresa::layouts.master')

@section('content')
    @if (
        (Auth::check() && Auth::user()->roles[0]->slug === 'senaempresa.admin') ||
            (Auth::check() && Auth::user()->roles[0]->slug === 'senaempresa.human_talent_leader') ||
            Route::is('senaempresa.admin.*') ||
            Route::is('senaempresa.human_talent_leader.*'))
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
                                <label for="senaempresa_id"
                                    class="form-label">{{ trans('senaempresa::menu.Select a Phase') }}</label>
                                <select class="form-control" name="senaempresa_id" id="senaempresa-select" required>
                                    <option value="" selected>{{ trans('senaempresa::menu.Select a Phase') }}</option>
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
                            <input type="hidden" name="person_id" id="person_id" value="">
                            @if (Route::is('senaempresa.admin.*') ||
                                    (Route::is('senaempresa.human_talent_leader.*') &&
                                        Auth::user()->havePermission(
                                            'senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.attendances.register')))
                                <button type="submit"
                                    class="btn btn-primary">{{ trans('senaempresa::menu.Register ') }}</button>
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
                                <button type="button" class="btn btn-danger"
                                    id="report-hide-table-button">{{ trans('senaempresa::menu.Report') }}</button>
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
                        <div class="excel">
                        </div>
                        <table id="attendance-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ trans('senaempresa::menu.Name') }}</th>
                                    <th>{{ trans('senaempresa::menu.Document') }}</th>
                                    <th>{{ trans('senaempresa::menu.Date and Time of Entry') }}</th>
                                    <th>{{ trans('senaempresa::menu.Date and time of departure') }}</th>
                                    <th>Duración</th>
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
                                        <td>{{ $attendance->duration }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" id="reporte-table-container" style="display: none;">
            <h1 class="text-center">
                <strong><em><span>Reporte</span></em></strong>
            </h1>
            <div class="col-md-12">
                <div class="card card-primary card-outline shadow">
                    <div class="card-body">
                        <div class="excel">
                        </div>
                        <table id="reporte-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ trans('senaempresa::menu.Name') }}</th>
                                    <th>{{ trans('senaempresa::menu.Document') }}</th>
                                    <th>Duración Total</th>
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
                                        <td>{{ $attendance->duration }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                var attendanceTable = $('#attendance-table').DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": [{
                        extend: 'excel',
                        text: 'Exportar a Excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3,
                                4
                            ] // Ajusta los índices de columna según tu estructura
                        }
                    }]
                });
                attendanceTable.buttons().container().appendTo('#attendance-table-container .excel');

                // Inicializar DataTable para la tabla "reporte-table"
                var reporteTable = $('#reporte-table').DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": [{
                        extend: 'excel',
                        text: 'Exportar a Excel',
                        exportOptions: {
                            columns: [0, 1, 2] // Ajusta los índices de columna según tu estructura
                        }
                    }]
                });
                reporteTable.buttons().container().appendTo('#reporte-table-container .excel');


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
                                    text: '{{ trans('senaempresa::menu.There are no attendances registered for this document') }}',
                                    showConfirmButton: false,
                                    timer: 3000 // Tiempo en milisegundos (2 segundos en este caso)
                                });
                            }
                        },
                    });
                });

                $('#show-hide-table-button').on('click', function() {
                    // Get the selected Senaempresa ID
                    var selectedSenaempresaId = $('#senaempresa-select').val();

                    // Check if a Senaempresa is selected
                    if (selectedSenaempresaId) {
                        // Make an AJAX request to fetch attendances for the selected Senaempresa
                        $.ajax({
                            url: '{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.attendances.loadAttendancesBySenaempresa') }}',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                senaempresa_id: selectedSenaempresaId
                            },
                            success: function(response) {
                                // Check if the response contains attendances
                                if (response && response.attendances && response.attendances
                                    .length > 0) {
                                    // Display the DataTable if there are attendances
                                    $('#attendance-table-container').show();
                                    $('#attendance-table tbody').empty();

                                    $.each(response.attendances, function(index, attendance) {
                                        var row = $('<tr>');
                                        row.append($('<td>').text(attendance.name));
                                        row.append($('<td>').text(attendance
                                            .document_number));
                                        row.append($('<td>').text(attendance
                                            .start_datetime));
                                        row.append($('<td>').text(attendance.end_datetime));
                                        row.append($('<td>').text(attendance.duration));
                                        $('#attendance-table tbody').append(row);
                                    });

                                    // Initialize DataTable only if there are attendances
                                    $('#attendance-table').DataTable();
                                } else {
                                    // Show a message if there are no attendances
                                    Swal.fire({
                                        icon: 'info',
                                        title: 'Info',
                                        text: '{{ trans('senaempresa::menu.There are no attendances registered for this document') }}',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error("Error en la solicitud AJAX: " + error);
                            }
                        });
                    } else {
                        // Show a message if no Senaempresa is selected
                        Swal.fire({
                            icon: 'warning',
                            title: '{{ trans('senaempresa::menu.Warning') }}',
                            text: '{{ trans('senaempresa::menu.Please select a Senaempresa before consulting the assistances.') }}',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                });

                $('#report-hide-table-button').on('click', function() {
                    // Get the selected Senaempresa ID
                    var selectedSenaempresaId = $('#senaempresa-select').val();

                    // Check if a Senaempresa is selected
                    if (selectedSenaempresaId) {
                        // Make an AJAX request to fetch report data for the selected Senaempresa
                        $.ajax({
                            url: '{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.attendances.loadReportBySenaempresa') }}',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                senaempresa_id: selectedSenaempresaId
                            },
                            success: function(response) {
                                // Check if the response contains report data
                                if (response && response.reportData && response.reportData.length >
                                    0) {
                                    // Display the DataTable if there is report data
                                    $('#reporte-table-container').show();
                                    $('#reporte-table tbody').empty();

                                    $.each(response.reportData, function(index, report) {
                                        var row = $('<tr>');
                                        row.append($('<td>').text(report.name));
                                        row.append($('<td>').text(report.document_number));
                                        row.append($('<td>').text(report.duration_total));
                                        $('#reporte-table tbody').append(row);
                                    });

                                    // Initialize DataTable only if there is report data
                                    $('#reporte-table').DataTable();
                                } else {
                                    // Show a message if there is no report data
                                    Swal.fire({
                                        icon: 'info',
                                        title: 'Info',
                                        text: '{{ trans('senaempresa::menu.There is no reporting data for the selected Senaempresa') }}',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error("Error en la solicitud AJAX: " + error);
                            }
                        });
                    } else {
                        // Show a message if no Senaempresa is selected
                        Swal.fire({
                            icon: 'warning',
                            title: '{{ trans('senaempresa::menu.Warning') }}',
                            text: '{{ trans('senaempresa::menu.Please select a Senaempresa before consulting the report.') }}',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                });

            });
        </script>
    @elseif(
        (Auth::check() && Auth::user()->roles[0]->slug === 'senaempresa.apprentice') ||
            Route::is('senaempresa.apprentice.*'))
        <div class="container">
            <h1 class="text-center">
                <strong><em><span>{{ trans('senaempresa::menu.Registered Attendance') }}</span></em></strong>
            </h1>
            <div class="col-md-12">
                <div class="card card-primary card-outline shadow">
                    <div class="card-body">
                        <div class="excel">
                        </div>
                        <table id="attendance-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ trans('senaempresa::menu.Name') }}</th>
                                    <th>{{ trans('senaempresa::menu.Document') }}</th>
                                    <th>{{ trans('senaempresa::menu.Date and Time of Entry') }}</th>
                                    <th>{{ trans('senaempresa::menu.Date and time of departure') }}</th>
                                    <th>Duración</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendances_apprentice as $attendance)
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
                                        <td>{{ $attendance->duration }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                var attendanceTable = $('#attendance-table').DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": [{
                        extend: 'excel',
                        text: 'Export to Excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    }]
                });
                attendanceTable.buttons().container().appendTo('#attendance-table-container .excel');
            });
        </script>
    @endif
@endsection
