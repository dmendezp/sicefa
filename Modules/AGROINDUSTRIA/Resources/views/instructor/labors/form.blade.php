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
                        <div class="button_receipe">{!! Form::submit(trans('agroindustria::formulations.Save'),['class' => 'save_receipe', 'name' => 'enviar']) !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Botón para mostrar el formulario -->
<button type="button" id="show-form">{{ trans('agroindustria::labors.openCollaboratorFormulatio') }}</button>
<div class="executors" id="form-container">
    <div id="form-executors">
        <h3>{{ trans('agroindustria::labors.collaborators') }}</h3>
        <!-- Aquí se agregarán los campos de producto dinámicamente -->
        <button type="button" id="add-executor">{{ trans('agroindustria::labors.addCollaborators') }}</button>
        <div class="elements">
            <div class="form-group">
                {!! Form::label('personSearch', trans('agroindustria::labors.collaborators')) !!}
                {!! Form::text('search', null, ['id'=>'personSearch', 'style' => 'width: 185px;']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('executor', trans('agroindustria::labors.selectCollaborator')) !!}
                {!! Form::hidden('executors_id[]', null, ['id' => 'executors_id']) !!}
                {!! Form::text('executor[]', null, ['class'=>'form-control', 'id'=>'executors', 'readonly' => 'readonly']) !!}
            </div>   
            <div class="form-group">
                {!! Form::label('employee_type' , trans('agroindustria::labors.employeeType')) !!}
                {!! Form::select('employee_type[]', $employee, null, ['class'=>'form-control', 'id' => 'employee_type', 'style' => 'width: 200px']) !!}
            </div>
            <div class="form-group">  
                {!! Form::label('hours' ,trans('agroindustria::labors.hoursWorked')) !!}
                {!! Form::number('hours[]', null, ['class'=>'form-control']) !!}
            </div>  
            <button type="button" class="remove-element">{{trans('agroindustria::menu.Delete')}}</button>
        </div>
    </div>
</div>
{!! Form:: close() !!}     

@section('script')
@endsection

<script>
    $(document).ready(function() {
        // Mostrar el formulario al hacer clic en el botón "Show Form"
        $('#show-form').on('click', function() {
            $('#form-container').show(); // Mostrar el formulario
        })
    });
</script>

<script>
    $(document).ready(function() {
        // Agregar un nuevo campo de producto
        $('#employee_type').select2();
        $("#add-executor").click(function() {
            var newProduct = '<div class="elements"><div class="form-group">{!! Form::label("personSearch" , trans("agroindustria::labors.collaborators")) !!} {!! Form::text("search", null, ["class"=>"personSearch-select"]) !!}</div> <div class="form-group">{!! Form::label("executor",trans("agroindustria::labors.selectCollaborator")) !!}{!! Form::hidden("executors_id[]", null, ["id" => "executors_id-new"]) !!}{!! Form::text("executor[]", null, ["class"=>"form-control", "id"=>"executors-new", "readonly" => "readonly"]) !!}</div> <div class="form-group">{!! Form::label("employee_type" , trans("agroindustria::labors.employeeType")) !!}{!! Form::select("employee_type[]", $employee, null, ["class"=>"form-control", "id" => "employee_type-new", "style" => "width: 200px"]) !!}</div> <div class="form-group">{!! Form::label("hours" , trans("agroindustria::labors.hoursWorked")) !!}{!! Form::number("hours[]", null, ["class"=>"form-control"]) !!}</div> <button type="button" class="remove-element">{{trans("agroindustria::menu.Delete")}}</button></div>';

            // Agregar el nuevo campo al DOM
            $("#form-executors").append(newProduct);
            $('#employee_type-new:last').select2();
            var baseUrl = '{{ route("cefa.agroindustria.units.instructor.labor.executors", ["document_number" => ":document_number"]) }}';
            $('.personSearch-select:last').select2({
                placeholder: '{{trans("agroindustria::labors.searchPerson")}}',
                minimumInputLength: 0, // Habilita la búsqueda en tiempo real
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
                $('#executors_id-new').val(selectedPerson.id);
                $('#executors-new').val(selectedPerson.text);
            });
            // Inicializar Select2 en los campos 'element' en el nuevo campo

        });

        // Eliminar un campo de producto
        $("#form-executors").on("click", ".remove-element", function() {
            $(this).parent(".elements").remove();
        });
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
    });
</script>
<script>
   $(document).ready(function() {
        var baseUrl = '{{ route("cefa.agroindustria.units.instructor.labor.executors", ["document_number" => ":document_number"]) }}';

        // Inicializa Select2 en el campo de búsqueda de personas
        $('#personSearch').select2({
            placeholder: '{{trans("agroindustria::labors.searchPerson")}}',
            minimumInputLength: 0, // Habilita la búsqueda en tiempo real
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
        $('#personSearch').on('select2:select', function(e) {
            var selectedPerson = e.params.data;
            // Actualizar el contenido de la etiqueta con el nombre de la persona seleccionada
            $('#executors_id').val(selectedPerson.id);
            $('#executors').val(selectedPerson.text);
        });
    });
</script>
@endsection