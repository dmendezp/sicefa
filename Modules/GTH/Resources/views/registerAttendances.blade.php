@extends('gth::layouts.master')
<script>
    @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 1500,
                    customClass: {
                        popup: 'my-custom-popup-class',
                    },
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: '{{ session('error') }}',
                    showConfirmButton: false,
                    timer: 15000,
                    customClass: {
                        popup: 'my-custom-popup-class',
                    },
                });
            </script>
        @endif
</script>
@section('content')

    @section('content')
    <h1>Vista Registro de Asistencia</h1>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card card-primary card-outline shadow">
                        <div class="card-header">Registro de Asistencia</div>
                        <div class="card-body">
                            <form action="{{ route('cefa.registerattendance.store')}}" method="GET">
                            <div class="mb-3">
                                <label for="document_number"
                                    class="form-label">Numero Documento</label>
                                <input type="text" name="document_number" class="form-control" required>
                            </div>
                            <input type="hidden" name="person_id" id="person_id" value="">
                            <button type="submit" class="btn btn-warning"
                                id="show-hide-table-button">Registro Asistencia</button>

                            </form>
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
                        url: '',
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
                        url: '',
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
