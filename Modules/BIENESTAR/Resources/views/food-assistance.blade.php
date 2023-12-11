@extends('bienestar::layouts.master')

@section('content')
    <!-- Main content -->
    <div class="container">
        <div class="container-fluid">
            <h1 class="mb-4"> Asistencia de Alimentacion <i class="fas fa-food-alt"></i></h1>

            <!-- Mostrar la información de la asistencia de alimentación -->
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Número de Documento</th>
                        <th>Código de Curso</th>
                        <th>Nombre del Programa</th>
                        <th>Nombre del Beneficio</th>
                        <th>Porcentaje del Beneficio</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($AssistancesFoods as $assistanceFood)
                        <tr>
                            <td>{{ $assistanceFood->apprentice->person->first_name }}</td>
                            <td>{{ $assistanceFood->apprentice->person->first_last_name }}</td>
                            <td>{{ $assistanceFood->apprentice->person->document_number }}</td>
                            <td>{{ $assistanceFood->apprentice->course->code }}</td>
                            <td>{{ $assistanceFood->apprentice->course->program->name }}</td>
                            <td>{{ $assistanceFood->postulationBenefit->benefit->name }}</td>
                            <td>{{ $assistanceFood->postulationBenefit->benefit->porcentaje }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <!-- Puedes agregar scripts específicos aquí si es necesario -->
@endsection
