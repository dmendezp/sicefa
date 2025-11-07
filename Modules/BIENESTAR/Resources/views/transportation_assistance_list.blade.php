@php
$role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
@endphp
@extends('bienestar::layouts.master')

@section('content')
<div class="container-fluid">
    <h1>{{ trans('bienestar::menu.Transportation_Assistance_Record')}} <i class="fas fa-bus"></i></h1>
    <div class="row justify-content-md-center pt-4">
        <div class="card shadow col-md-10">
            <div class="card-body">
                <!-- Formulario de filtro -->
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="Ruta" class="col-md-3 col-form-label">{{ trans('bienestar::menu.Transportation Route')}}</label>
                        <div class="col-md-11">
                            <select name="name_route" id="name_route" class="form-control" required>
                                <option value="">{{ trans('bienestar::menu.Show All')}}</option>
                                @foreach($rutas as $r)
                                <option value="{{$r->route_number}} {{ $r->name_route}}">{{ $r->name_route}}</option>
                                @endforeach
                                <!-- Agrega más opciones según sea necesario -->
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.failure_reporting.transportation_assistance_lists.consult')}}" class="btn btn-danger ml-2">
                        <h5>{{ trans('bienestar::failure_report.Failure_Report') }}</h5>
                        </a>                        
                    </div>
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
            </div>

            <!-- Cuadro con la tabla -->
            <div class="table-responsive">
                <table id="datatable" class="table mt-4" style="width:100%">
                    <thead>
                        <tr>
                            <th>{{ trans('bienestar::menu.Apprentice')}}</th>
                            <th>{{ trans('bienestar::menu.Number Document')}}</th>
                            <th>{{ trans('bienestar::menu.Program')}}</th>
                            <th>{{ trans('bienestar::menu.Code')}}</th>
                            <th>{{ trans('bienestar::menu.Transportation Route')}}</th>
                            <th>{{ trans('bienestar::menu.Date')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $R)
                        <tr>
                            <td>{{ $R->first_name }} {{ $R->first_last_name }} {{ $R->second_last_name }}</td>
                            <td>{{ $R->document_number }}</td>
                            <td>{{ $R->program_name }}</td>
                            <td>{{ $R->code }}</td>
                            <td>{{ $R->route_number }} {{ $R->name_route }}</td>
                            <td>{{ $R->date_time }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Escuchar cambios en el elemento select y campos de fecha
        $('#name_route, #fecha_inicio, #fecha_fin').change(function() {
            var selectedRuta = $('#name_route').val();
            var selectedFechaInicio = $('#fecha_inicio').val();
            var selectedFechaFin = $('#fecha_fin').val();

            // Mostrar todos los registros cuando no se selecciona una ruta o rango de fechas específicos
            if (selectedRuta === "" && selectedFechaInicio === "" && selectedFechaFin === "") {
                $('#datatable tbody tr').show();
            } else {
                // Ocultar todas las filas de la tabla
                $('#datatable tbody tr').hide();

                // Mostrar solo las filas que coinciden con la ruta y el rango de fechas seleccionados
                $('#datatable tbody tr').each(function() {
                    var rowRuta = $(this).find('td:nth-child(5)').text().trim();
                    var rowFecha = $(this).find('td:nth-child(6)').text().trim();

                    console.log('rowRuta:', rowRuta);
                    console.log('selectedRuta:', selectedRuta);

                    if ((selectedRuta === "" || rowRuta === selectedRuta) &&
                        ((selectedFechaInicio === "" && selectedFechaFin === "") ||
                            (rowFecha >= selectedFechaInicio && rowFecha <= selectedFechaFin))) {
                        $(this).show();
                    }
                });
            }
        });
    });

    function ejecutarRutaAutomatica1() {
        // Realizar una petición AJAX para acceder a la primera ruta de Laravel
        $.ajax({
            url: '/bienestar/{{ $role_name }}/attendance_report', // Ajusta la URL según tu configuración
            type: 'GET',
            success: function(response) {
                console.log('Ruta automática ejecutada con éxito1', response);
            },
            error: function(error) {
                console.error('Error al ejecutar la ruta automática1', error);
            }
        });
    }

    function configurarTimeout1() {
        // Obtener la fecha y hora actual
        const ahora = new Date();

        // Calcular la cantidad de milisegundos hasta la primera hora programada
        const tiempoHastaPrimeraHora = new Date(ahora.getFullYear(), ahora.getMonth(), ahora.getDate(), 20, 0, 0, 0) - ahora;

        // Establecer el timeout para ejecutar la primera ruta automáticamente
        setTimeout(ejecutarRutaAutomatica1, tiempoHastaPrimeraHora);
    }

    // Configurar el timeout al cargar la página o cuando sea apropiado
    configurarTimeout1()
</script>
@endsection