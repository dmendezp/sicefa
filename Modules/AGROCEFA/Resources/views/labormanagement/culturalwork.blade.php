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
            <div class="card-body">
                {!! Form::open(['route' => 'agrocefa.registerexit', 'method' => 'POST']) !!}
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
                            {!! Form::label('responsability', 'Responsable Labor') !!}
                            {!! Form::select('responsability', [], old('responsability'), [
                                'class' => 'form-control',
                                'required',
                                'id' => 'responsability',
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
                        <!-- Agregar un botón para desplegar/cerrar la información adicional -->

                    </div>
                </div>
                <div class="row">
                    <button type="button" id="buttontool" class="btn btn-primary buttonlabor">Herramienta
                        Utilizada</button>
                    <div style="width: 20px;"></div>
                    <button type="button" id="buttonexecutor" class="btn btn-primary buttonlabor">Personal
                        Contratado</button>
                </div>
                <br>
                <div class="row">
                    <center>
                        <button type="button" id="buttonmachinery" class="btn btn-primary buttonlabor">Maquinaria</button>
                    </center>
                </div>
                <br>
                <div class="row">
                    <button type="button" id="buttonfertilizer" class="btn btn-primary buttonlabor">Fertilizante</button>
                    <div style="width: 20px;"></div>
                    <button type="button" id="buttonagrochemical" class="btn btn-primary buttonlabor">Agroquimico</button>
                </div>
            </div>
            <br>
            @include('agrocefa::labormanagement.component.agrochemical')
            @include('agrocefa::labormanagement.component.executor')
            @include('agrocefa::labormanagement.component.fertilizer')
            @include('agrocefa::labormanagement.component.machinery')
            @include('agrocefa::labormanagement.component.tool')
        </div>
    </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                console.log("Contenido de  elements:");

                // Manejar el evento de clic en el botón para desplegar/cerrar la información herramienta
                $('#buttontool').on('click', function() {
                    $('#formtool').toggle();
                });

                // Manejar el evento de clic en el botón para desplegar/cerrar la informacion personal
                $('#buttonexecutor').on('click', function() {
                    $('#formexecutor').toggle();
                });
                // Manejar el evento de clic en el botón para desplegar/cerrar la informacion personal
                $('#buttonmachinery').on('click', function() {
                    $('#formmachinery').toggle();
                });
                // Manejar el evento de clic en el botón para desplegar/cerrar la informacion personal
                $('#buttonfertilizer').on('click', function() {
                    $('#formfertilizer').toggle();
                });
                // Manejar el evento de clic en el botón para desplegar/cerrar la informacion personal
                $('#buttonagrochemical').on('click', function() {
                    $('#formagrochemical').toggle();
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

                });
            </script>
        @endsection
