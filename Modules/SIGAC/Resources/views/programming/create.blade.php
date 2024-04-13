@extends('sigac::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/sigac/css/customStyles.css') }}">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('sigac::programming.Breadcrumb_Active_Events') }}</li>
@endpush

@section('content')
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
                    {!! Form::select('course_id', $courses->pluck('program.name', 'id')->map(function ($item, $key) use ($courses) {
                        return $item . ' - ' . $courses->find($key)->code;
                    }), null, ['class' => 'form-select', 'placeholder' => 'Seleccione el curso','id'=> 'course']) !!}
                </div>
                @error('course')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            {!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
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
        <div class="card">
            <div class="card-header">
                <h2>Programación</h2>
            </div>
            <div class="card-body">
                <div class="form-group">
                    {!! Form::label('learning_outcome_id', 'Resultado de Aprendizaje') !!}
                    <div class="input-select">
                        {!! Form::select('learning_outcome_id', [], old('learning_outcome_id'), ['class' => 'form-control select2 learning_outcome_select', 'required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('instructors', 'Instructor') !!}
                    <div class="input-select">
                        {!! Form::select('instructors', [], old('instructors'), ['class' => 'form-control select2 instructors', 'required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('environments', 'Ambiente') !!}
                    <div class="input-select">
                        {!! Form::select('environments', [], old('environments'), ['class' => 'form-control select2 environments', 'required']) !!}
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
                
            } else {
                
            }
        });
    });
</script>

