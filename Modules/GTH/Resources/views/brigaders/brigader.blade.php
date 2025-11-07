@extends('gth::layouts.master')

@section('content')
    <div class="container-fluid">
        <h1>Vista Asistencia de Brigadista <i class="fas fa-pizza-slice"></i></h1>

        <div class="row justify-content-md-center pt-4">
            <div class="card shadow col-md-8">
                <div class="card-body">

                    <!-- Formulario de filtro -->
                    <form method="GET" action="">
                        @csrf
                        <div class="form-group col-md-6">
                            <label for="documento">Documento</label>
                            <input type="text" name="documento" id="documento" class="form-control">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" id="nombre" class="form-control">
                            </div>
                        </div>

                        <!-- Otros campos de filtro según tus necesidades -->

                        <button type="submit" class="btn btn-primary">Filtrar</button>
                    </form>

                    <!-- Cuadro con la tabla -->
                    <div class="table-responsive">
                        <table id="datatable" class="table mt-4" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Aprendices</th>
                                    <th>Numero Documento</th>
                                    <th>Programa</th>
                                    <th>Code</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Itera sobre los datos y muestra en la tabla -->
                                 @foreach($datos as $dato)
                                    <tr>
                                        <td>{{ $dato->aprendiz }}</td>
                                        <td>{{ $dato->numero_documento }}</td>
                                        <td>{{ $dato->programa }}</td>
                                        <td>{{ $dato->code }}</td>
                                    </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Agrega el script JavaScript aquí -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Escuchar cambios en el elemento select
            $('#porcentaje').change(function() {
                var selectedPorcentaje = $(this).val();

                // Mostrar todos los registros cuando no se selecciona un porcentaje específico
                if (selectedPorcentaje === "") {
                    $('#datatable tbody tr').show();
                } else {
                    // Ocultar todas las filas de la tabla
                    $('#datatable tbody tr').hide();

                    // Mostrar solo las filas que coinciden con el porcentaje seleccionado
                    $('#datatable tbody tr').each(function() {
                        if ($(this).find('td:nth-child(6)').text() === selectedPorcentaje) {
                            $(this).show();
                        }
                    });
                }
            });
        });
    </script>
@endsection
