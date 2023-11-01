@extends('bienestar::layouts.master')

@section('content')
<div class="container-fluid">
    <h1>Registro de Asistencia de Alimentación <i class="fas fa-pizza-slice"></i></h1>
    <div class="row justify-content-md-center pt-4">
        <div class="card shadow col-md-8">
            <div class="card-body">

                <!-- Formulario de filtro -->
                <form method="GET" action="{{ route('cefa.bienestar.assistancefoodrecord') }}">
                    @csrf
                    <div class="form-group">
                        <label for="porcentaje">Filtrar porcentaje:</label>
                        <select name="porcentaje" id="porcentaje" class="form-control">
                            <option value="">Mostrar todos</option> <!-- Opción para mostrar todos los registros -->
                            <option value="100">100%</option>
                            <option value="75">75%</option>
                            <option value="50">50%</option>
                        </select>
                    </div>
                </form>

                <!-- Cuadro con la tabla -->
                <div class="table-responsive">
                    <table id="datatable" class="table mt-4" style="width:100%">
                        <thead>
                            <tr>
                                <th>{{ trans('bienestar::menu.Apprentice')}}</th>
                                <th>{{ trans('bienestar::menu.Number Document')}}</th>
                                <th>{{ trans('bienestar::menu.Beneficiary')}}</th>
                                <th>{{ trans('bienestar::menu.Program')}}</th>
                                <th>{{ trans('bienestar::menu.code')}}</th>
                                <th>{{ trans('bienestar::menu.percentage')}}</th>
                                <th>{{ trans('bienestar::menu.time and date')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($AssistancesFoods as $AssistancesFood)
                                <tr>
                                    <td>{{ $AssistancesFood->apprentice->person->first_name }} {{ $AssistancesFood->apprentice->person->first_last_name }} {{ $AssistancesFood->apprentice->person->second_last_name }}</td>
                                    <td>{{ $AssistancesFood->apprentice->person->document_number }}</td>
                                    <td>{{ $AssistancesFood->postulationBenefit->benefit->name }}</td>
                                    <td>{{ $AssistancesFood->apprentice->course->program->name }}</td>
                                    <td>{{ $AssistancesFood->apprentice->course->code }}</td>
                                    <td>{{ $AssistancesFood->porcentage }}</td>
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
