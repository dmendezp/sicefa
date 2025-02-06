@extends('sigac::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('sigac::programming.Breadcrumb_Active_Events') }}</li>
@endpush

@section('content')
<div class="container">
    {!! Form::open(['route' => 'sigac.' . getRoleRouteName(Route::currentRouteName()) . '.programming.program_request.store', 'files' => true, 'method' => 'POST']) !!}
    <div class="row row-cols-2">
        @csrf
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        {!! Form::label('instructor', 'Instructor') !!}
                        <div class="input-select">
                        @if(checkRol('sigac.academic_coordinator'))
                            {!! Form::select('instructor', $instructors, old('instructor'), ['class' => 'form-control instructor'],) !!}                                    
                        @else
                            {!! Form::text('instructor', $person, ['class' => 'form-control', 'readonly' => 'readonly']) !!}   
                        @endif
                        </div>
                    </div>
                    <b id="titulo"></b>
                    <div id="profession"></div>
                    <div class="form-group">
                        {!! Form::label('Programa', 'Programa') !!}
                        {!! Form::select('program_id', $program, null, [
                            'class' => 'form-control',
                            'placeholder' => '-- Seleccione --',
                            'id' => 'program',
                            'height' => '50px',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('total_horas', 'Total Horas') !!}
                        {!! Form::number('total_hours', null, [
                            'class' => 'form-control',
                            'id' => 'total_hours',
                            'placeholder' => 'Ingrese el total de horas',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('program_especial', 'Convenio - Programa Especial') !!}
                        {!! Form::select('program_especial_id', $program_especial, null, [
                            'class' => 'form-control',
                            'placeholder' => '-- Seleccione --',
                            'id' => 'program_especial',
                            'height' => '50px',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('quota', 'Cupo') !!}
                        {!! Form::number('quota',  null, ['class' => 'form-control','placeholder' => 'Cupos','id' => 'quota','required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('start_date', 'Fecha de Inicio') !!}
                        {!! Form::date('start_date',  null, ['class' => 'form-control','placeholder' => 'Fecha de inicio','id' => 'star_date', 'required', 'min' => $minDate, 'max' => $maxDate]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('end_date', 'Fecha Final') !!}
                        {!! Form::date('end_date',  null, ['class' => 'form-control','placeholder' => 'Fecha final', 'id' => 'end_date', 'min' => $minDate]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('municipality_id', 'Municipio') !!}
                        {!! Form::select('municipality_id', $municipalities, null, [
                            'class' => 'form-control',
                            'placeholder' => '-- Seleccione --',
                            'id' => 'munipality',
                            'height' => '50px',
                            'required'
                        ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('empresa', trans('Nombre Empresa')) !!}
                        {!! Form::select('empresa', [], null, [
                            'class' => 'form-control',
                            'id' => 'empresa-select',
                            'placeholder' => 'Ingrese el nombre de la empresa',
                            'required'
                        ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('address', trans('Dirección')) !!}
                        {!! Form::text('address', old('address'), [
                            'class' => 'form-control',
                            'id' => 'address-field',
                            'placeholder' => 'Ingrese la dirección',
                            'required'
                        ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('observation', trans('agrocefa::labor.Observation')) !!}
                        {!! Form::textarea('observation', old('observation'), [
                            'class' => 'form-control',
                            'placeholder' => 'Ingrese una observación',
                            'style' => 'max-height: 100px;',
                        ]) !!}
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5><b>Datos del Solicitante</b></h5>
                            <div class="form-group">
                                <div class="form-group">
                                    {!! Form::label('applicant', trans('Nombre Completo')) !!}
                                    {!! Form::select('applicant', [], null, [
                                        'class' => 'form-control',
                                        'id' => 'applicant-select',
                                        'placeholder' => 'Ingrese el nombre completo',
                                        'required'
                                    ]) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('email', trans('Correo')) !!}
                                {!! Form::email('email', old('email'), [
                                    'class' => 'form-control',
                                    'id' => 'email-field',
                                    'placeholder' => 'Ingrese el correo',
                                    'required'
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('telephone', trans('Telefono')) !!}
                                {!! Form::number('telephone', old('telephone'), [
                                    'class' => 'form-control',
                                    'id' => 'telephone-field',
                                    'placeholder' => 'Ingrese el numero de telefono',
                                    'required'
                                ]) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <label for="documentos">Documentos</label>
                    <p>Cargue los documentos necesarios para la solicitud del programa</p>
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="form-group">
                                    {!! Form::label('documents', 'Cédulas') !!}
                                    {!! Form::file('documents[]', ['class' => 'form-control', 'accept' => 'application/pdf', 'required']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('bulk_upload','Cargue Masivo') !!}
                                    {!! Form::file('documents[]', ['class' => 'form-control', 'accept' => '.xls, .xlsx', 'required']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('card','Carta') !!}
                                    {!! Form::file('documents[]', ['class' => 'form-control', 'accept' => 'application/pdf',]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <label for="horario">{{ trans('Horario') }}</label>
                    <p>Ingrese las fechas de las formaciones</p>
                    <!-- Resultado de Aprendizaje -->
                    <div class="card">
                        <div class="card-body">
                            <div id="dates_container">
                                <!-- Campo de selección de resultado de aprendizaje -->
                                <div class="row align-items-center datesrow">
                                    <div class="col-8">
                                        <div class="form-group">
                                            {!! Form::label('dates', 'Fecha') !!}
                                            {!! Form::date('dates[]', null, ['class' => 'form-control dates', 'min' => $minDate, 'required']) !!}
                                            {!! Form::label('start_time', 'Hora de inicio') !!}
                                            {!! Form::time('start_time[]', null, ['class' => 'form-control start_time', 'required' ]) !!}
                                            {!! Form::label('end_time', 'Hora fin') !!}
                                            {!! Form::time('end_time[]', null, ['class' => 'form-control end_time', 'required']) !!}
                                            <input type="hidden" id="total_hours_calculated" readonly>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <button type="button" class="btn btn-primary add_dates"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    {!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
                    <span id="hours-error-message" style="color: red; display: none; margin-left: 10px;">
                        Las horas de formación no son iguales al total de horas del programa.
                    </span>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>
@if(session('success'))
    <script>
        var successMessage = {!! json_encode(session('success')) !!};
        Swal.fire({
            icon: 'success',
            title: successMessage,
            showConfirmButton: true,
            timer: false,
            customClass: {
                popup: 'my-custom-popup-class',
            },
        });
    </script>
@endif
@endsection
@push('scripts')
<script>
    $(function() {
        $('.instructor').select2();
        $('#program').select2();
        $('#munipality').select2();
        $('#program_especial').select2();
    })
   
    $(document).ready(function() {
        //Funcion para calcular las horas
        function calculateHours() {
            var totalHours = 0;
            $('.datesrow').each(function() {
                var startTime = $(this).find('input[name="start_time[]"]').val();
                var endTime = $(this).find('input[name="end_time[]"]').val();
                
                var startHours = startTime.split(':')[0];
                var startMinutes = startTime.split(':')[1];
                var endHours = endTime.split(':')[0];
                var endMinutes = endTime.split(':')[1];
                
                var hoursDiff = (endHours - startHours) + (endMinutes - startMinutes) / 60;
                totalHours += hoursDiff;
            });
            
            $('#total_hours_calculated').val(totalHours.toFixed(2));

            compareHours();
        }

        //Funcion para comparar las horas
        function compareHours() {
            var calculatedHours = parseFloat($('#total_hours_calculated').val());
            var enteredHours = parseFloat($('#total_hours').val());

            if (enteredHours !== calculatedHours) {
                $(':submit').prop('disabled', true); // Deshabilitar botón de submit
                $('#hours-error-message').show();
            } else {
                $(':submit').prop('disabled', false); // Habilitar botón de submit
                $('#hours-error-message').hide(); 
            }
        }

        // Manejador de eventos para el cambio en el campo "Unidad Productiva"
        $('.instructor').on('change', function() {
            var person_id = $(this).val(); // Obtener el ID de la unidad productiva seleccionada

            // Realizar una solicitud AJAX para enviar el ID seleccionado a la ruta o función de Laravel
            $.ajax({
                url: '{{ route('sigac.' . getRoleRouteName(Route::currentRouteName()) . '.programming.program_request.searchprofession') }}',
                method: 'GET',
                data: {
                    person_id: person_id
                },
                success: function(response) {
                    // Verificar si hay un responsable en la respuesta
                    if (response.professions) {
                        $('#titulo').text("Profesion");
                        $('#profession').text(response.professions.name);
                    } else {
                        // Mostrar un campo de selección vacío y limpiar el campo "Profesion"
                        $('#profession').text('');
                    }
                },
                error: function() {
                    // Manejar errores si la solicitud AJAX falla
                    console.error('Error en la solicitud AJAX');
                }
            });
        });

        // Función para agregar fila de resultado de aprendizaje
        $(document).on('click', '.add_dates', function() {
            var newRowHtml = `
                <hr id="hr">
                <div class="row align-items-center datesrow">
                    <div class="col-8">
                        <div class="form-group">
                            {!! Form::label('dates', 'Fecha') !!}
                            {!! Form::date('dates[]', null, ['class' => 'form-control dates', 'min' => $minDate, 'required']) !!}
                            {!! Form::label('start_time', 'Hora de inicio') !!}
                            {!! Form::time('start_time[]', null, ['class' => 'form-control start_time', 'required']) !!}
                            {!! Form::label('end_time', 'Hora fin') !!}
                            {!! Form::time('end_time[]', null, ['class' => 'form-control end_time', 'required']) !!}
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="button" class="btn btn-primary add_dates"><i class="fas fa-plus"></i></button>
                        <button type="button" class="btn btn-danger delete-row"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            `;
            $('#dates_container').append(newRowHtml); // Agregar nueva fila al contenedor
            calculateHours();
        });

        $(document).on('change', 'input[name="start_time[]"], input[name="end_time[]"]', function() {
            calculateHours(); // Llamar a la función cuando se cambia una hora
        });

        $(document).on('input', '#total_hours', function() {
            compareHours();
        });

        // Función para eliminar fila de resultado de aprendizaje
        $(document).on('click', '.delete-row', function() {   
            var row = $(this).closest('.datesrow');      
            var startTime = row.find('input[name="start_time[]"]').val();
            var endTime = row.find('input[name="end_time[]"]').val();
            
            var startHours = startTime.split(':')[0];
            var startMinutes = startTime.split(':')[1];
            var endHours = endTime.split(':')[0];
            var endMinutes = endTime.split(':')[1];
            
            var hoursDiff = (endHours - startHours) + (endMinutes - startMinutes) / 60;
            var totalHours = $('#total_hours').val();

            if (totalHours !== hoursDiff) {
                $(':submit').prop('disabled', true); // Deshabilitar botón de submit
                $('#hours-error-message').show();
            } else {
                $(':submit').prop('disabled', false); // Habilitar botón de submit
                $('#hours-error-message').hide(); 
            }

            $('#total_hours').val(totalHours);
            row.remove();
            $('#hr').remove();
        });

        $('#empresa-select').select2({
            tags: true,
            placeholder: 'Ingrese el nombre de la empresa',
            ajax: {
                url: '{{ route('sigac.' . getRoleRouteName(Route::currentRouteName()) . '.programming.program_request.searchempresa') }}', // URL para buscar empresas
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term // Término de búsqueda
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item){
                            return {
                                text: item.text,
                                id: item.text,
                                address: item.address,
                            };
                        })
                    };
                },
                cache: true
            },
            createTag: function(params) {
                var term = $.trim(params.term);

                if (term === '') {
                    return null;
                }

                return {
                    id: term,
                    text: term,
                    newTag: true // Añadir esta opción para distinguir nuevas entradas
                };
            }
        });

        // Manejar la selección de una empresa
        $('#empresa-select').on('select2:select', function(e) {
            var data = e.params.data;
            if (data.newTag) {

                $('#address-field').val(''); // Limpia el campo de dirección
            } else {
                // Si la empresa ya existe, rellenar el campo de dirección
                $('#address-field').val(data.address);
            }
        });

        $('#applicant-select').select2({
            tags: true,
            placeholder: 'Ingrese el nombre del solicitante',
            ajax: {
                url: '{{ route('sigac.' . getRoleRouteName(Route::currentRouteName()) . '.programming.program_request.searchapplicant') }}', // URL para buscar solicitantes
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term // Término de búsqueda
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item){
                            return {
                                text: item.text,
                                id: item.text,
                                email: item.email,
                                telephone: item.telephone
                            };
                        })
                    };
                },
                cache: true
            },
            createTag: function(params) {
                var term = $.trim(params.term);

                if (term === '') {
                    return null;
                }
                return {
                    id: term,
                    text: term,
                    newTag: true // Añadir esta opción para distinguir nuevas entradas
                };
            }
        });

        // Manejar la selección del solicitante
        $('#applicant-select').on('select2:select', function(e) {
            var data = e.params.data;
            console.log(data);
            if (data.newTag) {

                $('#email-field').val(''); // Limpia el campo de correo
                $('#telephone-field').val(''); // Limpia el campo de telefono
            } else {
                // Si la empresa ya existe, rellenar el campo de dirección
                $('#email-field').val(data.email);

                $('#telephone-field').val(data.telephone);
            }
        });

        $('#end_date').on('change', function() {
            var endDate = $(this).val();

            // Aplicar restricción a todos los campos dates[]
            $('.dates').each(function() {
                $(this).attr('max', endDate);
            });
        });

        // También aplicar restricción cuando se añadan nuevas filas dinámicamente
        $(document).on('change', '#end_date', function() {
            var endDate = $(this).val();

            // Aplicar restricción a los nuevos campos dates[]
            $('.dates').each(function() {
                $(this).attr('max', endDate);
            });
        });
        
    });
</script>
@endpush
