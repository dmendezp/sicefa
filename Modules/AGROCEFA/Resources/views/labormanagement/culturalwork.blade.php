    @extends('agrocefa::layouts.master')
    <link rel="stylesheet" href="{{ asset('agrocefa/css/movements.css') }}">
    @section('content')
        @if (session('success'))
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Registro Exitoso',
                    showConfirmButton: false,
                    timer: 1500,
                    customClass: {
                        popup: 'my-custom-popup-class',
                    },
                    onOpen: () => {

                        const popup = document.querySelector('.my-custom-popup-class');
                        if (popup) {
                            popup.style.display = 'flex';
                            popup.style.alignItems = 'center';
                            popup.style.justifyContent = 'center';
                        }
                    },
                });
            </script>
        @endif
        @if (session('error'))
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: '{{ session('error') }}',
                    showConfirmButton: false,
                    timer: 15000,
                    customClass: {
                        popup: 'my-custom-popup-class',
                    },
                    onOpen: () => {

                        const popup = document.querySelector('.my-custom-popup-class');
                        if (popup) {
                            popup.style.display = 'flex';
                            popup.style.alignItems = 'center';
                            popup.style.justifyContent = 'center';
                        }
                    },
                });
            </script>
        @endif
        <h2>Registro Labor Cultural</h2>

        <div class="container" id="containermovements">
            <!-- Div para mostrar notificaciones -->
            <div id="notification" class="alert alert-danger" style="display: none;"></div>
            <div class="card">
                <div class="card-header">
                    <!-- Agrega un div para contener el botón de detalles del cultivo -->
                    <div id="cultivoDetailsButton" class="cultivo-details-button"
                        style="text-align: right; padding-right: 20px;">
                        <button type="button" id="cultivoDetails" class="btn btn-primary btn-sm">
                            <span id="cultivoNameSpan" style="margin-right: 10px;"></span>
                            <i class="bx bx-show-alt" style="font-size: 24px; vertical-align: middle;"></i>
                        </button>
                    </div>
                </div>


                <div class="card-body">
                    {!! Form::open(['route' => 'agrocefa.labormanagement.registerlabor', 'method' => 'POST']) !!}
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('lot', 'Lote') !!}
                                {!! Form::select(
                                    'lot',
                                    ['' => 'Seleccione el Lote'] +
                                        collect($environmentData)->pluck('name', 'id')->toArray(),
                                    old('lot'),
                                    ['class' => 'form-control', 'required', 'id' => 'lotSelect'],
                                ) !!}
                            </div>
                            <br>
                            <div class="form-group">
                                {!! Form::label('date', trans('agrocefa::movements.Date')) !!}
                                {!! Form::text('date', old('date', $date), ['class' => 'form-control', 'required', 'readonly' => 'readonly']) !!}
                            </div>
                            <br>
                            <div class="form-group">
                                {!! Form::label('productive_unit', trans('agrocefa::movements.Productive_Unit')) !!}
                                {!! Form::text('productive_unit', Session::get('selectedUnitName'), [
                                    'class' => 'form-control',
                                    'readonly' => 'readonly',
                                ]) !!}
                            </div>
                            <br>
                            <div class="form-group">
                                {!! Form::label('observation', trans('agrocefa::movements.Observation')) !!}
                                {!! Form::textarea('observation', old('observation'), [
                                    'class' => 'form-control',
                                    'style' => 'max-height: 100px;',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('destination', 'Destino') !!}
                                {!! Form::select('destination', $destinationOptions, old('destination'), [
                                    'class' => 'form-control',
                                    'required',
                                    'id' => 'destination',
                                ]) !!}
                            </div>
                            <br>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('crop', 'Cultivo') !!}
                                {!! Form::select('crop', [], old('crop'), [
                                    'class' => 'form-control',
                                    'required',
                                    'id' => 'cropSelect',
                                ]) !!}
                            </div>
                            <br>
                            <div class="form-group">
                                {!! Form::label('activity', 'Actividad') !!}
                                {!! Form::select(
                                    'activity',
                                    ['' => 'Seleccione la Actividad'] + $activitysData->pluck('name', 'id')->toArray(),
                                    old('activity'),
                                    ['class' => 'form-control', 'required', 'id' => 'activitySelect'],
                                ) !!}
                            </div>
                            <br>
                            <div class="form-group">
                                {!! Form::label('responsability', 'Responsable Labor') !!}
                                {!! Form::select('responsability', [], old('responsability'), [
                                    'class' => 'form-control',
                                    'required',
                                    'id' => 'responsability',
                                ]) !!}
                            </div>
                            {!! Form::hidden('sown_area', null, ['id' => 'sownArea']) !!}

                            <!-- Agregar un botón para desplegar/cerrar la información adicional -->

                        </div>
                    </div>
                    <div id="botonContainer" style="display: none">
                        <div class="row">
                            <button type="button" id="buttonsupplie"
                                class="btn btn-primary buttonlabor d-flex justify-content-between align-items-center">
                                <span>Insumos</span>
                                <span id="arrowsupplies" class="fas fa-chevron-down ml-auto"></span>
                            </button>
                            <div style="width: 20px;"></div>
                            <button type="button" id="buttontool"
                                class="btn btn-primary buttonlabor d-flex justify-content-between align-items-center">
                                <span>Herramienta Utilizada</span>
                                <span id="arrowtool" class="fas fa-chevron-down ml-auto"></span>
                            </button>

                        </div>
                        <br>
                        <div class="row">
                            <button type="button" id="buttonmachinery"
                                class="btn btn-primary buttonlabor d-flex justify-content-between align-items-center">
                                <span>Maquinaria</span>
                                <span id="arrowmachinery" class="fas fa-chevron-down ml-auto"></span>
                            </button>
                            <div style="width: 20px;"></div>
                            <button type="button" id="buttonexecutor"
                                class="btn btn-primary buttonlabor d-flex justify-content-between align-items-center">
                                <span>Personal Contratado</span>
                                <span id="arrowexecutor" class="fas fa-chevron-down ml-auto"></span>
                            </button>
                        </div>
                        <br>
                    </div>
                <br>
                @include('agrocefa::labormanagement.component.executor')
                @include('agrocefa::labormanagement.component.supplies')
                @include('agrocefa::labormanagement.component.machinery')
                @include('agrocefa::labormanagement.component.tool')
                <div id="showbutton" style="display: none">
                {!! Form::submit(trans('agrocefa::movements.Btn_Register_Exit'), [
                    'class' => 'btn btn-primary',
                    'id' => 'registerButton',
                ]) !!}
                </div>
                <br>
            </div>
            
            {!! Form::close() !!}
        </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detalles del Cultivo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí mostrarás la información del cultivo seleccionado -->
                        <div id="cultivoInfo">
                            <!-- Los detalles del cultivo se cargarán aquí -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                // Agrega un evento de clic al botón de la esquina de la tarjeta
                $('#openModalButton').on('click', function() {
                    // Abre el modal con los detalles del cultivo
                    $('#myModal').modal('show'); // Reemplaza 'myModal' con el ID de tu modal
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                // Manejar el evento de clic en el botón "Herramienta Utilizada"
                $('#buttontool').on('click', function() {
                    $('#formtool').toggle(); // Mostrar u ocultar el formulario
                    $('#arrowtool').toggleClass('fa-chevron-down fa-chevron-up'); // Cambiar la clase del icono
                });

                // Manejar el evento de clic en el botón "Personal Contratado"
                $('#buttonexecutor').on('click', function() {
                    $('#formexecutor').toggle(); // Mostrar u ocultar el formulario
                    $('#arrowexecutor').toggleClass(
                        'fa-chevron-down fa-chevron-up'); // Cambiar la clase del icono
                });

                // Manejar el evento de clic en el botón "Maquinaria"
                $('#buttonmachinery').on('click', function() {
                    $('#formmachinery').toggle(); // Mostrar u ocultar el formulario
                    $('#arrowmachinery').toggleClass(
                        'fa-chevron-down fa-chevron-up'); // Cambiar la clase del icono
                });

                // Manejar el evento de clic en el botón "Insumos"
                $('#buttonsupplie').on('click', function() {
                    $('#formsupplies').toggle(); // Mostrar u ocultar el formulario
                    $('#arrowsupplies').toggleClass(
                        'fa-chevron-down fa-chevron-up'); // Cambiar la clase del icono
                });
            });
        </script>
        <style>
            /* Agrega esta regla CSS para ocultar la columna */
            #productTable th:nth-child(1),
            #productTable td:nth-child(1) {
                display: none;
            }
        </style>
        <script>
            $(document).ready(function() {
                var productTable = $('#productTable tbody');

                // Manejador de eventos para el cambio en el campo "Actividad"
                $('#activitySelect').on('change', function() {
                    var selectedActivityId = $(this).val(); // Obtener el ID de la actividad seleccionada

                    // Realizar una solicitud AJAX para enviar el ID seleccionado a la ruta o función de Laravel
                    $.ajax({
                        url: '{{ route('agrocefa.obteneresponsability') }}',
                        method: 'GET',
                        data: {
                            activity: selectedActivityId
                        },
                        success: function(response) {
                            // Manejar la respuesta de la solicitud AJAX aquí
                            console.log('Respuesta de la solicitud AJAX:', response);

                            // Verificar si hay responsables en la respuesta
                            if (response.people_data.length > 0) {
                                // Actualizar el campo de selección de responsables con las opciones recibidas
                                var responsabilitySelect = $('#responsability');
                                responsabilitySelect.empty(); // Vaciar las opciones actuales
                                responsabilitySelect.append(new Option('Seleccione el responsable',
                                    ''));

                                // Agregar las nuevas opciones desde el objeto de personas en la respuesta JSON
                                $.each(response.people_data, function(index, person) {
                                    responsabilitySelect.append(new Option(person
                                        .first_name, person.id));
                                });
                            } else {
                                // Mostrar un campo de selección vacío y limpiar el campo "Receptor Responsable"
                                $('#responsability').val('');
                            }
                        },
                        error: function() {
                            // Manejar errores si la solicitud AJAX falla
                            console.error('Error en la solicitud AJAX');
                        }
                    });
                });

                // Manejador de eventos para el cambio en el campo "Actividad"
                $('#lotSelect').on('change', function() {
                    var selectedlotId = $(this).val(); // Obtener el ID de la actividad seleccionada

                    // Realizar una solicitud AJAX para enviar el ID seleccionado a la ruta o función de Laravel
                    $.ajax({
                        url: '{{ route('agrocefa.obtenerecrop') }}',
                        method: 'GET',
                        data: {
                            lot: selectedlotId
                        },
                        success: function(response) {
                            // Manejar la respuesta de la solicitud AJAX aquí
                            console.log('Respuesta de la solicitud AJAX:', response);

                            // Verificar si hay responsables en la respuesta
                            if (response.crop_data.length > 0) {
                                // Actualizar el campo de selección de responsables con las opciones recibidas
                                var cropSelect = $('#cropSelect');
                                cropSelect.empty(); // Vaciar las opciones actuales
                                cropSelect.append(new Option('Seleccione el Cultivo',
                                    ''));

                                // Agregar las nuevas opciones desde el objeto de personas en la respuesta JSON
                                $.each(response.crop_data, function(index, crop) {
                                    cropSelect.append(new Option(crop
                                        .name, crop.id));
                                });
                            } else {
                                // Mostrar un campo de selección vacío y limpiar el campo "Receptor Responsable"
                                $('#cropSelect').val('');
                            }
                        },
                        error: function() {
                            // Manejar errores si la solicitud AJAX falla
                            console.error('Error en la solicitud AJAX');
                        }
                    });
                });

                // Ocultar el botón de detalles del cultivo inicialmente
                $('.cultivo-details-button').hide();

                // Evento de cambio en el campo "Cultivo"
                $('#cropSelect').on('change', function() {
                    var selectedCropId = $(this).val();
                    if (selectedCropId) {
                        // Mostrar el contenedor de botones si se selecciona un cultivo
                        
                        $('#showbutton').show();
                        $('#botonContainer').show();
                        // Mostrar el botón de detalles del cultivo si se selecciona un cultivo
                        $('.cultivo-details-button').show();
                        $.ajax({
                            url: '{{ route('agrocefa.labormanagement.getcropinformation') }}',
                            method: 'GET',
                            data: {
                                id: selectedCropId
                            },
                            success: function(response) {
                                var areaSembrada = response
                                    .sown_area; // Aquí obtienes el valor del área sembrada

                                // Establece el valor en el campo oculto
                                $('#sownArea').val(areaSembrada);
                                console.log(response);
                            },
                            error: function() {
                                // Manejar errores si la solicitud AJAX falla
                                console.error('Error en la solicitud AJAX');
                            }
                        });

                        // Obtener el nombre del cultivo seleccionado y actualizar el <span>
                        var selectedCropName = $('#cropSelect option:selected').text();
                        $('#cultivoNameSpan').text(selectedCropName);
                    } else {
                        // Ocultar el botón de detalles del cultivo si no hay cultivo seleccionado
                        $('#showbutton').hide();
                        $('#botonContainer').hide();
                        $('.cultivo-details-button').hide();
                        $('#cultivoNameSpan').empty();
                    }
                });

                // Agrega un evento de clic al botón de detalles del cultivo
                $('#cultivoDetails').on('click', function() {
                    var selectedCropId = $('#cropSelect').val();
                    if (selectedCropId) {
                        $.ajax({
                            url: '{{ route('agrocefa.labormanagement.getcropinformation') }}',
                            method: 'GET',
                            data: {
                                id: selectedCropId
                            },
                            success: function(response) {
                                var areaSembrada = response
                                    .sown_area; // Aquí obtienes el valor del área sembrada

                                // Establece el valor en el campo oculto
                                $('#sownArea').val(areaSembrada);
                                console.log(response);
                                // Mostrar los detalles del cultivo en el modal
                                $('#cultivoInfo').html(
                                    '<p><strong>Nombre:</strong> ' + response.name + '</p>' +
                                    '<p><strong>Área sembrada:</strong> ' + response.sown_area +
                                    ' hectáreas</p>' +
                                    '<p><strong>Fecha de siembra:</strong> ' + response
                                    .seed_time + '</p>' +
                                    '<p><strong>Densidad:</strong> ' + response.density + '</p>'
                                    // Agrega más detalles si es necesario
                                );

                                // Abre el modal para mostrar la información del cultivo
                                $('#myModal').modal('show');
                            },
                            error: function() {
                                // Manejar errores si la solicitud AJAX falla
                                console.error('Error en la solicitud AJAX');
                            }
                        });
                    }
                });
            });
        </script>
    @endsection
