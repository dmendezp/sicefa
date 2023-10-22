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
                    <option value="{{ $ruta->id }}">{{ $ruta->name_route }}</option>
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
                    <th>Convocatoria</th>
                    <th>Descripción de la Convocatoria</th>
                    <!-- Agrega más encabezados según tus campos -->
                </tr>
            </thead>
            <tbody>
                @foreach ($asignaciones as $asignacion)
                    <tr>
                        <td>{{ $asignacion->id }}</td>
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
                        <td>{{ $asignacion->routes_trasportation->name_route }}</td>
                        <td>{{ $asignacion->convocations->name }}</td>
                        <td>{{ $asignacion->convocations->description }}</td>
                        <!-- Agrega más columnas según tus campos -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
