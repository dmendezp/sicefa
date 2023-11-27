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
                        <div class="col-md-6" id="recipe-field" style="display: none;">
                            {!! Form::label('recipe', trans('agroindustria::labors.recipes')) !!}
                            {!! Form::select('recipe', $recipe, old('recipe'), ['class' => 'form-control', 'id' => 'recipe-select']) !!}
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
                        <div class="col-md-4" id="date-expiration-field" style="display: none;">
                            {!! Form::label('date_experation', 'Fecha de expiración') !!}
                            {!! Form::date('date_experation', null, ['class' => 'form-control']) !!}
                            @error('date_experation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4" id="lot-field" style="display: none;">
                            {!! Form::label('lot', 'Lote') !!}
                            {!! Form::number('lot', null, ['class' => 'form-control']) !!}
                            @error('lot')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4" id="amount-production-field" style="display: none;">
                            {!! Form::label('amount_production', 'Cantidad') !!}
                            {!! Form::number('amount_production', null, ['class' => 'form-control', 'id' => 'amount_production']) !!}
                            @error('amount_production')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            {!! Form::label('total_labor', 'Total') !!}
                            {!! Form::number('total_labor', null, ['class' => 'form-control', 'id' => 'total_labor', 'readonly' => 'readonly']) !!}
                        </div>
                        <div class="col-md-12">
                            <button type="button" id="toggle-form-consumables">Registro de consumibles</button>
                            <button type="button" id="toggle-form-tools">Registro de herramientas</button>
                            <button type="button" id="toggle-form">{{ trans('agroindustria::labors.openCollaboratorFormulatio') }}</button>
                            <button type="button" id="toggle-form-equipment">Registro de Equipos</button>
                            <button type="button" id="toggle-form-resources">Recursos Ambientales</button>
                            <div class="consumables" id="form-container-consumables">
                                <div id="form-consumables">
                                    <h3>{{trans('agroindustria::request.products')}}</h3>
                                    <!-- Aquí se agregarán los campos de producto dinámicamente -->
                                    <button type="button" id="add-consumables">{{trans('agroindustria::request.addProduct')}}</button>
                                    <div class="consumable">
                                        <div class="form-group-consumables">
                                            {!! Form::label('consumables', 'Consumibles') !!}
                                            {!! Form::select('consumables[]', $consumables, null, ['class' => 'element-select']) !!}
                                        </div>
                                        <div class="form-group-consumables"> 
                                            <span class="quantity"></span>
                                            {!! Form::label('amount_consumables', 'Cantidad') !!}
                                            {!! Form::number('amount_consumables[]', null, ['class' => 'form-control', 'id' => 'amount_consumables', 'step' => '0.01']) !!}
                                        </div>
                                        <div class="form-group-consumables">
                                            {!! Form::label('price_consumable', 'Valor unitario') !!}
                                            {!! Form::number('price_unit_consumable', null, ['class'=>'form-control', 'id' => 'price_unit_consumable', 'readonly' => 'readonly']) !!}
                                        </div>
                                        <div class="form-group-consumables">
                                            {!! Form::label('price_consumable_total', 'Total') !!}
                                            {!! Form::number('price_unit_consumable_total', null, ['class'=>'form-control', 'id' => 'price_unit_consumable_total', 'readonly' => 'readonly']) !!}
                                        </div>
                                        {!! Form::button(trans('agroindustria::request.delete'), ['class'=>'remove-consumables']) !!}                                
                                    </div>                           
                                </div>
                            </div>
                        </div>  
                        <div class="col-md-12">
                            <div class="tools" id="form-container-tools">
                                <div id="form-tools">
                                    <h3 id="title_tools">Herramientas</h3>
                                    <!-- Aquí se agregarán los campos de producto dinámicamente -->
                                    <button type="button" id="add-tools">Añadir herramientas</button>
                                    <div class="tools">
                                        <div class="form-group">
                                            {!! Form::label('tools', 'Herramientas') !!}
                                            {!! Form::select('tools[]', $tool, null, ['class' => 'tool_select', 'style' => 'width: 200px']) !!}
                                        </div>
                                        <div class="form-group">
                                            <span class="quantity"></span>
                                            {!! Form::label('amount', 'Cantidad') !!}
                                            {!! Form::number('amount_tools[]', null, ['class'=>'form-control', 'id' => 'amount_tools']) !!}
                                        </div>   
                                        <div class="form-group">  
                                            {!! Form::label('price', 'Valor unitario') !!}
                                            {!! Form::number('price_unit_tool', null, ['class'=>'form-control', 'id' => 'price_unit_tool', 'readonly' => 'readonly']) !!}
                                        </div> 
                                        <div class="form-group">  
                                            {!! Form::label('price', 'Total') !!}
                                            {!! Form::number('price_tools[]', null, ['class'=>'form-control', 'id' => 'price_tool', 'readonly' => 'readonly']) !!}
                                        </div>            
                                        <button type="button" class="remove-tools">{{trans('agroindustria::menu.Delete')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>   
                        <div class="col-md-12">
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
                        <div class="col-md-12">
                            <div class="equipments" id="form-container-equipments">
                                <div id="form-equipments">
                                    <h3 id="equipments">Equipos</h3>
                                    <!-- Aquí se agregarán los campos de producto dinámicamente -->
                                    <button type="button" id="add-equipments">Añadir Equipos</button>
                                    <div class="equipment">
                                        <div class="form-group">
                                            {!! Form::label('inventories', 'Equipos') !!}
                                            {!! Form::select('equipments[]', $equipment, null, ['class' => 'inventory_select', 'style' => 'width: 200px']) !!}
                                        </div>
                                        <div class="form-group">
                                            <span class="quantity-equipment"></span>
                                            {!! Form::label('amount', 'Cantidad') !!}
                                            {!! Form::number('amount_equipments[]', null, ['class'=>'form-control', 'id' => 'amount_equipments']) !!}
                                        </div>   
                                        <div class="form-group">  
                                            {!! Form::label('price', 'Valor unitario') !!}
                                            {!! Form::number('price_unit_equipment', null, ['class'=>'form-control', 'id' => 'price_unit_equipment', 'readonly' => 'readonly']) !!}
                                        </div> 
                                        <div class="form-group">  
                                            {!! Form::label('price', 'Total') !!}
                                            {!! Form::number('price_equipments[]', null, ['class'=>'form-control', 'id' => 'price_equipment', 'readonly' => 'readonly']) !!}
                                        </div>           
                                        <button type="button" class="remove-equipments">{{trans('agroindustria::menu.Delete')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-12">
                            <div class="resources" id="form-container-resources">
                                <div id="form-resources">
                                    <h3 id="resources">Recursos Ambientales</h3>
                                    <!-- Aquí se agregarán los campos de producto dinámicamente -->
                                    <button type="button" id="add-resources">Registrar Recursos</button>
                                    <div class="resource">
                                        <div class="form-group">
                                            {!! Form::label('environmental_aspect', 'Aspecto Ambientas') !!}
                                            {!! Form::select('environmental_aspect[]', [], null, ['class' => 'environmental_aspect_select', 'id' => 'select_aspect', 'style' => 'width: 200px', 'placeholder' => 'Seleccione un aspecto ambiental']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('amount_environmental_aspect', 'Cantidad') !!}
                                            {!! Form::number('amount_environmental_aspect[]', null, ['class'=>'form-control', 'id' => 'amount_environmental_aspect']) !!}
                                        </div>   
                                        <div class="form-group">  
                                            {!! Form::label('price_environmental_aspect', 'Precio') !!}
                                            {!! Form::number('price_environmental_aspect[]', '0', ['class'=>'form-control', 'id' => 'price_environmental_aspect', 'readonly' => 'readonly']) !!}
                                        </div>           
                                        <button type="button" class="remove-resources">{{trans('agroindustria::menu.Delete')}}</button>
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

@section('script')
@endsection

<script>
    $(document).ready(function () {
        // Agregar un nuevo campo de consumibles
        $('.element-select').select2();

        $("#add-consumables").click(function () {
            var newConsumable = '<div class="consumable"><div class="form-group-consumables">{!! Form::label("consumables", "Consumibles") !!}{!! Form::select("consumables[]", $consumables, null, ["class" => "element-select"]) !!}</div><div class="form-group-consumables"><span class="quantity"></span>{!! Form::label("amount_consumables", "Cantidad") !!}{!! Form::number("amount_consumables[]", null, ["class" => "form-control", "id" => "amount_consumables"]) !!}</div><div class="form-group-consumables">{!! Form::label("price_consumable", "Valor unitario") !!}{!! Form::number("price_unit_consumable", null, ["class"=>"form-control", "id" => "price_unit_consumable", "readonly" => "readonly"]) !!}</div><div class="form-group-consumables">{!! Form::label("price_consumable_total", "Total") !!}{!! Form::number("price_unit_consumable_total", null, ["class"=>"form-control", "id" => "price_unit_consumable_total", "readonly" => "readonly"]) !!}</div>{!! Form::button(trans("agroindustria::request.delete"), ["class"=>"remove-consumables"]) !!}</div>';

            // Agregar el nuevo campo al DOM
            $("#form-consumables").append(newConsumable);

            $('.element-select:last').select2();
        });
        
        // Cuando cambie la selección de recetas
        $('#recipe-select').on('change', function () {
            updateConsumables();
        });

        // Cuando cambie la cantidad inicial
        $('#amount_production').on('input', function () {
            updateConsumables();
        });

        function updateConsumables() {
            var amount = $('#amount_production').val(); // Obtener la cantidad actual en tiempo real
            var url = {!! json_encode(route('cefa.agroindustria.units.instructor.labor.consumables', ['id' => ':id'])) !!}.replace(':id', $('#recipe-select').val().toString());

            // Realiza una solicitud AJAX para obtener los ingredientes de la receta
            $.ajax({
                url: '{!! route('cefa.agroindustria.units.instructor.labor.consumables', ['id' => ':id']) !!}'.replace(':id', $('#recipe-select').val().toString()),
                type: 'GET',
                success: function (data) {
                    // Limpia el contenedor de consumibles
                    var $consumableContainer = $('.consumable:first');
                    $consumableContainer.empty();

                    var totalPriceConsumables = 0;

                    // Itera a través de los consumibles y agrega los campos de selección de consumibles
                    $.each(data.consumables, function (index, consumable) {
                        var counter = index + 1; // Incrementa el contador
                        var amountFormulation = data.amountFormulation[0].amountFormulation;
                        var amountIngredient = data.amountIngredient[index].amountIngredient;
                        var amountPerFormulation = amountIngredient / amountFormulation;

                        var totalAmount = amountPerFormulation * amount; // Calcular la cantidad total

                        var totalPrice = totalAmount * consumable.price;

                        totalPriceConsumables += totalPrice;
                        
                        var newConsumableField = '<div class="consumable recipe-product">' +
                            '<div class="form-group-consumables">' +
                            '<label for="consumables">Buscar Consumibles</label>' +
                            '<input type="hidden" name="consumables[]" class="form-control" id="element-select-' + counter + '" value="' + consumable.id + '" style="width: 200px;" readonly>' +
                            '</div>' +
                            '<div class="form-group-consumables">' +
                            '<label for="consumables">Consumibles</label>' +
                            '<input type="text" name="name_consumable" class="form-control" id="element_name-' + counter + '" value="' + consumable.name + '" readonly>' +
                            '</div>' +
                            '<div class="form-group-consumables">' +
                            '<span class="quantity">Cantidad disponible: ' + consumable.amount + '</span>' +
                            '<label for="amount_consumables">Cantidad</label>' +
                            '<input type="number" name="amount_consumables[]" id="amount_consumables_formulation" class="form-control" value="' + totalAmount + '" readonly>' +
                            '</div>' +
                            '<div class="form-group-consumables">' +
                            '<span class="price_unit">Valor unitario: ' + consumable.price + '</span>' +
                            '<label for="amount_consumables">Total</label>' +
                            '<input type="number" name="total_price_consumable" id="total_price_consumable" class="form-control" value="' + totalPrice + '" readonly>' +
                            '</div>' +
                            '<button type="button" class="remove-consumables">{{trans("agroindustria::request.delete")}}</button>'
                            '</div>';

                        $consumableContainer.append(newConsumableField);

                        // Actualizar el campo "Total de la Labor"
                        $('input[name="total_labor"]').val(totalPriceConsumables);
                        

                        // Inicializa los campos de selección de consumibles con Select2 dentro del contexto de esta iteración
                        (function (currentCounter) {
                            var urlElemets = '{{ route("cefa.agroindustria.units.instructor.labor.elements", ["name" => ":name"]) }}';
                            $('#element-select-' + currentCounter).select2({
                                placeholder: 'Buscar insumos',
                                minimumInputLength: 1,
                                ajax: {
                                    url: function (params) {
                                        var searchUrlElement = urlElemets.replace(':name', params.term);
                                        return searchUrlElement;
                                    },
                                    dataType: 'json',
                                    delay: 250,
                                    processResults: function (data) {
                                        return {
                                            results: data.elements.map(function (element) {
                                                return {
                                                    id: element.id,
                                                    text: element.name,
                                                };
                                            })
                                        };
                                    },
                                    cache: true
                                }
                            });

                            $('#element-select-' + currentCounter).on('select2:select', function (e) {
                                var selectedElement = e.params.data;
                                $(this).closest('.consumable').find('input#element-select-' + currentCounter).val(selectedElement.id);
                                $(this).closest('.consumable').find('input#element_name-' + currentCounter).val(selectedElement.text);
                            });
                        })(counter); // Pasa el valor de counter al contexto de la función autoinvocada
                    });
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }

        // Llamar a updateConsumables al cargar la página
        updateConsumables();
        // Eliminar un campo de consumibles
        $("#form-consumables").on("click", ".remove-consumables", function () {
            $(this).closest('.consumable').remove();
        });
    });
</script>

{{-- Agrega campos dinamicamente para formulario de ejecutores --}}
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

{{-- Agrega campos dinamicamente para formulario de herramientas --}}
<script>
    $(document).ready(function() {
       // Agregar un nuevo campo de colaborador
       $('.tool_select').select2();

       $("#add-tools").click(function() {
           var newTool = '<div class="tools"><div class="form-group">{!! Form::label("tools", "Herramientas") !!}{!! Form::select("tools[]", $tool, null, ["class" => "tool_select", "style" => "width: 200px"]) !!}</div><div class="form-group">{!! Form::label("amount", "Cantidad") !!}{!! Form::number("amount_tools[]", null, ["class"=>"form-control", "id" => "amount_tools"]) !!}</div><div class="form-group">{!! Form::label("price", "Valor Unitario") !!}{!! Form::number("price_unit_tool", null, ["class"=>"form-control", "id" => "price_unit_tool", "readonly" => "readonly"]) !!}</div><div class="form-group">{!! Form::label("price", "Total") !!}{!! Form::number("price_tools[]", null, ["class"=>"form-control", "id" => "price_tool", "readonly" => "readonly"]) !!}</div><button type="button" class="remove-tools">{{trans("agroindustria::menu.Delete")}}</button></div>';
           
           // Agregar el nuevo campo al DOM
           $("#form-tools").append(newTool);

           $('.tool_select:last').select2();

       });

       
       $('#form-tools').on('change', '.tool_select', function() {
            var selectedTool = $(this).val();
            var parentElement = $(this).closest('.tools');
            var priceField = parentElement.find('input#price_unit_tool');
            var quantityField = parentElement.find('.quantity');

            if (selectedTool) {
                // Realiza una solicitud AJAX para obtener el precio de la herramienta seleccionada
                var url = {!! json_encode(route('cefa.agroindustria.units.instructor.labor.tools.price', ['id' => ':id'])) !!}.replace(':id', selectedTool.toString());

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
                        if(response.data.length > 0){
                            var data = response.data[0];
                            var quantity = parseFloat(data.amount);
                            var price = parseFloat(data.price);
                        
                            quantityField.text('Cantidad Disponible: ' + quantity);
                            priceField.val(price);
                            updateTotalPrice(); // Actualizar el precio total cuando se selecciona la herramienta
                        }else{
                            quantityField.text('');
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            } else {
                priceField.data('price', 0);
                updateTotalPrice(); // Actualizar el precio total cuando no se selecciona una herramienta
                updateTotalLaborPrice();
            }
        });

        $('#form-tools').on('input', 'input#amount_tools', function() {
            updateTotalPrice(); // Actualizar el precio total cuando se modifica la cantidad
            updateTotalLaborPrice();
        });

        function updateTotalLaborPrice() {
            var totalPriceEquipments = 0;
            var totalPriceTools = 0;
            var totalPriceConsumables = 0;
            var totalPriceRecipes = 0;

            $('#form-equipments .equipment').each(function() {
                var totalField = $(this).find('input#price_equipment');
                var totalPrice = parseInt(totalField.val()) || 0;
                totalPriceEquipments += totalPrice;
            });

            $('#form-tools .tools').each(function() {
                var totalField = $(this).find('input#price_tool');
                var totalPrice = parseInt(totalField.val()) || 0;
                totalPriceTools += totalPrice;
            });

            // Calcular el total de productos de receta fuera del bucle
            $('.recipe-product').each(function() {
                var totalRecipeField = $(this).find('input#total_price_consumable');
                var totalRecipePrice = parseFloat(totalRecipeField.val()) || 0;
                totalPriceRecipes += totalRecipePrice;
            });

            $('.consumable').each(function() {
                var totalField = $(this).find('input#price_unit_consumable_total');
                var totalPrice = parseFloat(totalField.val()) || 0;

                totalPriceConsumables += totalPrice;
            });

            var total = totalPriceEquipments + totalPriceTools + totalPriceRecipes + totalPriceConsumables;

            $('input[name="total_labor"]').val(total);
        }

        function updateTotalPrice() {
            var totalPrice = 0;
            $('.tools').each(function() {
                var priceField = $(this).find('input#price_unit_tool');
                var price = parseInt(priceField.val()) || 0;
                var amountField = $(this).find('input#amount_tools');
                var amount = parseInt(amountField.val()) || 0;
                var totalField = $(this).find('input#price_tool');
                var totalPrice = price * amount;
                totalField.val(totalPrice);
            });
        }


        // Eliminar un campo de colaborador
        $("#form-tools").on("click", ".remove-tools", function() {
           $(this).closest('.tools').remove();
       });
   });
</script>

<script>
    $(document).ready(function() {
        $("#form-consumables").on("change", "select[name^='consumables']", function() {
            var selectedElement = $(this).val();
            var parentProduct = $(this).closest('.consumable');
            var availablePriceUnit = parentProduct.find('input#price_unit_consumable');
            var availableQuantity = parentProduct.find('.quantity');

            // Realizar una solicitud AJAX para obtener la cantidad disponible
            if (selectedElement) {
                $.ajax({
                    url: {!! json_encode(route('cefa.agroindustria.units.instructor.labor.consumables.amount', ['consumables' => ':consumables'])) !!}.replace(':consumables', selectedElement.toString()),
                    method: 'GET',
                    success: function(response) {
                        if (response.elements.length > 0) {
                            var element = response.elements[0];
                            var price = parseFloat(element.price);
                            var quantity = parseFloat(element.amount);
                            availableQuantity.text('Cantidad Disponible: ' + quantity);
                            availablePriceUnit.val(price);
                            updateTotalPrice();
                        } else {
                            availableQuantity.text(''); // Limpia el texto si no se encuentra la cantidad disponible
                        }
                    },
                    error: function(error) {
                        console.error('Error al obtener la cantidad disponible:', error);
                        availableQuantity.text(''); // Limpia el texto en caso de error
                        availablePrice.val('');
                    }
                });
            } else {
                availableQuantity.text('');
                availablePriceField.data('price', 0);
                updateTotalPrice(); // Actualizar el precio total cuando no se selecciona un consumible
            }
        });

        $('#form-consumables').on('input', 'input#amount_consumables', function() {
            updateTotalPrice();
            updateTotalLaborPrice();
        });

        function updateTotalLaborPrice() {
            var totalPriceEquipments = 0;
            var totalPriceTools = 0;
            var totalPriceConsumables = 0;
            var totalPriceRecipes = 0;

            $('#form-equipments .equipment').each(function() {
                var totalField = $(this).find('input#price_equipment');
                var totalPrice = parseInt(totalField.val()) || 0;
                totalPriceEquipments += totalPrice;
            });

            $('#form-tools .tools').each(function() {
                var totalField = $(this).find('input#price_tool');
                var totalPrice = parseInt(totalField.val()) || 0;
                totalPriceTools += totalPrice;
            });

            // Calcular el total de productos de receta fuera del bucle
            $('.recipe-product').each(function() {
                var totalRecipeField = $(this).find('input#total_price_consumable');
                var totalRecipePrice = parseFloat(totalRecipeField.val()) || 0;
                totalPriceRecipes += totalRecipePrice;
            });

            $('.consumable').each(function() {
                var totalField = $(this).find('input#price_unit_consumable_total');
                var totalPrice = parseFloat(totalField.val()) || 0;

                totalPriceConsumables += totalPrice;
            });

            var total = totalPriceEquipments + totalPriceTools + totalPriceRecipes + totalPriceConsumables;

            $('input[name="total_labor"]').val(total);
        }


        function updateTotalPrice() {
            var totalPrice = 0;
            $('.consumable').each(function() {
                var availableTotal = $(this).find('input#price_unit_consumable_total');
                var availableAmount = $(this).find('input#amount_consumables');
                var priceField = $(this).find('input#price_unit_consumable');
                var amount = parseInt(availableAmount.val()) || 0;
                var price = parseFloat(priceField.val()) || 0;
                var totalPrice = price * amount;
                availableTotal.val(totalPrice);
            });
        }
    });
</script>

<script>
    $(document).ready(function() {
        $("#add-equipments").click(function() {
           var newEquipment = '<div class="equipment"><div class="form-group">{!! Form::label("inventories", "Equipos") !!}{!! Form::select("equipments[]", $equipment, null, ["class" => "inventory_select", "style" => "width: 200px"]) !!}</div><div class="form-group"><span class="quantity-equipment"></span>{!! Form::label("amount", "Cantidad") !!}{!! Form::number("amount_equipments[]", null, ["class"=>"form-control", "id" => "amount_equipments"]) !!}</div><div class="form-group">{!! Form::label("price", "Valor Unitario") !!}{!! Form::number("price_unit_equipment", null, ["class"=>"form-control", "id" => "price_unit_equipment", "readonly" => "readonly"]) !!}</div><div class="form-group">{!! Form::label("price", "Total") !!}{!! Form::number("price_equipments[]", null, ["class"=>"form-control", "id" => "price_equipment", "readonly" => "readonly"]) !!}</div><button type="button" class="remove-equipments">{{trans("agroindustria::menu.Delete")}}</button></div>';
           
           // Agregar el nuevo campo al DOM
           $("#form-equipments").append(newEquipment);
       });

       $('#form-equipments').on('change', '.inventory_select', function() {
            var selectedEquipment = $(this).val();
            var parentElement = $(this).closest('.equipment');
            var priceField = parentElement.find('input#price_unit_equipment');
            var quantityField = parentElement.find('.quantity-equipment');
            if (selectedEquipment) {
                // Realiza una solicitud AJAX para obtener el precio de la herramienta seleccionada
                var url = {!! json_encode(route('cefa.agroindustria.units.instructor.labor.equipments.amounteq', ['equipments' => ':equipments'])) !!}.replace(':equipments', selectedEquipment.toString());
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        if(response.elements.length > 0){
                            var data = response.elements[0];
                            var quantity = parseFloat(data.amount);
                            var price = parseFloat(data.price);

                            quantityField.text('Cantidad Disponible: ' + quantity);
                            priceField.val(price);
                            updateTotalPrice(); // Actualizar el precio total cuando se selecciona la herramienta
                            updateTotalLaborPrice();
                        }else{
                            quantityField.text('');
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        quantityField.text('');
                    }
                });
            } else {
                quantityField.text('');
                priceField.data('price', 0);
                updateTotalPrice(); // Actualizar el precio total cuando no se selecciona una herramienta
                updateTotalLaborPrice();
            }
        });


        $('#form-equipments').on('input', 'input#amount_equipments', function() {
            updateTotalPrice(); // Actualizar el precio total cuando se modifica la cantidad
            updateTotalLaborPrice();
        });

        function updateTotalLaborPrice() {
            var totalPriceEquipments = 0;
            var totalPriceTools = 0;
            var totalPriceConsumables = 0;
            var totalPriceRecipes = 0;

            $('#form-equipments .equipment').each(function() {
                var totalField = $(this).find('input#price_equipment');
                var totalPrice = parseInt(totalField.val()) || 0;
                totalPriceEquipments += totalPrice;
            });

            $('#form-tools .tools').each(function() {
                var totalField = $(this).find('input#price_tool');
                var totalPrice = parseInt(totalField.val()) || 0;
                totalPriceTools += totalPrice;
            });

            // Calcular el total de productos de receta fuera del bucle
            $('.recipe-product').each(function() {
                var totalRecipeField = $(this).find('input#total_price_consumable');
                var totalRecipePrice = parseFloat(totalRecipeField.val()) || 0;
                totalPriceRecipes += totalRecipePrice;
            });

            $('.consumable').each(function() {
                var totalField = $(this).find('input#price_unit_consumable_total');
                var totalPrice = parseFloat(totalField.val()) || 0;

                totalPriceConsumables += totalPrice;
            });

            var total = totalPriceEquipments + totalPriceTools + totalPriceRecipes + totalPriceConsumables;

            $('input[name="total_labor"]').val(total);
        }

        function updateTotalPrice() {
            var totalPrice = 0;
            $('.equipment').each(function() {
                var availableTotal = $(this).find('input#price_equipment');
                var availableAmount = $(this).find('input#amount_equipments');
                var priceField = $(this).find('input#price_unit_equipment');
                var amount = parseInt(availableAmount.val()) || 0;
                var price = parseFloat(priceField.val()) || 0;
                var totalPrice = price * amount;
                availableTotal.val(totalPrice);
            });
        }

       // Eliminar un campo de colaborador
       $("#form-equipments").on("click", ".remove-equipments", function() {
           $(this).closest('.equipment').remove();
       });
    });
</script>

<script>
    $(document).ready(function () {
        // Agregar un nuevo campo de colaborador
        $('.environmental_aspect_select').select2();

        $("#add-resources").click(function () {
            var newResource = '<div class="resource">' +
                '<div class="form-group">' +
                '{!! Form::label("environmental_aspect", "Aspecto Ambiental") !!}' +
                '{!! Form::select("environmental_aspect[]", [], null, ["class" => "environmental_aspect_select", "style" => "width: 200px", "placeholder" => "Seleccione un aspecto ambiental"]) !!}' +
                '</div>' +
                '<div class="form-group">' +
                '{!! Form::label("amount_environmental_aspect", "Cantidad") !!}' +
                '{!! Form::number("amount_environmental_aspect[]", null, ["class"=>"form-control"]) !!}' +
                '</div>' +
                '<div class="form-group">' +
                '{!! Form::label("price_environmental_aspect", "Precio") !!}' +
                '{!! Form::number("price_environmental_aspect[]", "0", ["class"=>"form-control", "readonly" => "readonly"]) !!}' +
                '</div>' +
                '<button type="button" class="remove-resources">{{trans("agroindustria::menu.Delete")}}</button>' +
                '</div>';

            // Agregar el nuevo campo al DOM
            $("#form-resources").append(newResource);

            // Inicializar Select2 para el nuevo campo
            $('.environmental_aspect_select').select2();

            environmental();
        });

        function environmental(){
            $('#activity-selected').on('change', function () {
                var selectedActivity = $(this).val();
                // Actualizar todas las opciones para cada elemento .environmental_aspect_select
                $('.environmental_aspect_select').each(function () {
                    var url = {!! json_encode(route('cefa.agroindustria.units.instructor.labor.resource', ['activity_id' => ':activity_id'])) !!}.replace(':activity_id', selectedActivity.toString());
                    console.log(url);
                    // Realizar una solicitud AJAX para obtener los aspectos ambientales
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function (response) {
                            var options = '<option value="">' + 'Seleccione un aspecto ambiental' + '</option>';
                            $.each(response.aspect, function (index, aspect) {
                                options += '<option value="' + aspect.id + '">' + aspect.name + '</option>';
                            });
                            // Actualizar las opciones del campo de aspecto ambiental actual
                            $('.environmental_aspect_select').html(options);
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                });
            });
             // Ejecutar la función al cargar el documento
             $('#activity-selected').trigger('change');
        }    

        // Llamar a environmental al cargar el documento
        environmental();
        
        // Eliminar un campo de colaborador
        $("#form-resources").on("click", ".remove-resources", function () {
            $(this).closest('.resource').remove();
        });
    });
</script>


<script>
    function updateTotalLaborPrice() {
        
        var totalPriceEquipments = 0;
        $('.equipment').each(function() {
            var totalField = $(this).find('input#price_equipment');
            var totalPrice = parseFloat(totalField.val()) || 0;
            console.log('Equipos: ' + totalPrice);
            totalPriceEquipments += totalPrice;
        });
        var totalPriceExecutors = 0;
        $('.collaborators').each(function() {
            var totalField = $(this).find('input#price');
            var totalPrice = parseFloat(totalField.val()) || 0;
            console.log('Ejecutores: ' + totalPrice);
            totalPriceExecutors += totalPrice;
        });
       
        // Calcular el total general
        var totalLaborPrice = totalPriceEquipments + totalPriceExecutors + totalPriceTools;
        console.log('Total: ' + totalLaborPrice);
        // Actualizar el campo "Total de la Labor"
        $('#total_labor').val(totalLaborPrice);
    }

</script>
@endsection