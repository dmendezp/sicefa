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
                <div class="row">
                    <button type="button" id="buttonfertilizer" class="btn btn-primary buttonlabor">Fertilizante</button>
                    <div style="width: 20px;"></div>
                    <button type="button" id="buttonagrochemical" class="btn btn-primary buttonlabor">Agroquímico</button>
                </div>
            </div>
            <br>
            @include('agrocefa::labormanagement.component.supplies')
            @include('agrocefa::labormanagement.component.executor')
            @include('agrocefa::labormanagement.component.fertilizer')
            @include('agrocefa::labormanagement.component.machinery')
            @include('agrocefa::labormanagement.component.tool')
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

            // Manejar el evento de clic en el botón "Fertilizante"
            $('#buttonfertilizer').on('click', function() {
                $('#formfertilizer').toggle(); // Mostrar u ocultar el formulario
                $('#arrowfertilizer').toggleClass(
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

        });
    </script>
@endsection
