@extends('sigac::layouts.master')
@section('content')
    <div class="container" style="margin-left: 5px">
        <div class="card" style="width: 110%">
            <div class="card-body">
                {!! Form::open([
                    'route' => 'sigac.academic_coordination.environmentcontrol.environment_inventory_movement.check.store',
                    'method' => 'POST',
                ]) !!}
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('date', trans('agrocefa::movements.Date')) !!}
                            {!! Form::text('date', $datenow, ['class' => 'form-control date', 'required', 'readonly' => 'readonly']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        {!! Form::label('time', trans('Hora de ingreso')) !!}
                        {!! Form::text('time', $timenow, ['class' => 'form-control', 'required', 'readonly' => 'readonly']) !!}
                    </div>
                    <div class="col-md-4 end_time_container">
                        {!! Form::label('end_time', trans('Hora de fin')) !!}
                        {!! Form::time('end_time', null, ['class' => 'form-control']) !!}
                    </div>

                </div>
                <br>
                <div class="row">
                    <div class="form-group">
                        {!! Form::label('environment', trans('Ambiente')) !!}
                        {!! Form::select('environment', $environments, null, ['class' => 'form-control environment']) !!}
                    </div>
                    <div class="continputs">
                        <div class="form-group">
                            {!! Form::label('instructor', trans('Instructor')) !!}
                            {!! Form::select('instructor', $instructors, null, [
                                'class' => 'form-control instructor',
                                'id' => 'instructor',
                                'placeholder' => 'Ingrese el nombre completo',
                                'required',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('security', trans('Personal Seguridad')) !!}
                            {!! Form::select('security', [], null, ['class' => 'form-control security']) !!}
                        </div>
                    </div>

                </div>
                <div class="row">
                    <h4 class="titlei"></h4>
                    <!-- Contenedor para los checkboxes -->
                    <div class="form-group" id="inventory-checkboxes">
                    </div>
                </div>
                <br>
                {!! Form::submit(trans('Registrar Chequeo'), ['class' => 'btn btn-primary', 'id' => 'standcolor']) !!}
                {!! Form::close() !!}

            </div>
        </div>
        <!-- Div para mostrar notificaciones -->
        <div id="notification" class="alert alert-danger" style="display: none;"></div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.environment').select2();
                $('.instructor').select2();

                // Evento al enviar el formulario
                $('form').on('submit', function(event) {
                    // Si .continputs está visible, validar campos dentro de continputs
                    if ($('.continputs').is(':visible')) {
                        var isValid = true;
                        $('.continputs select').each(function() {
                            if (!$(this).val()) { // Comprobar si el campo está vacío
                                isValid = false;
                                $(this).addClass(
                                    'is-invalid'); // Agregar clase para destacar campo vacío
                            } else {
                                $(this).removeClass('is-invalid'); // Remover clase si tiene valor
                            }
                        });

                        if (!isValid) {
                            event.preventDefault(); // Evitar el envío del formulario
                            Swal.fire({
                                icon: 'error',
                                title: 'Campos incompletos',
                                text: 'Por favor, complete todos los campos requeridos en la sección.',
                                confirmButtonText: 'Entendido'
                            });
                            return;
                        }
                    }
                });

                // Manejador de eventos para el cambio en el ambiente
                $('.environment').on('change', function() {
                    var selectedEnvironmentId = $(this).val(); // Obtener el ID del ambiente seleccionado
                    var date = $('.date').val(); // Obtener la fecha actual
                    let baseImageUrl = "{{ asset('') }}"; // Esto devuelve la ruta base de /public

                    // Solicitud AJAX para obtener el inventario
                    $.ajax({
                        url: '{{ route('sigac.academic_coordination.environmentcontrol.environment_inventory_movement.check.searchinventory') }}',
                        method: 'GET',
                        data: {
                            environment: selectedEnvironmentId,
                            date: date
                        },
                        success: function(response, textStatus, jqXHR) {
                            var verificationStatus = jqXHR.getResponseHeader('Verification-Status');
                            $('.titlei').text(verificationStatus == '1' ?
                                'Inventario - Verificación de salida' :
                                'Inventario - Verificación de entrada');
                            $('.continputs').toggle(verificationStatus != '1');

                            $('#inventory-checkboxes').empty();

                            if (response.length === 0) {
                                $('#inventory-checkboxes').append(
                                    '<p>El ambiente no contiene elementos</p>');
                            } else {
                                // Comenzar tabla
                                let tableHtml = `
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Imagen</th>
                                <th>Estado</th>
                                <th>Elemento</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                                <th>Observación</th>
                            </tr>
                        </thead>
                        <tbody>
                `;
                                // Generar filas
                                response.forEach(item => {
                                    var isChecked = item.is_checked ? 'checked' : '';
                                    var observation = item.observation ? item.observation :
                                        '';
                                    var description = item.element.description ? item
                                        .element.description : 'Sin descripción';

                                    let imagePath = item.element.image ?
                                        `<img src="${baseImageUrl}${item.element.image}" alt="${item.element.name}" style="width:50px; height:auto;">` :
                                        `<img src="${baseImageUrl}general/images/product.png" alt="Producto" style="width:50px; height:auto;">`;

                                    tableHtml += `
        <tr>
            <td class="text-center">${imagePath}</td>
            <td class="text-center">
                <input type="checkbox" name="inventory[${item.id}][checked]" value="1" ${isChecked}>
            </td>
            <td>${item.element.name}</td>
            <td class="col-4">${description}</td>
            <td class="text-center">${item.amount}</td>
            <td class="col-5">
                <textarea name="inventory[${item.id}][observation]" 
                    class="form-control form-control-sm" 
                    style="max-height: 60px;" 
                    placeholder="Observación">${observation}</textarea>
            </td>
        </tr>
    `;
                                });


                                tableHtml += `</tbody></table>`;
                                $('#inventory-checkboxes').append(tableHtml);
                            }
                        },
                        error: function() {
                            console.error('Error en la solicitud AJAX');
                        }
                    });
                });




                // Inicializar Select2 en campos de selección de personas
                $('select[name="security"]:last').select2({
                    placeholder: 'Seleccione una persona',
                    minimumInputLength: 3,
                    ajax: {
                        url: '{{ route('sigac.academic_coordination.environmentcontrol.environment_inventory_movement.check.searchperson') }}',
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
