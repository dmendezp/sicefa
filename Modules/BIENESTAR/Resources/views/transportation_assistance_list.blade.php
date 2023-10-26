@extends('bienestar::layouts.master')

@section('content')
    <div class="container-fluid" style="max-width:1200px"> 
        
        <div class="row justify-content-md-center pt-4"> 
            <div class="col-md-12"> 
            </div> 
                <div class="box"> 
                    <div class="box-header with-border"> 
                        <h3 class="box-title">Asistencia De Transporte <i class="fas fa-bus"></i></h3> 
                    </div>
                    <div class="box-body">
                        <!-- Contenido de la vista en un solo card -->
                        <div class="card shadow col-md-12">
                            <div class="card-body text-center"> <!-- Centramos el contenido en el card verticalmente -->

                                <!-- Barra de búsqueda de documentos -->
                                <div class="form-group d-flex justify-content-center align-items-center">
                                    <form action="{{ route('cefa.bienestar.searchattendancetransport') }}" method="POST">
                                        @csrf
                                        <div class="row bg-white rounded p-2">
                                            <!-- Cambiamos el color a blanco y añadimos bordes redondeados y relleno -->
                                            <div class="col-8">
                                                <!-- Cambiamos de "col-md-8" a "col-8" para hacerlo más ancho y adaptativo -->
                                                <input type="number" name="document_number" class="form-control"
                                                    id="documento_search" placeholder="Buscar documento" required>
                                            </div>
                                            <div class="col-4">
                                                <input type="submit" value="Consultar" class="btn btn-primary">
                                                <!-- Añadimos estilos de botón -->
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @if (isset($person))
                                    <table class="table table-bordered table-striped" id="resultados_table">
                                        <thead>
                                            <tr>
                                                <th>Aprendiz</th>
                                                <th>Número de Documento</th>
                                                <th>Programa</th>
                                                <th>Ficha</th>
                                                <th>ruta de transporte</th>
                                                <th>Convocatoria</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($person->apprentices as $apprentice)
                                                <tr>
                                                    <td>{{ $person->full_name }}</td>
                                                    <td>{{ $person->document_number }}</td>
                                                    <td>{{ $apprentice->course->program->name }}</td>
                                                    <td>{{ $apprentice->course->code }}</td>
                                                    <td>
                                                        @if ($apprentice->assigntransoportroutes->isNotEmpty())
                                                            @foreach ($apprentice->assigntransoportroutes as $assigntransoportroute)
                                                                <ul>
                                                                    <li>
                                                                        {{ $assigntransoportroute->routes_trasportantion->name_route }}
                                                                    </li>
                                                                </ul>
                                                            @endforeach
                                                        @else
                                                            Sin beneficios asociados
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($apprentice->assigntransoportroutes->isNotEmpty())
                                                            @foreach ($apprentice->assigntransoportroutes as $assigntransoportroute)
                                                                <ul>
                                                                    <li>
                                                                        {{ $assigntransoportroute->convocations->name }}
                                                                    </li>
                                                                </ul>
                                                            @endforeach
                                                        @else
                                                            Sin convocatoria
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="text-center">No se ha encontrado resultados</div>
                                @endif
                            </div>
                        </div>
                        <!-- Fin del contenido en un solo card -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- <script>
    $(document).ready(function() {
    $('#resultados_table').DataTable();
    // Agrega un evento input al campo document_number
    $('#documento_search').on('input', function() {
        var documentNumber = $(this).val();
        // Realiza la petición AJAX
        $.ajax({
            url: '{{ route('cefa.bienestar.search') }}',
            method: 'GET',
            data: {
                _token: '{{ csrf_token() }}',
                document_number: documentNumber
            },
            success: function(response) {
                console.log(response);
                // Limpia el cuerpo de la tabla
                $('#resultados_table tbody').empty();
                // Verifica si se encontró una persona
                if (response) {
                    // Recorre todos los aprendices y sus postulaciones
                    for (var i = 0; i < response.apprentices.length; i++) {
                        var apprentice = response.apprentices[i];
                        
                        // Agrega los datos de la persona a la tabla
                        var row = '<tr>' +
                            '<td>' + response.first_name + ' ' + response.first_last_name + ' ' + response.second_last_name + '</td>' +
                            '<td>' + response.document_number + '</td>' +
                            '<td>' + apprentice.course.program.name + '</td>' +
                            '<td>' + apprentice.course.code + '</td>';
                            '<td>' + apprentice.postulations + '</td>';
                        // Verifica si hay postulaciones
                        if (response && response.apprentices && response.apprentices.length > 0) {
                            // Recorre las postulaciones del aprendiz
                            
                            var benefits = '';
                            for (var j = 0; j < apprentice.postulations.length; j++) {
                                // Obtiene el nombre del beneficio de cada postulación
                                var benefitName = apprentice.postulations[j].postulationBenefits[0].benefit.name;
                                benefits += benefitName + ', ';
                            }
                            // Elimina la última coma y espacio
                            benefits = benefits.slice(0, -2);
                            row += '<td>' + benefits + '</td>';
                        } else {
                            // Si no hay postulaciones, muestra un mensaje
                            row += '<td>Sin postulaciones</td>';
                        }
                        row += '</tr>';
                        $('#resultados_table tbody').append(row);
                    }
                } else {
                    // Si no se encontró una persona, puedes mostrar un mensaje de error o realizar otras acciones
                    $('#resultados_table tbody').html('<tr><td colspan="5">No se encontraron resultados</td></tr>');
                }
            },
            error: function() {
                // Maneja los errores de la petición AJAX
                $('#resultados_table tbody').html('<tr><td colspan="5">Error en la búsqueda</td></tr>');
            }
        });
    });
});
</script> --}}
@endsection
