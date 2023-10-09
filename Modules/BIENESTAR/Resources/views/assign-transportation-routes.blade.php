@extends('bienestar::layouts.master')

@section('content')
    <div class="container">
        <h1>Lista de Asignaciones de Rutas de Transporte</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Aprendiz</th>
                    <th>Numero de Docuemnto</th>
                    <th>Ruta de Transporte</th>
                    <th>Convocatoria</th>
                    <th>Descripcion de la convocatoria</th>
                    <!-- Agrega más encabezados según tus campos -->
                </tr>
            </thead>
            <tbody>
                @foreach ($asignaciones as $asignacion)
                    <tr>
                        <td>{{ $asignacion->id }}</td>
                        <td>
                            @php
                                $apprentice = \Modules\SICA\Entities\Apprentice::with('person')->find($asignacion->apprentice_id);
                                if ($apprentice) {
                                    echo $apprentice->person->first_name . ' ' . $apprentice->person->first_last_name . ' ' . $apprentice->person->second_last_name;
                                } else {
                                    echo 'Aprendiz no encontrado';
                                }
                            @endphp
                        </td>
                        <td>
                            @php
                                $apprentice = \Modules\SICA\Entities\Apprentice::with('person')->find($asignacion->apprentice_id);
                                if ($apprentice) {
                                    echo $apprentice->person->document_number;
                                } else {
                                    echo 'Aprendiz no encontrado';
                                }
                            @endphp
                        </td>
                        <td>{{ $asignacion->routes_trasportantion->name_route }}</td>
                        <td>{{ $asignacion->convocations->name }}</td>
                        <td>{{ $asignacion->convocations->description }}</td>

                        <!-- Agrega más columnas según tus campos -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection