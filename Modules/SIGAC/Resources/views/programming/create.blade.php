@extends('sigac::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/sigac/css/customStyles.css') }}">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('sigac::programming.Breadcrumb_Active_Events') }}</li>
@endpush

@section('content')
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                {!! Form::open(['route' => 'sigac.academic_coordination.programming.management.store', 'method' => 'POST']) !!}
                @csrf
                <div class="form-group">
                    {!! Form::label('querter_number', 'Trimestre') !!}
                    <div class="input-select">
                        {!! Form::select('querter_number', ['' => trans('Seleccione el trimestre'), '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7'], null, ['class' => 'form-control', 'required' , 'id' => 'quarter_number']) !!}
                    </div>
                    @error('course')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('course', 'Curso') !!}
                    <div class="input-select">
                        {!! Form::select('course', $courses->pluck('program.name', 'id')->map(function ($item, $key) use ($courses) {
                            return $item . ' - ' . $courses->find($key)->code;
                        }), null, ['class' => 'form-select', 'placeholder' => 'Seleccione el curso','id'=> 'course']) !!}
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
                <h2>Programación</h2>
            </div>
            <div class="card-body">
                @if(session('mensaje'))
                    <p>
                        {{ session('mensaje') }}
                    </p>
                @endif
                <div class="form-group">
                    {!! Form::label('learning_outcome', 'Resultado de Aprendizaje') !!}
                    <div class="input-select">
                        {!! Form::select('learning_outcome', [], old('learning_outcome'), ['class' => 'form-control select2 learning_outcome_select', 'required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('instructor', 'Instructor') !!}
                    <div class="input-select">
                        {!! Form::select('instructor', [], old('instructor'), ['class' => 'form-control select2 instructors', 'required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('environment', 'Ambiente') !!}
                    <div class="input-select">
                        {!! Form::select('environment', [], old('environment'), ['class' => 'form-control select2 environments', 'required']) !!}
                    </div>
                </div>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <b>Seleccion de fechas</b>
                        </button>
                      </h2>
                      <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
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
                {!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
    
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#course').select2(); // Inicializa el campo course como select2
        $('#quaterlie').hide(); // Ocultar trimestralizacion


        $('#course').on('change', function() {
            var course_id = $(this).val();
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
                    $.each(response.quarterlie, function(competencie, results) {
                        html += '<h6><b>' + competencie + '</b></h6><ul>';
                        $.each(results, function(index, result) {
                            html += '<li>' + result.learning_outcome.name + '</li>';
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
                            learning_outcomeSelect.append(new Option('Seleccione el resultado de aprendizaje', ''));
                            $.each(response.learning_outcome, function(id , name) {
                                learning_outcomeSelect.append(new Option(name, id));
                            });
                        }
                        $('.learning_outcome_select').select2(); // Inicializa el campo course como select2
                    },
                    error: function() {
                        console.error('Error en la solicitud AJAX');
                    }
                });
            } else {
                
            }
        });
        $('.learning_outcome_select').on('change', function() {
            var learning_outcome_id = $(this).val();

            if (learning_outcome_id) {
                $.ajax({
                    url: '{{ route('sigac.academic_coordination.programming.management.filterinstructor') }}',
                    method: 'GET',
                    data: {
                        learning_outcome_id: learning_outcome_id,
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.instructors) {
                            
                            var instructorSelect = $('.instructors').last();
                            instructorSelect.empty();
                            instructorSelect.append(new Option('Seleccione el instructor', ''));
                            $.each(response.instructors, function(id , first_name) {
                                instructorSelect.append(new Option(first_name, id));
                            });
                        }
                        $('.instructors').select2(); // Inicializa el campo course como select2
                    },
                    error: function() {
                        console.error('Error en la solicitud AJAX');
                    }
                });
                $.ajax({
                    url: '{{ route('sigac.academic_coordination.programming.management.filterenvironment') }}',
                    method: 'GET',
                    data: {
                        learning_outcome_id: learning_outcome_id,
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.environments) {
                            
                            var environmentsSelect = $('.environments').last();
                            environmentsSelect.empty();
                            environmentsSelect.append(new Option('Seleccione el ambiente', ''));
                            $.each(response.environments, function(id , name) {
                                environmentsSelect.append(new Option(name, id));
                            });
                        }
                        $('.instructors').select2(); // Inicializa el campo course como select2
                    },
                    error: function() {
                        console.error('Error en la solicitud AJAX');
                    }
                });

                $.ajax({
                    url: '{{ route('sigac.academic_coordination.programming.management.filterstatelearning') }}',
                    method: 'GET',
                    data: {
                        learning_outcome_id: learning_outcome_id,
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.status === 'Programado') {
                            var scheduledInfo = response.scheduled_info;
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
                                if (durationMinutes < 0) {
                                    durationHours--;
                                    durationMinutes += 60;
                                }
                                message += '<li><strong>Fecha:</strong> ' + info.date + ', <strong>Duración:</strong> ' + durationHours + ' horas ' + durationMinutes + ' minutos</li>';
                            });
                            message += '</ul>';
                            message += '<p>Observacion: Una hora es de almuerzo</p>';
                            Swal.fire({
                                icon: 'info',
                                title: 'Información',
                                html: message,
                            });
                        } else {
                        }
                    },
                    error: function() {
                        console.error('Error en la solicitud AJAX');
                    }
                });
                
            } else {
                
            }
        });
    });
</script>

