@extends('agroindustria::layouts.master')
@section('content')
<h3 id="bajas">{{trans('agroindustria::menu.Deregistrations')}}</h3>
<div class="table_discharge">
    <table id="discharge" class="table table-striped" style="width: 100%;">
        <thead>
            <tr>
                <th>{{trans('agroindustria::menu.Date Time')}}</th>
                <th>{{trans('agroindustria::menu.Responsible')}}</th>
                <th>{{trans('agroindustria::menu.Element')}}</th>
                <th>{{trans('agroindustria::menu.Amount')}}</th>
                <th>{{trans('agroindustria::menu.Price')}}</th>
                <th>{{trans('agroindustria::menu.Total Movement')}}</th>
                <th>{{trans('agroindustria::menu.Observations')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movements as $movement)
                <tr>
                    <td>{{$movement->registration_date}}</td>
                    <td>
                        {{$movement->movement_responsibilities->first()->person->first_name . ' ' .
                        $movement->movement_responsibilities->first()->person->first_last_name . ' ' .
                        $movement->movement_responsibilities->first()->person->second_last_name}}
                    </td>
                    <td>
                        @foreach ($movement->movement_details as $detail)
                            {{$detail->inventory->element->name}}<br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($movement->movement_details as $detail)
                            {{$detail->amount}}<br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($movement->movement_details as $detail)
                            {{$detail->price}}<br>
                        @endforeach
                    </td>
                    <td>{{$movement->price}}</td>
                    <td>{{$movement->observation}}</td>
                </tr>
            @endforeach
        </tbody>
        
    </table>
</div>

@section('script')
@endsection
<script>
$(document).ready(function() {
    var ajaxResponse = null;
    // Inicializar Select2 para el campo 'element_discharge'
    $('#elementDischarge').select2();
   
    // Agregar un nuevo campo de producto
    $("#add-product").click(function() {
        var newProduct = '<div class="elements_discharge"><div class="form-group">{!! Form::label("elementDischarge" , trans("agroindustria::menu.Element")) !!}{!! Form::select("element[]", [], null, ["placeholder" => "Seleccione un elemento", "class" => "elementDischarge-select"]) !!}</div> <div class="form-group"><span class="quantity"></span>{!! Form::label("amount" , trans("agroindustria::menu.Amount")) !!} {!! Form::number("amount[]", null, ["class" => "form-control", "id" => "amount", "style" => "width: 160px"]) !!}</div> <div class="form-group">{!! Form::label("amount" , "Valor unitario") !!}{!! Form::number("price[]", null, ["id" => "price", "readonly" => "readonly", "class" => "form-control", "style" => "width: 160px"]) !!}</div><div class="form-group">{!! Form::label("lote" , trans("agroindustria::menu.Lote")) !!} {!! Form::text("lote[]", null, ["class" => "form-control", "id" => "lote", "readonly" => "readonly", "style" => "width: 160px"]) !!}</div> <div class="form-group">{!! Form::label("fVto" , trans("agroindustria::menu.Expiration Date")) !!} {!! Form::text("fVto[]", null, ["class" => "form-control", "id" => "fVto", "readonly" => "readonly", "style" => "width: 160px"]) !!}{!! Form::hidden("price[]", null, ["id" => "price"]) !!}</div> <button type="button" class="remove-element">{{trans("agroindustria::menu.Delete")}}</button></div>';
        
        // Agregar el nuevo campo al DOM
        $("#elements").append(newProduct);

        // Obtener el último campo select dinámico
        var newElementSelect = $('.elementDischarge-select:last');

        // Llenar el campo select dinámico con la respuesta almacenada
        console.log(ajaxResponse);
        if (ajaxResponse) {
            var options = '<option value="">' + 'Seleccione un elemento' + '</option>';
            $.each(ajaxResponse.id, function(index, warehouse) {
                options += '<option value="' + warehouse.id + '">' + warehouse.name + '</option>';
            });
            newElementSelect.html(options);
        }
        
        // Inicializar Select2 en el campo select dinámico
        newElementSelect.select2();
    });


    // Eliminar un campo de producto
    $("#elements").on("click", ".remove-element", function() {
        $(this).parent(".elements_discharge").remove();
    });

    // Escuchar el evento change en el elemento con ID 'element_discharge' (delegado)
    $("#elements").on("change", "#elementDischarge", function() {
        var elementoSeleccionado = $(this).val();
        var productiveUnit = $('#productive_unit').val();
        var warehouse = $('#warehouse').val();

        // Encontrar el elemento padre más cercano con la clase 'elements_discharge'
        var parentElement = $(this).closest('.elements_discharge');

        var loteField = parentElement.find('input#lote');
        var priceField = parentElement.find('input#price');
        var fVtoField = parentElement.find('input#fVto');
        var quantityField = parentElement.find('.quantity');

        

        // Realizar una petición AJAX para obtener la cantidad disponible
        if (elementoSeleccionado) {
            var url = {!! json_encode(route('cefa.agroindustria.admin.discharge.elementData', ['productiveUnitId' => ':productiveUnitId', 'warehouseId' => ':warehouseId', 'elementId' => ':elementId'])) !!}.replace(':productiveUnitId', productiveUnit.toString()).replace(':warehouseId', warehouse.toString()).replace(':elementId', elementoSeleccionado.toString());
            console.log('url: ' + url);
            $.ajax({
                url: {!! json_encode(route('cefa.agroindustria.admin.discharge.elementData', ['productiveUnitId' => ':productiveUnitId', 'warehouseId' => ':warehouseId', 'elementId' => ':elementId'])) !!}.replace(':productiveUnitId', productiveUnit.toString()).replace(':warehouseId', warehouse.toString()).replace(':elementId', elementoSeleccionado.toString()),
                method: 'GET',
                success: function(response) {
                    console.log(response);
                    if (Array.isArray(response.id)) {
                        // Si recibes un arreglo de IDs, puedes recorrerlos aquí
                        response.id.forEach(function(value) {
                            var lote = parseFloat(value.lote);  
                            var price = parseFloat(value.price);
                            var fVto = new Date(value.fVto);
                            maxQuantity = parseFloat(value.amount);
                            var options = { day: 'numeric', month: 'numeric',  year: 'numeric'};
                            var formattedFVto = fVto.toLocaleDateString(undefined, options);
                            loteField.val(lote);
                            priceField.val(price);
                            fVtoField.val(formattedFVto);

                            updateSaveButtonState(quantityField, 0, maxQuantity);
                            $('#elements').off('input', 'input#amount').on('input', 'input#amount', function() {
                                var amountInput = $(this);
                                var amount = amountInput.val();
                                updateSaveButtonState(quantityField, amount, maxQuantity);
                            });
                        });
                    } else {
                        // Manejar el caso en que el valor no sea un número válido
                        console.error('No se encontró la cantidad disponible válida.');
                    }
                },
                error: function(error) {
                    console.error('Error al obtener la cantidad disponible:', error);
                }
            });
        } else {
            // Si se selecciona la opción predeterminada, dejar el campo de cantidad disponible en blanco
            loteField.val('');
            priceField.val('');
            fVtoField.val('');
        }
    });
    $("#elements").on("change", ".elementDischarge-select", function() {
        var elementoSeleccionado = $(this).val();
        var productiveUnit = $('#productive_unit').val();
        var warehouse = $('#warehouse').val();

        // Encontrar el elemento padre más cercano con la clase 'elements_discharge'
        var parentElement = $(this).closest('.elements_discharge');

        var loteField = parentElement.find('input#lote');
        var priceField = parentElement.find('input#price');
        var fVtofield = parentElement.find('input#fVto');
        var quantityField = parentElement.find('.quantity');

        var url = {!! json_encode(route('cefa.agroindustria.admin.discharge.elementData', ['productiveUnitId' => ':productiveUnitId', 'warehouseId' => ':warehouseId', 'elementId' => ':elementId'])) !!}.replace(':productiveUnitId', productiveUnit.toString()).replace(':warehouseId', warehouse.toString()).replace(':elementId', elementoSeleccionado.toString());
        console.log(url);

        // Realizar una petición AJAX para obtener la cantidad disponible
        if (elementoSeleccionado) {
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    if (Array.isArray(response.id)) {
                        // Si recibes un arreglo de IDs, puedes recorrerlos aquí
                        response.id.forEach(function(value) {
                            var lote = parseFloat(value.lote);
                            var price = parseFloat(value.price);  
                            var fVto = new Date(value.fVto);
                            maxQuantity = parseFloat(value.amount);
                            var options = { day: 'numeric', month: 'numeric',  year: 'numeric'};
                            var formattedFVto = fVto.toLocaleDateString(undefined, options);

                            loteField.val(lote);
                            priceField.val(price);
                            fVtofield.val(formattedFVto);
                            
                            updateSaveButtonState(quantityField, 0, maxQuantity);
                            $('#elements').off('input', 'input#amount').on('input', 'input#amount', function() {
                                var amountInput = $(this);
                                var amount = amountInput.val();
                                updateSaveButtonState(quantityField, amount, maxQuantity);
                            });
                        });
                    } else {
                        // Manejar el caso en que el valor no sea un número válido
                        console.error('No se encontró la cantidad disponible válida.');
                    }
                },
                error: function(error) {
                    console.error('Error al obtener la cantidad disponible:', error);
                }
            });
        } else {
            // Si se selecciona la opción predeterminada, dejar el campo de cantidad disponible en blanco
            loteField.val('');
            priceField.val('');
            fVtofield.val('');
        }
    });

    function updateSaveButtonState(quantityField, amount, maxQuantity) {
            var saveButton = $('.baja');
            console.log(maxQuantity);

            if (amount > maxQuantity) {
                quantityField.text('La cantidad ingresada es mayor que la disponible.').css('color', 'red');
                saveButton.prop('disabled', true);
                saveButton.addClass('disabled-button');
                isAnyProductExceeding = true;
                console.log('Deshabilitado');
            } else {
                quantityField.text('Cantidad Disponible: ' + maxQuantity).css('color', '#666');
                isAnyProductExceeding = false;
                console.log(isAnyProductExceeding);
                if (!isAnyProductExceeding) {
                    saveButton.prop('disabled', false);
                    saveButton.removeClass('disabled-button');
                } else {
                    saveButton.prop('disabled', true);
                    saveButton.addClass('disabled-button');
                }
            }
        }
    // Detecta cambios en el primer campo de selección (Receiver)
    $('#productive_unit').on( function() {
        var selectedProductiveUnit = $(this).val();
        var url = {!! json_encode(route('cefa.agroindustria.admin.discharge.warehouse', ['id' => ':id'])) !!}.replace(':id', selectedProductiveUnit.toString());

        // Realiza una solicitud AJAX para obtener los almacenes que recibe el receptor seleccionado
        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                var options = '<option value="">' + '{{ trans("agroindustria::menu.Select a winery") }}' + '</option>';
                $.each(response.id, function(index, warehouse) {
                    options += '<option value="' + warehouse.id + '">' + warehouse.name + '</option>';
                });

                // Actualiza las opciones del segundo campo de selección (Warehouse that Receives)
                $('#warehouse').html(options);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    // Detecta cambios en el segundo campo de selección (Warehouse)
    $('#warehouse').on('change', function() {
            var selectedWarehouse = $(this).val();
            var productiveUnit = $('#productive_unit').val();
            var url = {!! json_encode(route('cefa.agroindustria.admin.discharge.element', ['productiveUnitId' => ':productiveUnitId', 'warehouseId' => ':warehouseId'])) !!}.replace(':productiveUnitId', productiveUnit.toString()).replace(':warehouseId', selectedWarehouse.toString());
            
            // Realiza una solicitud AJAX para obtener los elementos disponibles en el almacén seleccionado
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    ajaxResponse = response; 
                    var options = '<option value="">' + 'Seleccione un elemento' + '</option>';
                    $.each(response.id, function(index, warehouse) {
                        options += '<option value="' + warehouse.id + '">' + warehouse.name + '</option>';
                    });
                    // Actualiza las opciones en el campo select principal
                    $('#elementDischarge').html(options);

                    // Actualiza las opciones en los campos select dinámicos
                    $('#element').html(options);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    
});
</script>
@endsection