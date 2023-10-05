@extends('bienestar::layouts.master')

@section('content')
    <div class="container-fluid">
        <h1>Listado de Aprendices Afiliados <i class="fas fa-pizza-slice"></i></h1>
        <div class="row justify-content-md-center pt-4">
            <div class="card shadow col-md-8">
                <div class="card-body">

                    <!-- Cuadro con la tabla -->
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Aprendiz</th>
                                    <th>Numero documento</th>
                                    <th>Beneficiario</th>
                                    <th>Programa</th>
                                    <th>Ficha</th>
                                    <th>Porcentaje</th>
                                    <th>Tipo de comida</th>
                                    <th>Hora</th>
                                </tr>
                            </thead>
                            <tbody>
    @foreach ($AssistancesFoods as $AssistancesFood)
    <tr>
        <td>{{ $AssistancesFood->apprentice->person->first_name }} {{ $AssistancesFood->apprentice->person->first_last_name }} {{ $AssistancesFood->apprentice->person->second_last_name }}</td>
        <td>{{ $AssistancesFood->apprentice->person->document_number     }}</td>
        <td>{{ $AssistancesFood->postulationBenefit->benefit->name }}</td>
        <td>{{ $AssistancesFood->apprentice->course->program->name }}</td>
        <td>{{ $AssistancesFood->apprentice->course->code }}</td>
        <td>{{ $AssistancesFood->porcentage }}</td>
        <td>{{ $AssistancesFood->type_food }}</td>
        <td>{{ $AssistancesFood->date_time }}</td>
    </tr>
    @endforeach
</tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

