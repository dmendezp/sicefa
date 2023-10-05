@extends('senaempresa::layouts.master')

<!-- resources/views/asistencia/index.blade.php -->

@section('content')
    <div class="container">
        <h1>Registrar Asistencia</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('attendance.register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="document_number">Número de Documento:</label>
                <input type="text" name="document_number" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="person_name">Nombre de la Persona:</label>
                <input type="text" name="person_name" class="form-control" readonly>
            </div>
            <input type="hidden" name="person_id" id="person_id" value="">
            <input type="hidden" name="person_id" id="person_id" value="">
            <button type="submit" class="btn btn-primary">Registrar Asistencia</button>
        </form>

        <h2>Asistencia Registrada</h2>
        <table id="attendance-table" class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Documento</th>
                    <th>Fecha y Hora de Entrada</th>
                    <th>Fecha y Hora de Salida</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $attendance)
                    <tr>
                        <td>{{ $attendance->staffSenaempresa->apprentice->person->first_name }}</td>
                        <td>{{ $attendance->staffSenaempresa->apprentice->person->document_number }}</td>
                        <td>{{ $attendance->start_datetime }}</td>
                        <td>{{ $attendance->end_datetime }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
    </script>
@endsection
