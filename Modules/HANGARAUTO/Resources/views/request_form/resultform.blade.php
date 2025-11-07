@extends('hangarauto::layouts.master')
@push('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route('cefa.parking.table') }}">{{ trans('hangarauto::solicitar.Tilte_Card_Records_Saver') }}</a></li>
@endpush

@section('content')
    <div class="col-md-12">
        <div class="card card-primary card-outline shadow mt-2">
            <div class="card-header">
                <h2 class="card-title"><strong>{{ trans('hangarauto::solicitar.Tilte_Card_Records_Saver') }}</strong></h2>
            </div>

            <div class="card-body">
                @if (Route::is('hangarauto.admin.*'))
                    <a href="{{ route('hangarauto.admin.petitions.add.index') }}" class="btn btn-primary mb-2">
                        <i class="fa-solid fa-plus"></i>
                    </a>
                    @elseif (Route::is('hangarauto.charge.*'))
                    <a href="{{ route('hangarauto.charge.petitions.add.index') }}" class="btn btn-primary mb-2">
                        <i class="fa-solid fa-plus"></i>
                    </a>
                    @elseif (Route::is('hangarauto.driver.*'))

                    @else 
                    <a href="{{ route('cefa.parking.solicitar') }}" class="btn btn-primary mb-2">
                        <i class="fa-solid fa-plus"></i>
                    </a>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="myTable">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>{{ trans('hangarauto::solicitar.Title_Header_Table_Column_Travel_date')}}</th>
                                <th>{{ trans('hangarauto::solicitar.Title_Header_Table_Column_Return_Date')}}</th>
                                <th>{{ trans('hangarauto::Vehiculos.Vehicle')}}</th>
                                <th>{{ trans('hangarauto::solicitar.Title_Header_Table_Column_Department')}}</th>
                                <th>{{ trans('hangarauto::solicitar.Title_Header_Table_Column_City')}}</th>
                                <th>{{ trans('hangarauto::solicitar.Title_Header_Table_Column_numstudents')}}</th>
                                <th>{{ trans('hangarauto::solicitar.Title_Header_Table_Column_reason_for_trip')}}</th>
                                <th>Estado</th>
                                <th class="col-2">{{ trans('hangarauto::solicitar.Title_Header_Table_Column_Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requests as $dato)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $dato->start_date }}</td>
                                    <td>{{ $dato->end_date }}</td>
                                    @if($dato->petition_assignments->isNotEmpty())
                                        @foreach ($dato->petition_assignments as $pa)
                                            <td>{{ $dato->person->fullname}} - {{ $dato->vehicle_type->name }} - {{ $pa->vehicle->license}} - {{ $pa->driver->person->fullname }} </td> <!-- Mostrar vehículo, placa y conductor asignado si existe -->
                                        @endforeach
                                    @else
                                        <td>{{ $dato->vehicle_type->name }}</td> <!-- Mostrar solo el tipo de vehículo si no hay asignaciones -->
                                    @endif
                                    <td>{{ $dato->municipality->department->name }}</td>
                                    <td>{{ $dato->municipality->name }}</td>
                                    <td>{{ $dato->numstudents }}</td>
                                    <td>{{ $dato->reason }}</td>
                                    <td>{{ $dato->status }} - {{ $dato->observation }}</td>
                                    @if (Auth::check() && Auth::user()->havePermission('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.petitions.assign'))
                                    <td>
                                        @if ($dato->status == 'Solicitud')
                                            @if (Auth::user()->havePermission('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.petitions.assign.index'))
                                            <button class="btn btn-primary btnAsignar" data-toggle="modal" data-target="#modalAsignar{{ $dato->id }}" data-petition-id="{{ $dato->id }}">
                                                Asignar
                                            </button>
                                            @endif
                                            <button class="btn btn-danger btnDenegar" data-toggle="modal" data-target="#modalDenegar{{ $dato->id }}">
                                                Denegar
                                            </button>
                                            
                                        @elseif ($dato->status == 'Denegado')
                                            <button class="btn btn-warning btnMostrarDescripcion" data-toggle="modal" data-target="#modalDescripcion{{ $dato->id }}">
                                                Mostrar Observacion
                                            </button>
                                        @elseif ($dato->status == 'Asignado')
                                            @if (Route::is('hangarauto.driver*'))
                                                <a href="{{ route('hangarauto.driver.petitions.confirmation', $dato->id) }}" class="btn btn-primary mb-2">
                                                    Confirmar
                                                </a>
                                                <button class="btn btn-danger btnDenegar" data-toggle="modal" data-target="#modalDenegar{{ $dato->id }}">
                                                    Denegar
                                                </button>
                                            @else 
                                                <button class="btn btn-secondary ">
                                                    {{ $dato->status }}
                                                </button> 
                                            @endif
                                            
                                           
                                        @else
                                            <button class="btn btn-secondary ">
                                                {{ $dato->status }}
                                            </button> 
                                        @endif
                                    </td>
                                    @else
                                    <td>
                                        <form action="{{ route('cefa.parking.delete', $dato->id) }}" method="post" id="formEliminar{{ $dato->id }}">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger btnEliminar" type="button" data-form-id="formEliminar{{ $dato->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                                @if (Route::is('hangarauto.admin.*') || Route::is('hangarauto.charge.*') || Route::is('hangarauto.driver*'))
                                 <!-- Modal para la denegación con campo de observación -->
                                <div class="modal fade" id="modalDenegar{{ $dato->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDenegarLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalDenegarLabel">Denegar Solicitud</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.petitions.deny', $dato->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="observation">Observación</label>
                                                        <textarea class="form-control" id="observation" name="observation" rows="3" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-danger">Denegar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal para mostrar la descripción de la solicitud denegada -->
                                <div class="modal fade" id="modalDescripcion{{ $dato->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDescripcionLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalDescripcionLabel">Descripción de la Solicitud Denegada</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>{{ $dato->observation }}</p> <!-- Suponiendo que la descripción está almacenada en un campo "description" en la base de datos -->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if (Route::is('hangarauto.admin.*') || Route::is('hangarauto.charge.*')  )
                                <!-- Modal para la asignación de vehículos -->
                                <div class="modal fade" id="modalAsignar{{ $dato->id }}" tabindex="-1" role="dialog" aria-labelledby="modalAsignarLabel{{ $dato->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalAsignarLabel">Asignación de Vehículos</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                {!! Form::open(['url' => route('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.petitions.assign.add')]) !!}
                                                @csrf  
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            {!! Form::label('vehicle', trans('Vehiculo :')) !!}
                                                            <select name="vehicle" id="vehicle" class="form-control vehicle" disabled>
                                                                <option value="">{{ trans('Seleccione el Vehiculo') }}</option>
                                                            </select>
                                                        </div>        
                                                        <div class="form-group">
                                                            {!! Form::label('driver', trans('Conductor :')) !!}
                                                            <select name="driver" id="driver" class="form-control driver" disabled>
                                                                <option value="">{{ trans('Seleccione el Conductor') }}</option>
                                                            </select>
                                                        </div>        
                                                    </div>
                                                </div>
                                                {!! Form::hidden('petition_id', $dato->id) !!} <!-- Asegúrate de que este campo oculto esté presente y tenga el valor correcto -->
                                                {!! Form::hidden('start_date', $dato->start_date, ['id' => 'start_date_' . $dato->id]) !!}

                                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                            </div>
                                            <div class="modal-footer">
                                                {!! Form::submit(trans('Guardar'), ['class' => 'btn btn-success', 'id' => 'btn_guardar']) !!}</center>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const deleteButtons = document.querySelectorAll('.btnEliminar');

            deleteButtons.forEach((deleteButton) => {
                deleteButton.addEventListener('click', () => {
                    const formId = deleteButton.dataset.formId;
                    const form = document.getElementById(formId);

                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: 'Esta acción no se puede deshacer',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Envía el formulario de manera convencional
                            form.submit();
                        } else {
                            Swal.fire('Cancelado', 'La acción ha sido cancelada', 'info');
                        }
                    });
                });
            });
        });
    </script>
    <script>
        // Script para mostrar el modal de denegación al hacer clic en el botón de denegar
        document.addEventListener('DOMContentLoaded', () => {
            const asignarButtons = document.querySelectorAll('.btnAsignar');
            const denegarButtons = document.querySelectorAll('.btnDenegar');
            const observationButtons = document.querySelectorAll('.btnMostrarDescripcion');

            denegarButtons.forEach((denegarButton) => {
                denegarButton.addEventListener('click', () => {
                    const modalId = denegarButton.getAttribute('data-target');
                    const modal = document.querySelector(modalId);
                    $(modal).modal('show');
                });
            });
            asignarButtons.forEach((asignarButton) => {
                asignarButton.addEventListener('click', () => {
                    const modalId = asignarButton.getAttribute('data-target');
                    const modal = document.querySelector(modalId);
                    $(modal).modal('show');
                });
            });
            observationButtons.forEach((observationButton) => {
                observationButton.addEventListener('click', () => {
                    const modalId = observationButton.getAttribute('data-target');
                    const modal = document.querySelector(modalId);
                    $(modal).modal('show');
                });
            });
        });
    </script>
    <script>
        // Script para manejar la solicitud AJAX al hacer clic en el botón de asignación
        $(document).ready(function() {
            $('.btnAsignar').click(function() {
                var petitionId = $(this).data('petition-id');

                $.ajax({
                    url: '/hangarauto/get-vehicles/' + petitionId,
                    type: 'GET',
                    success: function(response) {
                        // Limpiar el select de vehículos solo si hay datos disponibles en la respuesta
                        $('.vehicle').empty(); 
                        
                        if (response.length > 0) {
                            // Habilitar el select de vehículos
                            $('.vehicle').prop('disabled', false);

                            // Agregar las opciones de vehículos al select
                            $('.vehicle').append('<option value="">' + 'Seleccione el vehículo' + '</option>');
                            $.each(response, function(key, value) {
                                $('.vehicle').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        } else {
                            // Deshabilitar el select de vehículos
                            $('.vehicle').prop('disabled', true);

                            // Mostrar un mensaje indicando que el vehículo no está disponible para la fecha seleccionada
                            $('.vehicle').append('<option value="">' + 'Vehículo no disponible para esta fecha' + '</option>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });

            $('.vehicle').change(function() {
                var vehicleId = $(this).val();
                var petitionId = $(this).closest('.modal').find('input[name="petition_id"]').val();
                var startDate = $('#start_date_' + petitionId).val();
                // Obtener el token CSRF
                var token = $('meta[name="csrf-token"]').attr('content');

                // Realizar la petición AJAX
                $.ajax({
                    url: '/hangarauto/get-drivers/' + vehicleId,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token // Establecer el token CSRF en el encabezado de la solicitud
                    },
                    data: {
                        start_date: startDate // Incluir start_date como parte de los datos enviados en la solicitud
                    },
                    success: function(response) {
                        // Limpiar el select de conductores
                        $('.driver').empty();

                        // Agregar la opción al principio
                        $('.driver').append('<option value="">' + 'Seleccione el conductor' + '</option>');

                        if (response.length > 0) {
                            // Habilitar el select de conductores
                            $('.driver').prop('disabled', false);

                            // Agregar las opciones de conductores al select
                            $.each(response, function(key, value) {
                                $('.driver').append('<option value="' + value.id + '">' + value.person.first_name + ' ' + value.person.first_last_name + '</option>');
                            });
                        } else {
                            // Deshabilitar el select de conductores
                            $('.driver').prop('disabled', true);

                            // Mostrar un mensaje indicando que el vehículo no está disponible para este día
                            $('.driver').append('<option value="">' + 'Vehículo no disponible para este día' + '</option>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endpush