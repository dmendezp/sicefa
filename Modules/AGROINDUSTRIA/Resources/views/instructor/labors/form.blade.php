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
                        <div class="col-md-12">
                            <button type="button" id="toggle-form-consumables">Registro de consumibles</button>
                            <button type="button" id="toggle-form-tools">Registro de herramientas</button>
                            <button type="button" id="toggle-form">{{ trans('agroindustria::labors.openCollaboratorFormulatio') }}</button>
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
                                            {!! Form::number('amount_consumables[]', null, ['class' => 'form-control', 'id' => 'amount_consumables']) !!}
                                        </div>
                                        <div class="form-group-consumables">   
                                            {!! Form::label('price_consumables', 'Precio') !!} 
                                            {!! Form::text('price_consumables[]', null, ['class' => 'form-control', 'id' => 'price_consumables', 'readonly' => 'readonly']) !!}
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
                                            {!! Form::number('amount_tools[]', null, ['class'=>'form-control']) !!}
                                        </div>   
                                        <div class="form-group">  
                                            {!! Form::label('price', 'Precio') !!}
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

        $("#add-consumables").click(function() {
            var newConsumable = '<div class="consumable"><div class="form-group-consumables">{!! Form::label("consumables", "Consumibles") !!}{!! Form::select("consumables[]", $consumables, null, ["class" => "element-select"]) !!}</div><div class="form-group-consumables"><span class="quantity"></span>{!! Form::label("amount_consumables", "Cantidad") !!}{!! Form::number("amount_consumables[]", null, ["class" => "form-control", "id" => "amount_consumables"]) !!}</div><div class="form-group-consumables">   {!! Form::label("price_consumables", "Precio") !!} {!! Form::text("price_consumables[]", null, ["class" => "form-control", "id" => "price_consumables", "readonly" => "readonly"]) !!}</div>{!! Form::button(trans("agroindustria::request.delete"), ["class"=>"remove-consumables"]) !!}</div> ';
            
            // Agregar el nuevo campo al DOM
            $("#form-consumables").append(newConsumable);

            $('.element-select:last').select2();

        });

        // Eliminar un campo de consumibles
        $("#form-consumables").on("click", ".remove-consumables", function() {
            $(this).closest('.consumable').remove();
        });
        // Almacena las opciones originales en el campo de selección

        // Cuando cambie la selección de recetas
        $('#recipe-select').on('change', function () {
            var selectedRecipeId = $(this).val();

            // Realiza una solicitud AJAX para obtener los ingredientes de la receta
            $.ajax({
                url: '{!! route('cefa.agroindustria.units.instructor.labor.consumables', ['id' => ':id']) !!}'.replace(':id', selectedRecipeId.toString()),
                type: 'GET',
                success: function (data) {
                    // Limpia el contenedor de consumibles
                    $('.consumable:first').empty();
                    // Itera a través de los consumibles y agrega los campos de selección de consumibles
                    $.each(data.consumables, function (index, consumable) {
                        var counter = index + 1; // Incrementa el contador
                        
                        var newConsumableField = '<div class="consumable">' +
                            '<div class="form-group-consumables">' +
                            '<label for="consumables">Consumibles</label>' +
                            '<input type="hidden" name="consumables[]" class="form-control" id="element-select-' + counter + '" value="' + consumable.id + '" readonly>' +
                            '<input type="text" name="name_consumable" class="form-control" id="element_name-' + counter + '" value="' + consumable.name + '" readonly>' +
                            '</div>' +
                            '<div class="form-group-consumables">' +
                            '<span class="quantity">Cantidad disponible: ' + consumable.amount + '</span>' +
                            '<label for="amount_consumables">Cantidad</label>' +
                            '<input type="number" name="amount_consumables[]" class="form-control">' +
                            '</div>' +
                            '<div class="form-group-consumables">' +
                            '<label for="price_consumables">Precio</label>' +
                            '<input type="text" name="price_consumables[]" class="form-control" value="' + consumable.price + '" readonly>' +
                            '</div>' +
                            '</div>';

                        $('.consumable:first').append(newConsumableField);

                        // Inicializa los campos de selección de consumibles con Select2 dentro del contexto de esta iteración
                        (function (currentCounter) {
                            var urlElemets = '{{ route("cefa.agroindustria.units.instructor.labor.elements", ["name" => ":name"]) }}';
                            $('#element-select-' + currentCounter).select2({
                                placeholder: 'Buscar insumos',
                                minimumInputLength: 1,
                                ajax: {
                                    url: function(params) {
                                        var searchUrlElement = urlElemets.replace(':name', params.term);
                                        return searchUrlElement;
                                    },
                                    dataType: 'json',
                                    delay: 250,
                                    processResults: function(data) {
                                        return {
                                            results: data.elements.map(function(element) {
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

                            $('#element-select-' + currentCounter).on('select2:select', function(e) {
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

{{-- Agrega campos dinamicamente para formulario de herramientas --}}
<script>
    $(document).ready(function() {
       // Agregar un nuevo campo de colaborador
       $('.tool_select').select2();

       $("#add-tools").click(function() {
           var newTool = '<div class="tools"><div class="form-group">{!! Form::label("tools", "Herramientas") !!}{!! Form::select("tools[]", $tool, null, ["class" => "tool_select", "style" => "width: 200px"]) !!}</div><div class="form-group">{!! Form::label("amount", "Cantidad") !!}{!! Form::number("amount_tools[]", null, ["class"=>"form-control"]) !!}</div><div class="form-group">{!! Form::label("price", "Precio") !!}{!! Form::number("price_tools[]", null, ["class"=>"form-control", "id" => "price_tool", "readonly" => "readonly"]) !!}</div><button type="button" class="remove-tools">{{trans("agroindustria::menu.Delete")}}</button></div>';
           
           // Agregar el nuevo campo al DOM
           $("#form-tools").append(newTool);

           $('.tool_select:last').select2();

       });

      
       $('#form-tools').on('change', '.tool_select', function() {
           var selectedTool = $(this).val();
           var parentElement = $(this).closest('.tools');
           var priceField = parentElement.find('input#price_tool');

           var url = {!! json_encode(route('cefa.agroindustria.units.instructor.labor.tools.price', ['id' => ':id'])) !!}.replace(':id', selectedTool.toString());
           if (selectedTool) {
                // Realiza una solicitud AJAX para obtener los almacenes que recibe el receptor seleccionado
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        // Actualiza las opciones del segundo campo de selección (Warehouse that Receives)
                        var price = response.price;
                        priceField.val(price);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }else{
                priceField.val('');
            }
       });

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
            var availableQuantity = parentProduct.find('.quantity');
            var availablePrice = parentProduct.find('#price_consumables');
            // Realizar una solicitud AJAX para obtener la cantidad disponible
            if(selectedElement){
                $.ajax({
                    url: {!! json_encode(route('cefa.agroindustria.units.instructor.labor.consumables.amount', ['consumables' => ':consumables'])) !!}.replace(':consumables', selectedElement.toString()),
                    method: 'GET',
                    success: function(response) {
                        if (response.elements.length > 0) {
                            var element = response.elements[0];
                            var quantity = parseFloat(element.amount);
                            var price = parseFloat(element.price);
                            availableQuantity.text('Cantidad Disponible: ' + quantity);
                            availablePrice.val(price);
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
            }else{
                availableQuantity.text(''); 
                availablePrice.val('');
            }
        });
    });
</script>

<<<<<<< Updated upstream
=======
<!-- Botón para mostrar el formulario -->
<button type="button" id="show-form">Abrir Formulario de Equipo</button>
<div class="equipment" id="form-container">
    <table id="equipment-table">
        <thead>
            <tr>
                <th>Id De Inventario</th>
                <th>Cantidad</th>
                <th>Costo</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <!-- Aquí se agregarán las filas de equipos dinámicamente -->
        </tbody>
    </table>
    <button type="button" id="add-equipment">Agregar Equipo</button>
</div>

@section('script')
@endsection

<script>
    $(document).ready(function() {
        // Ocultar el formulario al cargar la página
        $('#form-container').hide();

        // Mostrar u ocultar el formulario al hacer clic en el botón "Toggle Form"
        $('#toggle-form').on('click', function() {
            $('#form-container').toggle(); // Mostrar u ocultar el formulario
        });

        // Agregar una fila de equipo
        $("#add-equipment").click(function() {
            var newRow = '<tr>' +
                '<td><input type="text" name="inventory_id[]" class="form-control"></td>' +
                '<td><input type="number" name="amount[]" class="form-control"></td>' +
                '<td><input type="number" name="price[]" class="form-control"></td>' +
                '<td><button type="button" class="remove-equipment">{{trans("agroindustria::menu.Delete")}}</button></td>' +
                '</tr>';

            // Agregar la nueva fila a la tabla
            $("#equipment-table tbody").append(newRow);
        });

        // Eliminar una fila de equipo
        $("#equipment-table").on("click", ".remove-equipment", function() {
            $(this).closest("tr").remove();
        });
    });
</script>
>>>>>>> Stashed changes
@endsection