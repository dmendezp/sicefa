@extends('sigac::layouts.master')

@push('head')
    <style>
        .input-group .input-group-text {
            background: none;
            border-left: none;
        }

    </style>
@endpush

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12"> {{-- Inicio competencia --}}
                <div class="card card-blue card-outline shadow">
                    <div class="card-header">
                        <h3 class="card-title">Actividades externas</h3>
                        <a class="btn btn-outline-info float-right ml-1" href="{{ route('sigac.' . getRoleRouteName(Route::currentRouteName()) . '.programming.external_activities.index') }}">Volver</a>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'sigac.'. getRoleRouteName(Route::currentRouteName()) .'.programming.external_activities.external_activities_store', 'method' => 'POST']) !!}
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        {!! Form::label('date', 'Fecha') !!}
                                        {!! Form::date('date', null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="col-4">
                                        {!! Form::label('start_time', 'Hora inicio') !!}
                                        {!! Form::time('start_time', null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="col-4">
                                        {!! Form::label('end_time', 'Hora fin') !!}
                                        {!! Form::time('end_time', null, ['class' => 'form-control']) !!}
                                    </div>
                                    
                                    <div class="col-6">
                                        {!! Form::label('description', 'Descripción') !!}
                                        {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Descripción de la actividad', 'style' => 'height: 10px']) !!}
                                    </div>
                                    <div class="col-6">
                                        {!! Form::label('responsible', 'Encargado') !!}
                                        {!! Form::select('responsible', [], null, ['class' => 'form-control', 'id' => 'responsible', 'placeholder' => 'Buscar persona']) !!}
                                    </div>   
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-12">
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <b>Fichas</b>
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="input-group">
                                                    {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Buscar ficha', 'id' => 'search', 'autocomplete' => 'off']) !!}
                                                    <span class="input-group-text bg-white border-0">
                                                        <i class="fas fa-search"></i> <!-- Aquí va el icono -->
                                                    </span>
                                                </div>
                                                <div class="form-check">
                                                    {!! Form::checkbox('all', null, false, ['class' => 'form-check-input', 'id' => 'all']) !!}
                                                    {!! Form::label('all', 'Todas') !!}
                                                </div>
                                                <div id="course-list">
                                                    @foreach($course as $c)
                                                        <div class="form-check">
                                                            {!! Form::checkbox('courses[]', $c['id'], false, ['class' => 'form-check-input courses', 'id' => 'courses']) !!}
                                                            {!! Form::label('course_' . $c['id'], $c['name'], ['class' => 'form-check-label']) !!}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        // Cuando el checkbox "all" cambia de estado
        $('#all').change(function() {
            // Selecciona o deselecciona todos los checkboxes de cursos
            $('.courses').prop('checked', $(this).prop('checked'));
        });

        $('#search').on('keyup', function() {
            var name = $(this).val();
            $.ajax({
                url: "{{ route('sigac.'. getRoleRouteName(Route::currentRouteName()) .'.programming.external_activities.external_activities_search_course') }}", // Ruta que procesará la búsqueda en el servidor
                method: 'GET',
                data: { name: name },
                success: function(data) {
                    // Actualizar el contenedor de cursos con los resultados filtrados
                    $('#course-list').html(data);
                }
            });
        });

        $('select[name="responsible"]:last').select2({
            placeholder: 'Buscar persona',
            minimumInputLength: 3,
            ajax: {
                url: '{{ route('sigac.' . getRoleRouteName(Route::currentRouteName()) . '.programming.external_activities.external_activities_search_person') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        term: params.term,
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
