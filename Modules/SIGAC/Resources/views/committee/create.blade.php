@extends('sigac::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('sigac::programming.Breadcrumb_Active_Events') }}</li>
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                {!! Form::open(['route' => 'sigac.academic_coordination.committee.store', 'method' => 'POST']) !!}
                @csrf
                {!! Form::hidden('novelty_id', $apprentice_novelty->id) !!}
                <div class="form-group">
                    {!! Form::label('date', trans('Fecha del Comite')) !!}
                   {!! Form::date('date', null, [
                        'class' => 'form-control',
                        'id' => 'date',
                        'placeholder' => 'Seleccione la fecha',
                        'required'
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('start_time', trans('Hora de inicio')) !!}
                   {!! Form::time('start_time', null, [
                        'class' => 'form-control',
                        'id' => 'date',
                        'placeholder' => 'Seleccione la hora',
                        'required'
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('end_time', trans('Hora final')) !!}
                   {!! Form::time('end_time', null, [
                        'class' => 'form-control',
                        'id' => 'end_time',
                        'placeholder' => 'Seleccione la hora',
                        'required'
                    ]) !!}
                </div>
                {!! Form::label('person_id', trans('Personas Requeridas')) !!}
                <div class="form-group">
                    <div id="instructor-container">
                        <div class="form-group instructor-field">
                            <div class="row">
                                <!-- Campo de instructor -->
                                <div class="col-md-8">
                                    {!! Form::select('person_id[]', [], null, [
                                        'class' => 'form-control person_id',
                                        'id' => 'person_id',
                                        'placeholder' => 'Ingrese el nombre completo',
                                        'required'
                                    ]) !!}
                                </div>        
                                <!-- Botones de agregar y eliminar -->
                                <div class="col-md-4 d-flex align-items-center">
                                    <button type="button" class="btn btn-danger btn-remove-instructor mr-2">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <button type="button" class="btn btn-primary" id="add-instructor">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::submit(trans('Guardar'), ['class' => 'btn btn-primary','id' => 'standcolor']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {

        $('#person_id').select2({
            placeholder: 'Consulte la persona',
            minimumInputLength: 3,
            ajax: {
                url: '{{ route('sigac.committee.searchperson') }}',
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

        // Función para duplicar el campo de instructor
        $('#add-instructor').on('click', function() {
            // Clona solo el HTML del primer campo de instructor
            var newField = $('.instructor-field:first').clone();

            // Limpia el valor del select y los campos de hora
            newField.find('select').val(null).trigger('change');  // Limpia el select
            newField.find('input[type="time"]').val('');  // Limpia las horas

            // Elimina instancias duplicadas de select2 (si las hubiera)
            newField.find('.select2').remove();
            
            // Elimina el botón "Agregar instructor" de las nuevas filas clonadas
            newField.find('#add-instructor').remove();

            // Asigna un ID único para el select y lo inicializa en Select2
            var uniqueId = 'instructor_' + new Date().getTime();
            newField.find('select').attr('id', uniqueId).select2({
                placeholder: 'Consulte la persona',
                minimumInputLength: 3,
                ajax: {
                    url: '{{ route('sigac.committee.searchperson') }}',
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
            });  // Re-inicializa select2

            // Inserta el nuevo campo en el contenedor
            newField.appendTo('#instructor-container');

            // Re-inicializa Select2 en los campos existentes
            $('.person_id').each(function() {
                $(this).select2({
                    placeholder: 'Consulte la persona',
                    minimumInputLength: 3,
                    ajax: {
                        url: '{{ route('sigac.committee.searchperson') }}',
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

            // Reorganiza los botones de eliminar (sin agregar el de "agregar")
            reorganizeButtons();
        });

        // Función para reorganizar los botones de eliminación
        function reorganizeButtons() {
            // Recorre cada campo de instructor y gestiona los botones
            $('.instructor-field').each(function(index) {
                // Solo añade el botón de eliminar a las filas a partir de la segunda
                if (index > 0 && $(this).find('.btn-remove-instructor').length === 0) {
                    $(this).find('.col-md-4').append(`
                        <button type="button" class="btn btn-danger btn-remove-instructor ml-2">
                            <i class="fas fa-trash"></i>
                        </button>
                    `);
                }
            });
           
        }

        // Función para eliminar el campo de instructor
        $(document).on('click', '.btn-remove-instructor', function() {
            $(this).closest('.instructor-field').remove(); // Elimina el campo completo
            reorganizeButtons(); // Reorganiza los botones después de la eliminación
        });
    });
</script>
@endpush
