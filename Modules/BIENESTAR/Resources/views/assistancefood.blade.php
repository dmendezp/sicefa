@extends('bienestar::layouts.master')

@section('content')
<div class="container-fluid">
    <h1>{{ trans('bienestar::menu.Food Attendance Record')}} <i class="fas fa-pizza-slice"></i></h1>
    <div class="row justify-content-md-center pt-4">
        <div class="card shadow col-md-10">
            <div class="card-body">

                <!-- Formulario de filtro -->
                <form method="GET" action="{{ route('bienestar.admin.route.food_assistance_lists.filter') }}">
                    @csrf
                    <div class="form-group col-md-6">
                        <label for="porcentaje">{{ trans('bienestar::menu.percentages')}}</label>
                        <select name="porcentaje" id="porcentaje" class="form-control">
                            <option value="">{{ trans('bienestar::menu.Show All')}}</option>
                            <option value="100">100%</option>
                            <option value="75">75%</option>
                            <option value="50">50%</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="fecha_inicio">{{ trans('bienestar::menu.Start Date')}}</label>
                            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="fecha_fin">{{ trans('bienestar::menu.End Date')}}</label>
                            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control">
                        </div>
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
                                <th>{{ trans('bienestar::menu.Code')}}</th>
                                <th>{{ trans('bienestar::menu.Percentage')}}</th>
                                <th>{{ trans('bienestar::menu.Date')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach ($AssistancesFoods as $AssistanceFood)
                    <tr>
                        <td>{{ $AssistanceFood->first_name }} {{ $AssistanceFood->first_last_name }} {{ $AssistanceFood->second_last_name }}</td>
                        <td>{{ $AssistanceFood->document_number }}</td>
                        <td>{{ $AssistanceFood->state }}</td>
                        <td>{{ $AssistanceFood->program_name }}</td>
                        <td>{{ $AssistanceFood->code }}</td>
                        <td>{{ $AssistanceFood->porcentage }}</td>
                        <td>{{ $AssistanceFood->date_time }}</td>
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
        // Escuchar cambios en el elemento select y campos de fecha
        $('#porcentaje, #fecha_inicio, #fecha_fin').change(function() {
            var selectedPorcentaje = $('#porcentaje').val();
            var selectedFechaInicio = $('#fecha_inicio').val();
            var selectedFechaFin = $('#fecha_fin').val();

            // Mostrar todos los registros cuando no se selecciona un porcentaje o rango de fechas específicos
            if (selectedPorcentaje === "" && selectedFechaInicio === "" && selectedFechaFin === "") {
                $('#datatable tbody tr').show();
            } else {
                // Ocultar todas las filas de la tabla
                $('#datatable tbody tr').hide();

                // Mostrar solo las filas que coinciden con el porcentaje y el rango de fechas seleccionados
                $('#datatable tbody tr').each(function() {
                    var rowPorcentaje = $(this).find('td:nth-child(6)').text();
                    var rowFecha = $(this).find('td:nth-child(7)').text();

                    if ((selectedPorcentaje === "" || rowPorcentaje === selectedPorcentaje) &&
                        ((selectedFechaInicio === "" && selectedFechaFin === "") ||
                            (rowFecha >= selectedFechaInicio && rowFecha <= selectedFechaFin))) {
                        $(this).show();
                    }
                });
            }
        });
    });
</script>

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