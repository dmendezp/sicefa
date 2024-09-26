@extends('sigac::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/sigac/css/customStyles.css') }}">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('sigac::programming.Breadcrumb_Active_Events') }}</li>
@endpush

@section('content')
    {!! Form::open(['route' => 'sigac.academic_coordination.programming.management.store', 'method' => 'POST']) !!}
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        {!! Form::label('course', 'Curso') !!}
                        <div class="input-select">
                            {!! Form::select(
                                'course',
                                $courses->pluck('program.name', 'id')->map(function ($item, $key) use ($courses) {
                                    return $item . ' - ' . $courses->find($key)->code;
                                }),
                                null,
                                ['class' => 'form-select', 'placeholder' => 'Seleccione el curso', 'id' => 'course'],
                            ) !!}
                        </div>
                        @error('course')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        {!! Form::label('querter_number', 'Trimestre') !!}
                        <div class="input-select">
                            {!! Form::select(
                                'querter_number',
                                [
                                    '' => trans('Seleccione el trimestre'),
                                    '1' => '1',
                                    '2' => '2',
                                    '3' => '3',
                                    '4' => '4',
                                    '5' => '5',
                                    '6' => '6',
                                    '7' => '7',
                                ],
                                null,
                                ['class' => 'form-control quarter_number', 'required', 'id' => 'quarter_number'],
                            ) !!}
                        </div>
                        @error('course')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>
            <div id="quaterlie">
                <div class="card">
                    <div class="card-header">
                        <h2>Trimestralización</h2>
                    </div>
                    <div class="card-body">
                        <div id="cometencies"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    @if(checkRol('superadmin'))
                    <div class="row">
                        <div class="col-10">
                            <h2>Programación</h2>   
                        </div>
                        <div class="col-2">
                            <input type="checkbox" id="lock" />
                            <label for="lock" class="lock-label">
                                <span class="lock-wrapper">
                                    <span class="shackle"></span>
                                    <svg class="lock-body" width="" height="" viewBox="0 0 28 28" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0 5C0 2.23858 2.23858 0 5 0H23C25.7614 0 28 2.23858 28 5V23C28 25.7614 25.7614 28 23 28H5C2.23858 28 0 25.7614 0 23V5ZM16 13.2361C16.6137 12.6868 17 11.8885 17 11C17 9.34315 15.6569 8 14 8C12.3431 8 11 9.34315 11 11C11 11.8885 11.3863 12.6868 12 13.2361V18C12 19.1046 12.8954 20 14 20C15.1046 20 16 19.1046 16 18V13.2361Z"
                                            fill="white"></path>
                                    </svg>
                                </span>
                            </label>
                        </div>
                    </div>
                    @else
                    <h2>Programación</h2> 
                    @endif
                    
                </div>
                <div class="card-body">
                    @if (session('mensaje'))
                        <p>
                            {{ session('mensaje') }}
                        </p>
                    @endif
                    <div class="row">
                        <div class="col-8">
                            {!! Form::label('learning_outcomelabel', 'Resultado de Aprendizaje') !!}
                        </div>
                        <div class="col-4">
                            {!! Form::label('hourlabel', 'Horas') !!}
                        </div>
                    </div>

                    <!-- Resultado de Aprendizaje -->
                    <div id="learning_outcomes_container">
                        <!-- Campo de selección de resultado de aprendizaje -->
                        <div class="row align-items-center learning_outcomes_row">
                            <div class="col-8">
                                <div class="form-group">
                                    {!! Form::select('learning_outcome[]', [], old('learning_outcome[]'), [
                                        'class' => 'form-control select2 learning_outcome_select le1',
                                        'required',
                                    ]) !!}
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    {!! Form::number('hour[]', null, ['class' => 'form-control', 'id' => 'hour', 'required']) !!}
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary add_learning_outcomes"><i
                                            class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::label('instructorlabel', 'Instructor') !!}
                    <div id="instructors_container">
                        <!-- Campo de selección de instructores -->
                        <div class="row align-items-center instructor_row">
                            <div class="col-8">
                                <div class="form-group">
                                    <div class="input-select">
                                        {!! Form::select('instructor[]', [], old('instructor[]'), [
                                            'class' => 'form-control select2 instructors',
                                            'required',
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary add_instructor"><i
                                            class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div id="environments_container">
                        {!! Form::label('environmentlabel', 'Ambiente') !!}
                        <!-- Campo de selección de ambiente -->
                        <div class="row align-items-center environment_row">
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="input-select">
                                        {!! Form::select('environment[]', [], old('environment[]'), [
                                            'class' => 'form-control select2 environments'
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary add_environment"><i
                                            class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    {!! Form::checkbox('modality', 1, null, ['id' => 'modality']) !!}
                                    {!! Form::label('modality', 'Medios tecnologicos') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <b>Seleccion de fechas</b>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="form-check form-check-inline">
                                        {!! Form::checkbox('days[]', 'Monday', null, false, ['class' => 'form-check-input', 'id' => 'monday']) !!}
                                        {!! Form::label('lunes', 'Lunes', ['class' => 'form-check-label']) !!}
                                    </div>
                                    <div class="form-check form-check-inline">
                                        {!! Form::checkbox('days[]', 'Tuesday', null, false, ['class' => 'form-check-input', 'id' => 'tuesday']) !!}
                                        {!! Form::label('martes', 'Martes', ['class' => 'form-check-label']) !!}
                                    </div>
                                    <div class="form-check form-check-inline">
                                        {!! Form::checkbox('days[]', 'Wednesday', null, false, ['class' => 'form-check-input', 'id' => 'wednesday']) !!}
                                        {!! Form::label('miercoles', 'Miercoles', ['class' => 'form-check-label']) !!}
                                    </div>
                                    <div class="form-check form-check-inline">
                                        {!! Form::checkbox('days[]', 'Thursday', null, false, ['class' => 'form-check-input', 'id' => 'thursday']) !!}
                                        {!! Form::label('jueves', 'Jueves', ['class' => 'form-check-label']) !!}
                                    </div>
                                    <div class="form-check form-check-inline">
                                        {!! Form::checkbox('days[]', 'Friday', null, false, ['class' => 'form-check-input', 'id' => 'friday']) !!}
                                        {!! Form::label('viernes', 'Viernes', ['class' => 'form-check-label']) !!}
                                    </div>
                                    <div class="form-check form-check-inline">
                                        {!! Form::checkbox('days[]', 'Saturday', null, false, ['class' => 'form-check-input', 'id' => 'saturday']) !!}
                                        {!! Form::label('sabado', 'Sábado', ['class' => 'form-check-label']) !!}
                                    </div>
                                    <div class="form-check form-check-inline">
                                        {!! Form::checkbox('days[]', 'Sunday', null, false, ['class' => 'form-check-input', 'id' => 'sunday']) !!}
                                        {!! Form::label('domingo', 'Domingo', ['class' => 'form-check-label']) !!}
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group">
                                            {!! Form::label('start_date', 'Fecha de inicio') !!}
                                            {!! Form::date('start_date', now(), ['class' => 'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('end_date', 'Fecha de finalización') !!}
                                            {!! Form::date('end_date', now(), ['class' => 'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('start_time', 'Hora de inicio') !!}
                                            {!! Form::time('start_time', now()->format('H:i'), ['class' => 'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('end_time', 'Hora de finalización') !!}
                                            {!! Form::time('end_time', now()->format('H:i'), ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {

        $('#course').select2(); // Inicializa el campo course como select2
        $('#quaterlie').hide(); // Ocultar trimestralizacion

        $('#modality').on('change', function(){
            var modality = $(this).is(':checked');

            if (modality) {
                $('.environments').prop('disabled', true);
            } else {
                $('.environments').prop('disabled', false);
            }
        });

        $('#course').change(function() {
            var course_id = $('#course').val();

            $.ajax({
                type: 'GET',
                url: "{{ route('sigac.academic_coordination.programming.management.search_quarter_number') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    course_id: course_id
                },
                success: function(data) {
                    var quarter_number = $('#quarter_number');
                    console.log(data.modality);

                    quarter_number.empty();
                    quarter_number.append(new Option('Seleccione el trimestre', ''));

                    $.each(data.results, function(index, result) {
                        quarter_number.append(new Option(result, result));
                    });

                    if(data.modality == 'Virtual'){
                        $('#environments_container').hide();
                    }else{
                        $('#environments_container').show();
                    }

                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

        });

        var plannedHoursMap = {};
        var learningOutcomeMap = {};

        $('#quarter_number').on('change', function() {
            var course_id = $('#course').val();
            var quarter_number = $('#quarter_number').val();

            if (quarter_number) {
                $.ajax({
                    url: '{{ route('sigac.academic_coordination.programming.management.filterquarterlie') }}',
                    method: 'GET',
                    data: {
                        course_id: course_id,
                        quarter_number: quarter_number
                    },
                    success: function(response) {
                        // Construye el HTML con la información recibida
                        $('#quaterlie').show(); // Mostrar trimestralizacion
                        var html = '';

                        $.each(response.outcomes_not_programming, function(competencie_pass, results_pass) {
                            html += '<h6><b>' + competencie_pass + ' - No programado</b></h6><ul>';
                            $.each(results_pass, function(index, result_pass) {
                                var totalHours = 0;
                                if (result_pass.learning_outcome.instructor_program_outcomes.length > 0) {
                                    // Asumimos que si hay outcomes, estamos verificando si ha sido "ejecutado"
                                    let ejecutado = false;
                                    result_pass.learning_outcome.instructor_program_outcomes.forEach((outcome) => {
                                        // Verificamos si instructor_program existe y si coincide con el course_id
                                        if (outcome.instructor_program && outcome.instructor_program.course_id == course_id) {
                                            ejecutado = true;  // Marcamos que ha sido ejecutado
                                            totalHours = result_pass.hour - outcome.hour; // Restamos horas planeadas menos ejecutadas
                                        }
                                    });

                                    // Si no se encuentra ningún resultado ejecutado
                                    if (!ejecutado) {
                                        totalHours = result_pass.hour;  // Si no ha sido ejecutado, mostramos horas planeadas
                                    }
                                } else {
                                    // Si no hay resultados de aprendizaje ejecutados, ponemos las horas planeadas
                                    totalHours = result_pass.hour;
                                }
                                console.log(totalHours);

                                html += '<li>' + result_pass.learning_outcome.name + '<strong> Horas restantes: </strong>' + totalHours + ' - <strong>Trimestre: </strong>'+ result_pass.quarter_number +'</li>';
                                plannedHoursMap[result_pass.learning_outcome.id] = result_pass.hour;
                                learningOutcomeMap[result_pass.learning_outcome.id] = result_pass.learning_outcome.name;
                            });
                            html += '</ul>';
                        });

                        $.each(response.quarterlie, function(competencie, results) {
                            html += '<h6><b>' + competencie + '</b></h6><ul>';
                            $.each(results, function(index, result) {
                                html += '<li>' + result.learning_outcome.name + '<strong> Horas: </strong>' + result.hour + '</li>';
                                plannedHoursMap[result.learning_outcome.id] = result.hour;
                                learningOutcomeMap[result.learning_outcome.id] = result.learning_outcome.name;
                            });
                            html += '</ul>';
                        });

                        // Inserta el HTML en el div con id "quaterlie"
                        $('#quaterlie .card-body').html(html);
                    },
                    error: function() {
                        console.error('Error en la solicitud AJAX');
                    }
                });
                // Obtener resultados de aprendizaje para el nuevo select
                getLearningOutcomesForNewRow();
            } else {

            }
        });

        $('#learning_outcomes_container').on('input', 'input[name="hour[]"]', function() {
            var inputHour = $(this).val(); // Obtener la hora ingresada
            var row = $(this).closest('.learning_outcomes_row'); // Obtener la fila asociada al input
            var learning_outcome_id = row.find('.learning_outcome_select').val(); // Obtener el resultado de aprendizaje seleccionado
            
            if (learning_outcome_id) {
                var plannedHour = plannedHoursMap[learning_outcome_id]; // Obtener la hora planeada del mapa
                var learningOutcome = learningOutcomeMap[learning_outcome_id];

                // Comparar las horas ingresadas con las horas planeadas
                if (inputHour && plannedHour && inputHour > plannedHour) {
                    var message = '<p>La hora registrada es mayor que la programada para el resultado de aprendizaje seleccionado.</p>';
                    message += '<p><strong>'+ learningOutcome +'</strong></p>'
                    message += '<p><strong>Horas planeadas: </strong>' + plannedHour + ' <strong>Horas registradas: </strong> ' + inputHour + '</p>';
                    Swal.fire({
                        icon: 'info',
                        title: 'Advertencia',
                        html: message,
                    });
                }
            }
        });

        // Función para agregar fila de resultado de aprendizaje
        $(document).on('click', '.add_learning_outcomes', function() {
            var newRowHtml = `
                <div class="row align-items-center learning_outcomes_row">
                    <div class="col-8">
                        <div class="form-group">
                            {!! Form::select('learning_outcome[]', [], old('learning_outcome[]'), [
                                'class' => 'form-control select2 learning_outcome_select',
                                'required',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-2">
                            <div class="form-group">
                                {!! Form::number('hour[]', null, ['class' => 'form-control', 'id' => 'hour', 'required']) !!}
                            </div>
                        </div>
                    <div class="col-2">
                        <div class="form-group">
                            <button type="button" class="btn btn-primary add_learning_outcomes"><i class="fas fa-plus"></i></button>
                            <button type="button" class="btn btn-danger delete-row"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            `;
            $('#learning_outcomes_container').append(newRowHtml); // Agregar nueva fila al contenedor

            // Obtener resultados de aprendizaje para el nuevo select
            getLearningOutcomesForNewRow();
        });


        $('.learning_outcome_select').on('change', function() {
            var learning_outcome_id = $(this).val();
            var course_id = $('#course').val();

            if (learning_outcome_id) {
                
                // Obtener instructor para el nuevo select
                getInstructorForNewRow();

                // Obtener ambientes para el nuevo select
                getEnvironmentForNewRow();

                $.ajax({
                    url: '{{ route('sigac.academic_coordination.programming.management.filterstatelearning') }}',
                    method: 'GET',
                    data: {
                        learning_outcome_id: learning_outcome_id,
                        course_id: course_id,
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.status === 'Programado') {
                            var scheduledInfo = response.scheduled_info;

                            var totalHours = 0;
                            var totalMinutes = 0;
                            var message =
                                '<p>El resultado de aprendizaje está programado. Detalles:</p><ul>';
                            scheduledInfo.forEach(function(info) {
                                var startTimeParts = info.start_time.split(':');
                                var endTimeParts = info.end_time.split(':');
                                var startHours = parseInt(startTimeParts[0], 10);
                                var startMinutes = parseInt(startTimeParts[1], 10);
                                var endHours = parseInt(endTimeParts[0], 10);
                                var endMinutes = parseInt(endTimeParts[1], 10);
                                var durationHours = endHours - startHours;
                                var durationMinutes = endMinutes - startMinutes;
                                
                                totalHours += durationHours;
                                totalMinutes += durationMinutes;

                                if (durationMinutes < 0) {
                                    durationHours--;
                                    durationMinutes += 60;
                                    
                                }
                                message += '<li><strong>Fecha:</strong> ' + info
                                    .date + ', <strong>Duración:</strong> ' +
                                    durationHours + ' horas ' + durationMinutes +
                                    ' minutos</li>';
                            });
                            message += '</ul>';
                            message += '<p><strong>Total horas: </strong>'+ totalHours +' horas '+ totalMinutes +' minutos</p>'
                            Swal.fire({
                                icon: 'info',
                                title: 'Información',
                                html: message,
                            });
                        } else {}
                    },
                    error: function() {
                        console.error('Error en la solicitud AJAX');
                    }
                });

            } else {

            }
        });

        // Función para eliminar fila de resultado de aprendizaje
        $(document).on('click', '.delete-row', function() {
            $(this).closest('.learning_outcomes_row').remove();
        });

        // Función para obtener los resultados de aprendizaje para la nueva fila
        function getLearningOutcomesForNewRow() {
            var course_id = $('#course').val();
            $.ajax({
                url: '{{ route('sigac.academic_coordination.programming.management.filterlearning') }}',
                method: 'GET',
                data: {
                    course_id: course_id
                },
                success: function(response) {
                    console.log(response);
                    if (response.learning_outcome) {

                        var learning_outcomeSelect = $('.learning_outcome_select').last();

                        learning_outcomeSelect.empty();
                        learning_outcomeSelect.append(new Option(
                            'Seleccione el resultado de aprendizaje', ''));
                        $.each(response.learning_outcome, function(id, name) {
                            learning_outcomeSelect.append(new Option(name, id));
                        });
                    }
                    $('.learning_outcome_select').select2();

                    learning_outcomeSelect.on('change', function() {
                        var learning_outcome_id = $(this).val();
                        var course_id = $('#course').val();

                        if (learning_outcome_id) {
                            $.ajax({
                                url: '{{ route('sigac.academic_coordination.programming.management.filterstatelearning') }}',
                                method: 'GET',
                                data: {
                                    learning_outcome_id: learning_outcome_id,
                                    course_id: course_id,
                                },
                                success: function(response) {
                                    if (response.status === 'Programado') {
                                        var scheduledInfo = response.scheduled_info;

                                        var totalHours = 0;
                                        var totalMinutes = 0;
                                        var message = '<p>El resultado de aprendizaje está programado. Detalles:</p><ul>';
                                        scheduledInfo.forEach(function(info) {
                                            var startTimeParts = info.start_time.split(':');
                                            var endTimeParts = info.end_time.split(':');
                                            var startHours = parseInt(startTimeParts[0], 10);
                                            var startMinutes = parseInt(startTimeParts[1], 10);
                                            var endHours = parseInt(endTimeParts[0], 10);
                                            var endMinutes = parseInt(endTimeParts[1], 10);
                                            var durationHours = endHours - startHours;
                                            var durationMinutes = endMinutes - startMinutes;

                                            var hours = info.hours; 

                                            totalHours = hours;
                                            totalMinutes += durationMinutes;

                                            if (durationMinutes < 0) {
                                                durationHours--;
                                                durationMinutes += 60;
                                            }
                                            message += '<li><strong>Fecha:</strong> ' + info.date + ', <strong>Duración:</strong> ' + durationHours + ' horas ' + durationMinutes + ' minutos</li>';
                                        });
                                        message += '</ul>';

                                        message += '<p><strong>'+ totalHours +'</strong> Horas programadas.</p>';
                                        
                                        // Mostrar alerta
                                        Swal.fire({
                                            icon: 'info',
                                            title: 'Información',
                                            html: message,
                                        });
                                    }
                                },
                                error: function() {
                                    console.error('Error en la solicitud AJAX');
                                }
                            });
                        }
                    });

                    
                },
                error: function() {
                    console.error('Error en la solicitud AJAX');
                }
            });
        }

        // Función para agregar fila de ambiente
        $(document).on('click', '.add_environment', function() {
            var newRowHtml = `
                <div class="row align-items-center environment_row">
                    <div class="col-8">
                        <div class="form-group">
                            {!! Form::select('environment[]', [], old('environment[]'), [
                                'class' => 'form-control select2 environments',
                                'required',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <button type="button" class="btn btn-primary add_environment"><i class="fas fa-plus"></i></button>
                            <button type="button" class="btn btn-danger delete_environment-row"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            `;
            $('#environments_container').append(newRowHtml); // Agregar nueva fila al contenedor

            // Obtener ambientes para el nuevo select
            getEnvironmentForNewRow();
        });

        // Función para eliminar fila del ambiente
        $(document).on('click', '.delete_environment-row', function() {
            $(this).closest('.environment_row').remove();
        });

        // Obtener ambientes para el nuevo select
        function getEnvironmentForNewRow() {
            var learning_outcome_id = $('.le1').val();
            var admin = $('#lock').is(':checked'); // Obtener el estado del checkbox
            if (!admin) {
                admin = false;
            }
            $.ajax({
                url: '{{ route('sigac.academic_coordination.programming.management.filterenvironment') }}',
                method: 'GET',
                data: {
                    learning_outcome_id: learning_outcome_id,
                    admin: admin,
                },
                success: function(response) {
                    console.log(response);
                    if (response.environments) {

                        var environmentsSelect = $('.environments').last();
                        environmentsSelect.empty();
                        environmentsSelect.append(new Option('Seleccione el ambiente', ''));
                        $.each(response.environments, function(id, name) {
                            environmentsSelect.append(new Option(name, id));
                        });
                    }
                    $('.environments').select2();
                },
                error: function() {
                    console.error('Error en la solicitud AJAX');
                }
            });
        }


        // Función para agregar fila de instructor
        $(document).on('click', '.add_instructor', function() {
            var newRowHtml = `
                <div class="row align-items-center instructor_row">
                    <div class="col-8">
                        <div class="form-group">
                            {!! Form::select('instructor[]', [], old('instructor[]'), [
                                'class' => 'form-control select2 instructors',
                                'required',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <button type="button" class="btn btn-primary add_instructor"><i class="fas fa-plus"></i></button>
                            <button type="button" class="btn btn-danger delete_instructor-row"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            `;
            $('#instructors_container').append(newRowHtml); // Agregar nueva fila al contenedor

            // Obtener instructor para el nuevo select
            getInstructorForNewRow();
        });

        // Función para eliminar fila del instructor
        $(document).on('click', '.delete_instructor-row', function() {
            $(this).closest('.instructor_row').remove();
        });

        // Obtener instructor para el nuevo select
        function getInstructorForNewRow() {
            var learning_outcome_id = $('.le1').val();
            var admin = $('#lock').is(':checked'); // Obtener el estado del checkbox
            if (!admin) {
                admin = false;
            }
            console.log(learning_outcome_id);
            $.ajax({
                url: '{{ route('sigac.academic_coordination.programming.management.filterinstructor') }}',
                method: 'GET',
                data: {
                    learning_outcome_id: learning_outcome_id,
                    admin: admin,
                },
                success: function(response) {
                    console.log(response);
                    if (response.instructors) {
                        var instructorSelect = $('.instructors').last();
                        instructorSelect.empty();
                        instructorSelect.append(new Option('Seleccione el instructor', ''));

                        // Iterar sobre la lista de instructores
                        $.each(response.instructors, function(index, instructor) {
                            instructorSelect.append(new Option(instructor.first_name,
                                instructor.id));
                        });

                        // Inicializa el campo instructor como select2 después de actualizar las opciones
                        instructorSelect.select2();
                    }
                },
                error: function() {
                    console.error('Error en la solicitud AJAX');
                }
            });
        }
    });
</script>
