@extends('bienestar::layouts.master')

@section('content')
<div class="container-fluid">
    <h1>{{ trans('Registro de Asistencia de Transporte')}} <i class="fas fa-bus"></i></h1>
    <div class="row justify-content-md-center pt-4">
        <div class="card shadow col-md-8">
            <div class="card-body">
                <!-- Formulario de filtro -->
                <form method="GET" action="{{ route('bienestar.admin.route.food_assistance_lists.filter') }}">
                    @csrf
                    <div class="form-group col-md-7">
                        <label for="Ruta">{{ trans('Ruta')}}</label>
                        <div class="col-md-7">
                            <select name="name_route" id="name_route" class="form-control" required>
                                <option value="" disabled selected>{{ trans('Selecciona una ruta')}}</option>
                                @foreach($rutas as $r)
                                <option value="{{$r->id}}">{{ $r->name_route}}</option>
                                @endforeach
                                <!-- Agrega más opciones según sea necesario -->
                            </select>
                            
                        </div>
                    </div>
                    
                    </div>
                    
               <div class="form-row">
               <div class="form-group col-md-3">
               <label for="fecha_inicio">{{ trans('bienestar::menu.start date')}}</label>
               <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control">
               </div>
              <div class="form-group col-md-3">
              <label for="fecha_fin">{{ trans('bienestar::menu.end date')}}</label>
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
                                <th>{{ trans('bienestar::menu.Program')}}</th>
                                <th>{{ trans('bienestar::menu.code')}}</th>
                                <th>{{ trans('bienestar::menu.percentage')}}</th>
                                <th>{{ trans('bienestar::menu.time and date')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
 </div>

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
