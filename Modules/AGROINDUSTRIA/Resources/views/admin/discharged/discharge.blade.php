@extends('agroindustria::layouts.master')
@section('content')
<div class="discharge">
    <div class="form">
      <div class="form-header">{{trans('agroindustria::menu.Registration of deregistrations')}}</div>
      <div class="form-body">
        {!! Form::open(['method' => 'post', 'url' => route('cefa.agroindustria.admin.discharge.create')]) !!}
        <div class="row">
            <div class="col-md-6">
                {{--{!! Form::hidden('productiveUnitWarehouse', $productiveUnitWarehouse, ['id' => 'productiveUnitWarehouse']) !!}--}}
                {{--{!! Form::hidden('warehouseId', $warehouseId, ['id' => 'warehouseId']) !!}--}}
                {!! Form::label('date', trans('agroindustria::menu.Date Time')) !!}
                {!! Form::datetime('date', now()->format('Y-m-d\TH:i:s'), ['class' => 'form-control', 'id' => 'readonly-bg-gray', 'readonly' => 'readonly']) !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('productive_unit', 'Unidad Productiva') !!}
                {!! Form::select('productive_unit', $productiveUnit, old('productive_unit'), ['class' => 'form-control', 'id' => 'productive_unit']) !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('inChage', trans('agroindustria::menu.Responsible')) !!}  
                {!! Form::text('inChage', $name, ['class' => 'form-control', 'id' => 'readonly-bg-gray', 'readonly' => 'readonly']) !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('warehouse', 'Bodegas') !!}
                {!! Form::select('warehouse', [], old('warehouse'), ['placeholder' => trans('agroindustria::menu.Select a winery'), 'class' => 'form-control', 'id' => 'warehouse']) !!}
            </div>
            <div class="col-md-12">
                {!! Form::label('observation', trans('agroindustria::menu.Observations')) !!}
                {!! Form::textarea('observation', old('observation'), ['class' => 'form-control', 'id' => 'textarea'] ) !!}
                @error('observation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-12">
                <div id="elements">
                <h3>{{trans('agroindustria::menu.Products')}}</h3>
                <!-- Aquí se agregarán los campos de producto dinámicamente -->
                <button type="button" id="add-product" id="center_button">Agregar Producto</button>
                <div class="elements_discharge">
                    <div class="form-group">
                        {!! Form::label('elementInventory' , trans('agroindustria::menu.Element')) !!}
                        {!! Form::select('element[]', [], null, ['placeholder' => 'Seleccione un elemento', 'id' => 'elementDischarge']) !!}
                        @if ($errors->has('element'))
                          <span class="text-danger">{{ $errors->first('element') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('amount' , trans('agroindustria::menu.Amount')) !!}
                        {!! Form::number('amount[]', null, ['id' => 'amount', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('lote' , trans('agroindustria::menu.Lote')) !!}
                        {!! Form::text('lote[]', null, ['class' => 'form-control', 'id' => 'lote', 'readonly'=> 'readonly']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('fVto' , trans('agroindustria::menu.Expiration Date')) !!}
                        {!! Form::text('fVto[]', null, ['class' => 'form-control', 'id' => 'fVto', 'readonly'=> 'readonly']) !!}
                        {!! Form::hidden('price[]', null, ['id' => 'price']) !!}
                    </div>
                        <button type="button" class="remove-element">{{trans('agroindustria::menu.Delete')}}</button>
                    </div>
                </div>                           
            </div>
        </div>
        <div class="button_discharge">
            {!! Form::submit(trans('agroindustria::menu.Register deregistration'),['class' => 'baja', 'name' => 'baja']) !!}
        </div>
        </div>
    </div>
</div>
{!! Form:: close() !!}


<h3 id="bajas">{{trans('agroindustria::menu.Deregistrations')}}</h3>
<div class="table_discharge">
    @include('agroindustria::admin.discharged.table')
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
        var newProduct = '<div class="elements_discharge"><div class="form-group">{!! Form::label("elementDischarge" , trans("agroindustria::menu.Element")) !!}{!! Form::select("element[]", [], null, ["placeholder" => "Seleccione un elemento", "class" => "elementDischarge-select"]) !!}</div> <div class="form-group">{!! Form::label("amount" , trans("agroindustria::menu.Amount")) !!} {!! Form::number("amount[]", null, ["class" => "form-control", "id" => "amount"]) !!}</div> <div class="form-group">{!! Form::label("lote" , trans("agroindustria::menu.Lote")) !!} {!! Form::text("lote[]", null, ["class" => "form-control", "id" => "lote", "readonly" => "readonly"]) !!}</div> <div class="form-group">{!! Form::label("fVto" , trans("agroindustria::menu.Expiration Date")) !!} {!! Form::text("fVto[]", null, ["class" => "form-control", "id" => "fVto", "readonly" => "readonly"]) !!}{!! Form::hidden("price[]", null, ["id" => "price"]) !!}</div> <button type="button" class="remove-element">{{trans("agroindustria::menu.Delete")}}</button></div>';
        
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


        // Realizar una petición AJAX para obtener la cantidad disponible
        if (elementoSeleccionado) {
            $.ajax({
                url: {!! json_encode(route('cefa.agroindustria.admin.discharge.elementData', ['productiveUnitId' => ':productiveUnitId', 'warehouseId' => ':warehouseId', 'elementId' => ':elementId'])) !!}.replace(':productiveUnitId', productiveUnit.toString()).replace(':warehouseId', warehouse.toString()).replace(':elementId', elementoSeleccionado.toString()),
                method: 'GET',
                success: function(response) {
                    if (Array.isArray(response.id)) {
                        // Si recibes un arreglo de IDs, puedes recorrerlos aquí
                        response.id.forEach(function(value) {
                            var lote = parseFloat(value.lote);  
                            var price = parseFloat(value.price);
                            var fVto = new Date(value.fVto);
                            var options = { day: 'numeric', month: 'numeric',  year: 'numeric'};
                            var formattedFVto = fVto.toLocaleDateString(undefined, options);
                            loteField.val(lote);
                            priceField.val(price);
                            fVtoField.val(formattedFVto);
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
                            var options = { day: 'numeric', month: 'numeric',  year: 'numeric'};
                            var formattedFVto = fVto.toLocaleDateString(undefined, options);
                            loteField.val(lote);
                            priceField.val(price);
                            fVtofield.val(formattedFVto);
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
    // Detecta cambios en el primer campo de selección (Receiver)
    $('#productive_unit').on('change', function() {
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