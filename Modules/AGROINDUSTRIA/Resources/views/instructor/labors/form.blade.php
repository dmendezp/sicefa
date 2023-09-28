@extends('agroindustria::layouts.master')
@section('content')
<div class="container_create">
    <div class="row">
        <div class="col-md-9">
            <div class="form">
                <div class="form-header">{{trans('agroindustria::labors.laborRegistration')}}</div>
                <div class="form-body">
                    {!! Form::open(['url' => route('cefa.agroindustria.units.instructor.labor.register'),'method' => 'post']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('activities', trans('agroindustria::labors.activity')) !!}
                            {!! Form::select('activities', $activity, old('activities'), ['class' => 'form-control', 'id' => 'activity-selected']) !!}  
                            @error('activities')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror                      
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('recipe', trans('agroindustria::labors.recipes')) !!}
                            {!! Form::select('recipe', $recipe, old('recipe'), ['class' => 'form-control']) !!}   
                            @error('recipe')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror                       
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('date_plannig', trans('agroindustria::labors.planningDate')) !!}
                            {!! Form::date('date_plannig', now(), ['id' => 'readonly-bg-gray', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                            @error('date_plannig')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror   
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('date_execution', trans('agroindustria::labors.executionDate')) !!}
                            {!! Form::date('date_execution', null, ['class' => 'form-control']) !!}
                            @error('date_execution')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror   
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('description', trans('agroindustria::labors.description')) !!}
                            {!! Form::textarea('description', null, ['class'=>'form-control', 'id'=>'proccess']) !!}
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror   
                        </div> 
                        <div class="col-md-6">
                            {!! Form::label('observations', trans('agroindustria::labors.observations')) !!}
                            {!! Form::textarea('observations', null, ['class'=>'form-control', 'id' => 'observations']) !!}
                            @error('observations')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror 
                        </div> 
                        <div class="col-md-6">
                            {!! Form::label('destination', trans('agroindustria::labors.destination')) !!}
                            {!! Form::select('destination', $destination, null, ['class'=>'form-control', 'placeholder' => trans("agroindustria::labors.selectDestination")]) !!}
                            @error('destination')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror   
                        </div>  
                        <div class="col-md-6">
                            {!! Form::label('person', trans('agroindustria::labors.responsible')) !!}
                            {!! Form::select('person', [], null, ['class'=>'form-control', 'id' => 'responsible', 'placeholder' => trans("agroindustria::labors.selectResponsiblePerson")]) !!}
                            @error('person')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror   
                        </div>      
                        <div class="col-md-12">
                            <button type="button" id="toggle-form">{{ trans('agroindustria::labors.openCollaboratorFormulatio') }}</button>
                            <div class="executors" id="form-container">
                                <div id="form-executors">
                                    <h3 id="title_executor">{{ trans('agroindustria::labors.collaborators') }}</h3>
                                    <!-- Aquí se agregarán los campos de producto dinámicamente -->
                                    <button type="button" id="add-executor">{{ trans('agroindustria::labors.addCollaborators') }}</button>
                                    <div class="collaborators">
                                        <div class="form-group">
                                            {!! Form::label('personSearch', trans('agroindustria::labors.searchPerson')) !!}
                                            {!! Form::text('search', null, ['class'=>'personSearch-select', 'style' => 'width: 185px']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('collaborator', trans('agroindustria::labors.collaborators')) !!}
                                            {!! Form::hidden('executors_id[]', null, ['class' => 'executors_id']) !!}
                                            {!! Form::text('executor', null, ['class'=>'form-control collaborator_executors', 'readonly' => 'readonly']) !!}
                                        </div>   
                                        <div class="form-group">
                                            {!! Form::label('employement_type', trans('agroindustria::labors.employeeType')) !!}
                                            {!! Form::select('employement_type[]', $employee, null, ['class'=>'form-control employement_type', 'style' => 'width: 200px']) !!}
                                            {!! Form::hidden('price[]', null, ['class' => 'price']) !!}
                                        </div>
                                        <div class="form-group">  
                                            {!! Form::label('hours', trans('agroindustria::labors.hoursWorked')) !!}
                                            {!! Form::number('hours[]', null, ['class'=>'form-control hours']) !!}
                                        </div>            
                                        <button type="button" class="remove-executor">{{trans('agroindustria::menu.Delete')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>             
                        <div class="button_receipe">{!! Form::submit(trans('agroindustria::formulations.Save'),['class' => 'save_receipe', 'name' => 'enviar']) !!}</div>
                    </div>
                    {!! Form:: close() !!}     
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Botón para mostrar el formulario -->

@section('script')
@endsection

<script>
    $(document).ready(function() {
        // Inicialmente, oculta el formulario
        $("#form-container").hide();

        // Botón para abrir/cerrar el formulario
        $("#toggle-form").click(function() {
            // Alternar la visibilidad del formulario
            $("#form-container").toggle();

            // Cambiar el texto del botón en función del estado del formulario
            var buttonText = $("#form-container").is(":visible")
                ? "{{ trans('agroindustria::labors.closeCollaboratorsForm') }}"
                : "{{ trans('agroindustria::labors.openCollaboratorFormulatio') }}";

            // Actualizar el texto del botón
            $(this).text(buttonText);

            // Cambiar el color del botón a rojo cuando el formulario está abierto
            if ($("#form-container").is(":visible")) {
                $(this).css("background-color", "red");
            } else {
                // Restaurar el color original cuando el formulario se cierra
                $(this).css("background-color", ""); // Vaciar el valor para restaurar el color original
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Agregar un nuevo campo de colaborador
        $('.employement_type').select2();

        $("#add-executor").click(function() {
            var newCollaborator = '<div class="collaborators"><div class="form-group">{!! Form::label("personSearch", trans("agroindustria::labors.searchPerson")) !!}{!! Form::text("search", null, ["id"=>"personSearch-select"]) !!}</div> <div class="form-group"> {!! Form::label("collaborator", trans("agroindustria::labors.collaborators")) !!}{!! Form::hidden("executors_id[]", null, ["id" => "executors_id"]) !!}{!! Form::text("executor", null, ["class"=>"form-control", "id" => "collaborator_executors", "readonly" => "readonly"]) !!}</div> <div class="form-group">{!! Form::label("employement_type", trans("agroindustria::labors.employeeType")) !!}{!! Form::select("employement_type[]", $employee, null, ["class"=>"form-control", "id" => "employement_type", "style" => "width: 200px"]) !!}{!! Form::hidden("price[]", null, ["id" => "price"]) !!}</div> <div class="form-group">{!! Form::label("hours", trans("agroindustria::labors.hoursWorked")) !!}{!! Form::number("hours[]", null, ["class"=>"form-control hours"]) !!}</div> <button type="button" class="remove-executor">{{trans("agroindustria::menu.Delete")}}</button></div>';
    
            // Agregar el nuevo campo al DOM
            $("#form-executors").append(newCollaborator);
    
            $('#employement_type:last').select2();
       
            var baseUrl = '{{ route("cefa.agroindustria.units.instructor.labor.executors", ["document_number" => ":document_number"]) }}';
            $('#personSearch-select:last').select2({
                placeholder: '{{trans("agroindustria::labors.searchPerson")}}',
                minimumInputLength: 1, // Habilita la búsqueda en tiempo real
                ajax: {
                    url: function(params) {
                        // Reemplaza el marcador de posición con el término de búsqueda
                        var searchUrl = baseUrl.replace(':document_number', params.term);
    
                        return searchUrl; // Utiliza la URL actualizada con el término de búsqueda
                    },
                    dataType: 'json',
                    delay: 250, // Retardo antes de iniciar la búsqueda
                    processResults: function(data) {
                        return {
                            results: data.id.map(function(person) {
                                return {
                                    id: person.id,
                                    text: person.name,
                                };
                            })
                        };
                    },
                    cache: true
                }
            });

            // Manejar la selección de una persona en el campo de búsqueda
            $('#personSearch-select:last').on('select2:select', function(e) {
                var selectedPerson = e.params.data;
                // Actualizar el contenido de la etiqueta con el nombre de la persona seleccionada
                $(this).closest('.collaborators').find('input#executors_id').val(selectedPerson.id);
                $(this).closest('.collaborators').find('input#collaborator_executors').val(selectedPerson.text);
            });
            // Detecta cambios en el primer campo de selección (Receiver)
            $('#employement_type').on('change', function() {
                var selectedEmployement = $(this).val();
                console.log(selectedEmployement);
                var url = {!! json_encode(route('cefa.agroindustria.units.instructor.labor.price', ['id' => ':id'])) !!}.replace(':id', selectedEmployement.toString());
                // Realiza una solicitud AJAX para obtener los almacenes que recibe el receptor seleccionado
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        // Actualiza las opciones del segundo campo de selección (Warehouse that Receives)
                        var price = response.price;
                        $('#price').val(price);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
        // Eliminar un campo de colaborador
        $("#form-executors").on("click", ".remove-executor", function() {
            $(this).closest('.collaborators').remove();
        });
    });
</script>
<script>
    $(document).ready(function() {
         // Detecta cambios en el primer campo de selección (Receiver)
         $('#activity-selected').on('change', function() {
            var selectedActivity = $(this).val();

            var url = {!! json_encode(route('cefa.agroindustria.units.instructor.labor.responsibilities', ['activityId' => ':activityId'])) !!}.replace(':activityId', selectedActivity.toString());

            // Realiza una solicitud AJAX para obtener los almacenes que recibe el receptor seleccionado
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    var options = '<option value="">' + '{{ trans("agroindustria::labors.selectResponsiblePerson") }}' + '</option>';
                    $.each(response.id, function(index, warehouse) {
                        options += '<option value="' + warehouse.id + '">' + warehouse.name + '</option>';
                    });

                    // Actualiza las opciones del segundo campo de selección (Warehouse that Receives)
                    $('#responsible').html(options);;
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    })
</script>
<script>
    $(document).ready(function() {
         // Detecta cambios en el primer campo de selección (Receiver)
         $('.employement_type').on('change', function() {
            var selectedEmployement = $(this).val();

            var url = {!! json_encode(route('cefa.agroindustria.units.instructor.labor.price', ['id' => ':id'])) !!}.replace(':id', selectedEmployement.toString());

            // Realiza una solicitud AJAX para obtener los almacenes que recibe el receptor seleccionado
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    // Actualiza las opciones del segundo campo de selección (Warehouse that Receives)
                    var price = response.price;
                    $('.price').val(price);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    })
</script>

<script>
   $(document).ready(function() {
        var baseUrl = '{{ route("cefa.agroindustria.units.instructor.labor.executors", ["document_number" => ":document_number"]) }}';

        // Inicializa Select2 en el campo de búsqueda de personas
        $('.personSearch-select').select2({
            placeholder: '{{trans("agroindustria::labors.searchPerson")}}',
            minimumInputLength: 1, // Habilita la búsqueda en tiempo real
            ajax: {
                url: function(params) {
                    // Reemplaza el marcador de posición con el término de búsqueda
                    var searchUrl = baseUrl.replace(':document_number', params.term);


                    return searchUrl; // Utiliza la URL actualizada con el término de búsqueda
                },
                dataType: 'json',
                delay: 250, // Retardo antes de iniciar la búsqueda
                processResults: function(data) {
                    return {
                        results: data.id.map(function(person) {
                            return {
                                id: person.id,
                                text: person.name,
                            };
                        })
                    };
                },
                cache: true
            }
        });

        // Manejar la selección de una persona en el campo de búsqueda
        $('.personSearch-select').on('select2:select', function(e) {
            var selectedPerson = e.params.data;
            // Actualizar el contenido de la etiqueta con el nombre de la persona seleccionada
            $('.executors_id').val(selectedPerson.id);
            $('.collaborator_executors').val(selectedPerson.text);
        });
    });
</script>
@endsection