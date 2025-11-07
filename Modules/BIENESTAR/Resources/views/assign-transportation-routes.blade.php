@extends('bienestar::layouts.master')

@section('content')
    <div class="container">
        <h1>Lista de Asignaciones de Rutas de Transporte</h1>

        <!-- Agregar un select para filtrar-->
        <div class="form-group">
            <label for="filtroRutas">Filtrar por Ruta de Transporte:</label>
            <select id="filtroRutas" class="form-control form-control-sm">
                <option value="">Todas las rutas</option>
                @foreach ($rutas as $ruta)
                    <option value="{{ $ruta->name_route }}">{{ $ruta->name_route }}</option>
                @endforeach
            </select>
        </div>      

        <table id="datatable" class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Aprendiz</th>
                    <th>Numero de Documento</th>
                    <th>Ruta de Transporte</th>
                    <!-- Agrega más encabezados según tus campos -->
                </tr>
            </thead>
            <tbody>
                @foreach ($asignaciones as $asignacion)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if ($apprentice = \Modules\SICA\Entities\Apprentice::with('person')->find($asignacion->apprentice_id))
                                {{ $apprentice->person->full_name }}
                            @else
                                Aprendiz no encontrado
                            @endif
                        </td>
                        <td>
                            @if ($apprentice)
                                {{ $apprentice->person->document_number }}
                            @else
                                Aprendiz no encontrado
                            @endif
                        </td>
                        <td>{{ $asignacion->route_transportation_id->name_route }}</td>
                        
                        <!-- Agrega más columnas según tus campos -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('script')

<script>
  $(document).ready(function() {
    $('#filtroRutas').on('change', function() {
        var rutaSeleccionada = $(this).val();

        $('#datatable tbody tr').each(function() {
            var celdaRuta = $(this).find('td:eq(3)').text(); // Ajusta el índice según la posición real en tu tabla
            if (rutaSeleccionada === '' || celdaRuta === rutaSeleccionada) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});

</script>
@endsection