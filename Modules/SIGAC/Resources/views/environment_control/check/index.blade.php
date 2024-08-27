@extends('sigac::layouts.master')
@section('content')
<h2>{{ trans('Verificación de Ambiente') }}</h2>  

<div class="container" style="margin-left: 5px">
    <div class="card" style="width: 110%">
        <div class="card-body">
            {!! Form::open(['route' => 'sigac.instructor.environmentcontrol.environment_inventory_movement.check.store', 'method' => 'POST']) !!}
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('date', trans('agrocefa::movements.Date')) !!}
                        {!! Form::text('date', $datenow, ['class' => 'form-control', 'required', 'readonly' => 'readonly']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    {!! Form::label('time', trans('Hora de ingreso')) !!}
                    {!! Form::text('time', $timenow, ['class' => 'form-control', 'required', 'readonly' => 'readonly']) !!}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="form-group">
                    {!! Form::label('security', trans('Personal Seguridad')) !!}
                    {!! Form::select('security', [], null, ['class' => 'form-control security']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('environment', trans('Ambiente')) !!}
                    {!! Form::select('environment', $environments, null, ['class' => 'form-control environment']) !!}
                </div>
            </div>
            <div class="row">
                <h4 class="titlei"></h4>
                <!-- Contenedor para los checkboxes -->
                <div class="form-group" id="inventory-checkboxes">
                </div>
            </div>
            <br>
            {!! Form::submit( trans('Verificar'), ['class' => 'btn btn-primary','id' => 'standcolor']) !!}
            {!! Form::close() !!}
        </div>
    </div>
    <!-- Div para mostrar notificaciones -->
    <div id="notification" class="alert alert-danger" style="display: none;"></div>
</div>

@push('scripts')
<script>
    $(document).ready(function () {
        $('.environment').select2();

        // Manejador de eventos para el cambio en el ambiente
        $('.environment').on('change', function() {
            var selectedEnvironmentId = $(this).val(); // Obtener el ID del ambiente seleccionado

            // Realizar una solicitud AJAX para enviar el ID seleccionado a la ruta o función de Laravel
            $.ajax({
                url: '{{ route('sigac.instructor.environmentcontrol.environment_inventory_movement.check.searchinventory') }}', // Reemplaza con la ruta adecuada
                method: 'GET', // Puedes usar GET u otro método según tu configuración
                data: {
                    environment: selectedEnvironmentId
                }, // Enviar el ID seleccionado como parámetro
                success: function(response) {
                    // Manejar la respuesta de la solicitud AJAX aquí
                    console.log('Respuesta de la solicitud elementos:', response);

                    // Limpiar el contenedor de checkboxes antes de agregar nuevos elementos
                    $('#inventory-checkboxes').empty();
                    $('.titlei').text('Inventario');
                    // Iterar sobre la respuesta y generar los checkboxes
                    response.forEach(function(item, index) {
                        var checkboxHtml = `
                            <div class="form-check">
                                <div class="row">
                                    <div class="col-6">
                                        <input type="hidden" name="inventory[${index}][checked]" value="0">
                                        <input class="form-check-input" type="checkbox" name="inventory[${index}][checked]" value="1" id="inventory-${item.id}" checked>
                                        <input type="hidden" name="inventory[${index}][id]" value="${item.id}">
                                        <label class="form-check-label" for="inventory-${item.id}">
                                            ${item.element.name} (Cantidad: ${item.amount})
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <textarea name="inventory[${index}][observation]" class="form-control" style="max-height: 30px;" placeholder="Observación"></textarea>
                                    </div>
                                </div>
                            </div>
                        `;
                        $('#inventory-checkboxes').append(checkboxHtml);
                    });
                },
                error: function() {
                    // Manejar errores si la solicitud AJAX falla
                    console.error('Error en la solicitud AJAX');
                }
            });
        });

        // Inicializar Select2 en campos de selección de personas
        $('select[name="security"]:last').select2({
            placeholder: 'Seleccione una persona',
            minimumInputLength: 3,
            ajax: {
                url: '{{ route('sigac.instructor.environmentcontrol.environment_inventory_movement.check.searchperson') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term,
                    };
                },
                processResults: function(data) {
                    var results = data.map(function(item) {
                        return {
                            id: item.id,
                            text: item.text
                        };
                    });

                    return {
                        results: results
                    };
                },
                cache: true
            }
        });
    });
</script>
@endpush
@endsection
