@extends('senaempresa::layouts.master')

<!-- resources/views/asistencia/index.blade.php -->

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">{{ trans('senaempresa::menu.Register attendance') }}</div>
                    <div class="card-body">
                        <form action="{{ route('attendance.register') }}" method="POST" enctype="multipart/form-data">
                            @csrf
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
                            <button type="submit"
                                class="btn btn-primary">{{ trans('senaempresa::menu.Register attendance') }}</button>
                            <button type="button" class="btn btn-success"
                                id="show-hide-table-button">{{ trans('senaempresa::menu.Registered Attendance') }}</button>

                        </form>
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
                                        <td>{{ $attendance->staffSenaempresa->apprentice->person->first_name }}
                                            {{ $attendance->staffSenaempresa->apprentice->person->first_last_name }}
                                            {{ $attendance->staffSenaempresa->apprentice->person->second_last_name }}</td>
                                        <td>{{ $attendance->staffSenaempresa->apprentice->person->document_number }}
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
            $('#attendance-table').DataTable();

            // Agrega un evento input al campo document_number
            $('input[name="document_number"]').on('input', function() {
                var documentNumber = $(this).val();

                // Realiza la petición AJAX
                $.ajax({
                    url: '{{ route('getPersonData') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        document_number: documentNumber
                    },
                    success: function(response) {
                        // Verifica si se encontró una persona
                        if (response) {
                            // Obtiene el ID de la persona del objeto response
                            var personId = response.id;
                            var name = response.full_name;

                            // Actualiza el valor del campo de nombre de persona
                            $('input[name="person_name"]').val(name);

                            // Aquí puedes manipular el ID como desees
                            console.log("ID de la persona: " + personId);
                            console.log("NAME de la persona: " + name);

                            // Por ejemplo, si quieres asignar el ID a un campo oculto en el formulario
                            $('input[name="person_id"]').val(personId);
                        } else {
                            // Si no se encontró una persona, puedes mostrar un mensaje de error o realizar otras acciones
                            console.log("Persona no encontrada");
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
