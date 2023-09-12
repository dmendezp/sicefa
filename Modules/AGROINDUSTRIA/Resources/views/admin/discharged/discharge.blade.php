@extends('agroindustria::layouts.master')
@section('content')
<div class="discharge">
    <div class="form">
      <div class="form-header">{{trans('agroindustria::menu.Registration of deregistrations')}}</div>
      <div class="form-body">
        {!! Form::open(['method' => 'post', 'url' => route('cefa.agroindustria.admin.discharge.create')]) !!}
        <div class="row">
            <div class="col-md-6">
                {!! Form::hidden('productiveUnitWarehouse', $productiveUnitWarehouse, ['id' => 'productiveUnitWarehouse']) !!}
                {!! Form::hidden('warehouseId', $warehouseId, ['id' => 'warehouseId']) !!}
                {!! Form::label('date', trans('agroindustria::menu.Date Time')) !!}
                {!! Form::datetime('date', now()->format('Y-m-d\TH:i:s'), ['class' => 'form-control', 'readonly' => 'readonly']) !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('inChage', trans('agroindustria::menu.Responsible')) !!}  
                {!! Form::text('inChage', $name, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
            </div>
            <div class="col-md-12">
                {!! Form::label('observation', trans('agroindustria::menu.Observations')) !!}
                {!! Form::textarea('observation', old('observation'), ['class' => 'form-control', 'id' => 'textarea'] ) !!}
                @error('observation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        
        
      </div>
    </div>
  </div>
  <div id="elements">
    <div id="products_discharge">
        <h3>{{trans('agroindustria::menu.Products')}}</h3>
        <!-- Aquí se agregarán los campos de producto dinámicamente -->
        <button type="button" id="add-element">{{trans('agroindustria::menu.Add Product')}}</button> {!! Form::submit(trans('agroindustria::menu.Register deregistration'),['class' => 'baja', 'name' => 'baja']) !!}

        <div class="elements_discharge">
            <div class="form-group">
                {!! Form::label('elementDischarge' , trans('agroindustria::menu.Element')) !!}
                {!! Form::select('element[]', $elements, null, ['id' => 'element_discharge']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('amount' , trans('agroindustria::menu.Amount')) !!}
                {!! Form::number('amount[]', null, ['id' => 'amount']) !!}
            </div>    
            <div class="form-group">  
                {!! Form::label('measurementUnit' , trans('agroindustria::menu.Unit of Measurement')) !!}
                {!! Form::text('measurementUnit[]', null, ['id' => 'measurementUnit', 'readonly' => 'readonly']) !!}
            </div>  
            <div class="form-group">
                {!! Form::label('lote' , trans('agroindustria::menu.Lote')) !!}
                {!! Form::text('lote[]', null, ['id' => 'lote', 'readonly'=> 'readonly']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('fVto' , trans('agroindustria::menu.Expiration Date')) !!}
                {!! Form::text('fVto[]', null, ['id' => 'fVto', 'readonly'=> 'readonly']) !!}
                {!! Form::hidden('price[]', null, ['id' => 'price', 'readonly'=> 'readonly']) !!}
            </div>
                <button type="button" class="remove-element">{{trans('agroindustria::menu.Delete')}}</button>
            </div>
    </div>
    <div class="button_discharge">
      </div>
      {!! Form:: close() !!}
</div>

<h3 id="bajas">{{trans('agroindustria::menu.Deregistrations')}}</h3>
<div class="table_discharge">
    @include('agroindustria::admin.discharged.table')
</div>

@section('script')
@endsection
<script>
    $(document).ready(function() {    
        // Aplicar Select2 al campo de selección con el id 'elementInventory'
        $('#element_discharge').select2();
    
        // Agregar un nuevo campo de producto
        $("#add-element").click(function() {
            var newProduct = '<div class="elements_discharge"><div class="form-group">{!! Form::label("elementDischarge" , trans("agroindustria::menu.Element")) !!} {!! Form::select("element[]", $elements, null, ["id" => "element_discharge", "readonly" => "readonly", "class" => "element-selected"]) !!}</div> <div class="form-group">{!! Form::label("amount" , trans("agroindustria::menu.Amount")) !!} {!! Form::number("amount[]", NULL, ["id" => "amount"]) !!}</div> <div class="form-group">{!! Form::label("measurementUnit" , trans("agroindustria::menu.Unit of Measurement")) !!} {!! Form::text("measurementUnit[]", null, ["id" => "measurementUnit", "readonly" => "readonly"]) !!}</div> <div class="form-group">{!! Form::label("lote" , trans("agroindustria::menu.Lote")) !!} {!! Form::number("lote[]", null, ["id" => "lote", "readonly" => "readonly"]) !!}</div> <div class="form-group">{!! Form::label("fVto" , trans("agroindustria::menu.Expiration Date")) !!} {!! Form::text("fVto[]", null, ["id" => "fVto", "readonly" => "readonly"]) !!}{!! Form::hidden("price[]", null, ["id" => "price", "readonly"=> "readonly"]) !!}</div> <button type="button" class="remove-element">{{trans("agroindustria::menu.Delete")}}</button></div>';
    
            // Agregar el nuevo campo al DOM
            $("#products_discharge").append(newProduct);
    
            // Inicializar Select2 en los campos 'element' en el nuevo campo
            $('.element-selected:last').select2();
    
        });
    
        // Escuchar el evento change en el elemento con ID 'products' (delegado)
        $("#products_discharge, #elements").on("change", "#element_discharge", function() {            
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
                    url: {!! json_encode(route('cefa.agroindustria.admin.discharge.element', ['id' => ':id'])) !!}.replace(':id', elementoSeleccionado.toString()),
                    method: 'GET',
                    success: function(response) {
                        if (Array.isArray(response.id)) {
                            // Si recibes un arreglo de IDs, puedes recorrerlos aquí
                            response.id.forEach(function(value) {
                                var measurementUnit = value.measurementUnit; 
                                var lote = parseFloat(value.lote);  
                                var fVto = new Date(value.fVto);
                                var options = { day: 'numeric', month: 'numeric',  year: 'numeric'};
                                var formattedFVto = fVto.toLocaleDateString(undefined, options);
                                var price = parseFloat(value.price);  

                                measurementUnitField.val(measurementUnit);
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
    
        // Eliminar un campo de producto
        $("#products_discharge").on("click", ".remove-element", function() {
            $(this).parent(".elements_discharge").remove();
        });
    });
</script>
@endsection