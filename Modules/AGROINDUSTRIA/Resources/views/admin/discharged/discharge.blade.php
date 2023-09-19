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
                        {!! Form::select('element[]', [], null, ['placeholder' => 'Seleccione un elemento', 'id' => 'element_discharge']) !!}
                        @if ($errors->has('element'))
                          <span class="text-danger">{{ $errors->first('element') }}</span>
                        @endif
                      </div>
                    <div class="form-group">
                        {!! Form::label('amount' , trans('agroindustria::menu.Amount')) !!}
                        {!! Form::number('amount[]', null, ['id' => 'amount']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('lote' , trans('agroindustria::menu.Lote')) !!}
                        {!! Form::text('lote[]', null, ['id' => 'lote', 'readonly'=> 'readonly']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('fVto' , trans('agroindustria::menu.Expiration Date')) !!}
                        {!! Form::text('fVto[]', null, ['id' => 'fVto', 'readonly'=> 'readonly']) !!}
                    </div>
                        <button type="button" class="remove-element">{{trans('agroindustria::menu.Delete')}}</button>
                    </div>
                </div>                           
            </div>
            <div class="button_discharge">
                {!! Form::submit(trans('agroindustria::menu.Register deregistration'),['class' => 'baja', 'name' => 'baja']) !!}
            </div>
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
        // Aplicar Select2 al campo de selección con el id 'elementInventory'
    
        // Agregar un nuevo campo de producto
        $("#add-product").click(function() {
            var newProduct = '<div class="elements_discharge"><div class="form-group">{!! Form::label("elementDischarge" , trans("agroindustria::menu.Element")) !!}{!! Form::select("element[]", [], null, ["placeholder" => "Seleccione un elemento", "id" => "element_discharge"]) !!}</div> <div class="form-group">{!! Form::label("amount" , trans("agroindustria::menu.Amount")) !!} {!! Form::number("amount[]", NULL, ["id" => "amount"]) !!}</div> <div class="form-group">{!! Form::label("lote" , trans("agroindustria::menu.Lote")) !!} {!! Form::number("lote[]", null, ["id" => "lote", "readonly" => "readonly"]) !!}</div> <div class="form-group">{!! Form::label("fVto" , trans("agroindustria::menu.Expiration Date")) !!} {!! Form::text("fVto[]", null, ["id" => "fVto", "readonly" => "readonly"]) !!}{!! Form::hidden("price[]", null, ["id" => "price", "readonly"=> "readonly"]) !!}</div> <button type="button" class="remove-element">{{trans("agroindustria::menu.Delete")}}</button></div>';
    
            // Agregar el nuevo campo al DOM
            $("#elements").append(newProduct);
    
            // Inicializar Select2 en los campos 'element' en el nuevo campo
            $('.element-selected:last').select2();
    
        });
    
        // Escuchar el evento change en el elemento con ID 'products' (delegado)
        $("#elements").on("change", "#element_discharge", function() {            
            var elementoSeleccionado = $(this).val();
            var parentElement = $(this).closest('.elements_discharge');
            var measurementUnitField = parentElement.find('input#measurementUnit');
            var loteField = parentElement.find('input#lote');
            var fVtofield = parentElement.find('input#fVto');
            var pricefield = parentElement.find('input#price');
            

            console.log(elementoSeleccionado);
    
            // Realizar una petición AJAX para obtener la cantidad disponible
            if (elementoSeleccionado) {
                $.ajax({
                    url: {!! json_encode(route('cefa.agroindustria.admin.discharge.elementData', ['id' => ':id'])) !!}.replace(':id', elementoSeleccionado.toString()),
                    method: 'GET',
                    success: function(response) {
                        if (Array.isArray(response.id)) {
                            // Si recibes un arreglo de IDs, puedes recorrerlos aquí
                            response.id.forEach(function(value) {
                                var lote = parseFloat(value.lote);  
                                var fVto = new Date(value.fVto);
                                var options = { day: 'numeric', month: 'numeric',  year: 'numeric'};
                                var formattedFVto = fVto.toLocaleDateString(undefined, options);
                                var price = parseFloat(value.price);  

                                loteField.val(lote);
                                fVtofield.val(formattedFVto);
                                pricefield.val(price);

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
                measurementUnitField.val('');
                loteField.val('');
                fVto.val('');
                price.val('');
            }
        });
        $(document).ready(function() {
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
        });

        $(document).ready(function() {
            // Detecta cambios en el primer campo de selección (Receiver)
            $('#productive_unit').on('change', function() {
                var selectedWarehouse = $(this).val();

                var url = {!! json_encode(route('cefa.agroindustria.admin.discharge.element', ['id' => ':id'])) !!}.replace(':id', selectedWarehouse.toString());

                // Realiza una solicitud AJAX para obtener los almacenes que recibe el receptor seleccionado
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        var options = '<option value="">' + 'Seleccione un elemento' + '</option>';
                        $.each(response.id, function(index, warehouse) {
                            options += '<option value="' + warehouse.id + '">' + warehouse.name + '</option>';
                        });

                        // Actualiza las opciones del segundo campo de selección (Warehouse that Receives)
                        $('#element_discharge').html(options);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
        
        // Eliminar un campo de producto
        $("#elements").on("click", ".remove-element", function() {
            $(this).parent(".elements_discharge").remove();
        });
    });
</script>
@endsection