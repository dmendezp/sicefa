@extends('agroindustria::layouts.master')
@section('content')

<div class="movements">
  <div class="form">
    <div class="form-header">{{trans('agroindustria::menu.Exit from Cellar')}}</div>
    <div class="form-body">
      {!! Form::open(['method' => 'post', 'url' => route('cefa.agroindustria.instructor.movements.out')]) !!}
      <div class="row">
        <div class="col-md-6">
          {!! Form::hidden('productiveUnitWarehouse', $productiveUnitWarehouse, ['id' => 'productiveUnitWarehouse']) !!}
          {!! Form::label('fecha', trans('agroindustria::menu.Date')) !!}
          {!! Form::date('date', now(), ['class' => 'form-control', 'readonly' => 'readonly']) !!}
        </div>
        <div class="col-md-6">
          {!! Form::label('receive', trans('agroindustria::menu.Receiver')) !!}
          {!! Form::select('receive', $receive, old('receive'), ['class' => 'form-control']) !!}
        </div>
        <div class="col-md-6">
          {!! Form::label('deliver_warehouse', trans('agroindustria::menu.Warehouse that Delivers')) !!}
          {!! Form::select('deliver_warehouse', $warehouseDeliver, old('deliver_warehouse'), ['class' => 'form-control', 'id' => 'deliver_warehouse']) !!}
          @error('deliver_warehouse')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="col-md-6">
          {!! Form::label('receive_warehouse', trans('agroindustria::menu.Warehouse that Receives')) !!}
          {!! Form::select('receive_warehouse', $warehouseReceive, old('receive_warehouse'), ['placeholder' => trans('agroindustria::menu.Select a winery'), 'class' => 'form-control', 'id' => 'receive_warehouse']) !!}
          @error('receive_warehouse')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="col-md-12">
          {!! Form::label('observation', trans('agroindustria::menu.Observations')) !!}
          {!! Form::textarea('observation', old('observation'), ['class' => 'form-control', 'id' => 'textarea'] ) !!}
        </div>
        <div class="col-md-12">
          <div id="products">
              <h3>{{trans('agroindustria::menu.Products')}}</h3>
              <!-- Aquí se agregarán los campos de producto dinámicamente -->
              <button type="button" id="add-element">{{trans('agroindustria::menu.Add Product')}}</button>
              <div class="elements">
                <div class="form-group">
                  {!! Form::label('elementInventory' , trans('agroindustria::menu.Element')) !!}
                  {!! Form::select('element[]', $elements, null, [ 'id' => 'elementInventory']) !!}
                  @if ($errors->has('element'))
                    <span class="text-danger">{{ $errors->first('element') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  {!! Form::label('amount' , trans('agroindustria::menu.Amount')) !!}
                  {!! Form::number('amount[]', null, ['id' => 'amount']) !!}
                  @error('amount')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>    
                <div class="form-group">  
                  {!! Form::label('amountAvailable' , trans('agroindustria::menu.Quantity Available')) !!}
                  {!! Form::number('available[]', null, ['id' => 'available', 'readonly' => 'readonly']) !!}
                </div>  
                <div class="form-group">
                  {!! Form::label('price' , trans('agroindustria::menu.Price')) !!}
                  {!! Form::number('price[]', null, ['id' => 'price', 'readonly'=> 'readonly']) !!}
                </div>
                  <button type="button" class="remove-element">{{trans('agroindustria::menu.Delete')}}</button>
              </div>
          </div>
      </div>
      </div>
      <div class="button">
        {!! Form::submit(trans('agroindustria::menu.Check Out'),['class' => 'salida', 'name' => 'salida']) !!}
      </div>
      {!! Form:: close() !!}
    </div>
  </div>
</div>

<h3 id="movimientos">Movimientos</h3>
<div class="table-deliveries">
  @include('agroindustria::instructor.movements.table')
</div>

@section('script')
@endsection


<script>
$(document).ready(function() {
    // Aplicar Select2 al campo de selección con el id 'receive_warehouse'
    $('#receive_warehouse').select2();

    // Aplicar Select2 al campo de selección con el id 'elementInventory'
    $('#elementInventory').select2();

    // Agregar un nuevo campo de producto
    $("#add-element").click(function() {
        var newProduct = '<div class="elements"><div class="form-group">{!! Form::label("elementInventory" , trans("agroindustria::menu.Element")) !!} {!! Form::select("element[]", $elements, null, ["id" => "elementInventory", "readonly" => "readonly", "class" => "element-select"]) !!}</div> <div class="form-group">{!! Form::label("amount" , trans("agroindustria::menu.Amount")) !!} {!! Form::number("amount[]", NULL, ["id" => "amount"]) !!}</div> <div class="form-group">{!! Form::label("amountAvailable" , trans("agroindustria::menu.Quantity Available")) !!} {!! Form::number("available[]", null, ["id" => "available", "readonly" => "readonly"]) !!}</div> <div class="form-group">{!! Form::label("price" , trans("agroindustria::menu.Price")) !!} {!! Form::number("price[]", null, ["id" => "price", "readonly" => "readonly"]) !!}</div> <button type="button" class="remove-element">{{trans("agroindustria::menu.Delete")}}</button></div>';

        // Agregar el nuevo campo al DOM
        $("#products").append(newProduct);

        // Inicializar Select2 en los campos 'element' en el nuevo campo
        $('.element-select:last').select2();

    });

    // Escuchar el evento change en el elemento con ID 'products' (delegado)
    $("#products").on("change", ".element-select", function() {
        var elementoSeleccionado = $(this).val();
        var parentElement = $(this).closest('.elements');
        var availableField = parentElement.find('input#available');
        var priceField = parentElement.find('input#price');

        // Realizar una petición AJAX para obtener la cantidad disponible
        if (elementoSeleccionado) {
            $.ajax({
                url: {!! json_encode(route('cefa.agroindustria.instructor.movements.id', ['id' => ':id'])) !!}.replace(':id', elementoSeleccionado.toString()),
                method: 'GET',
                success: function(response) {
                    if (Array.isArray(response.id)) {
                        // Si recibes un arreglo de IDs, puedes recorrerlos aquí
                        response.id.forEach(function(value) {
                            var amount = parseFloat(value.amount); // Acceder al amount
                            var price = parseFloat(value.price);   // Acceder al price
                            
                            priceField.val(price);
                            availableField.val(amount);
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
            availableField.val('');
        }
    });

    // Eliminar un campo de producto
    $("#products").on("click", ".remove-element", function() {
        $(this).parent(".elements").remove();
    });
});
</script>

<script>
$(document).ready(function() {
    $('#inventoryForm').submit(function(event) {
        // Evita que el formulario se envíe automáticamente
        event.preventDefault();

        // Obtén la cantidad ingresada
        var cantidadIngresada = parseInt($('#amount').val());

        // Obtén la cantidad disponible desde la respuesta JSON (suponiendo que la respuesta es un objeto JSON con un campo 'id' que contiene la cantidad disponible)
        var cantidadDisponible = parseInt($('#disponible').val());

        // Realiza la validación
        if (isNaN(cantidadIngresada)) {
            alert('Por favor, ingresa una cantidad válida.');
        } else if (cantidadIngresada <= 0) {
            alert('La cantidad debe ser mayor que cero.');
        } else if (cantidadIngresada > cantidadDisponible) {
            alert('La cantidad ingresada es mayor que la cantidad disponible en el inventario.');
        } else {
            // Si la validación es exitosa, puedes enviar el formulario
            this.submit();
        }
    });
});

</script>
@endsection

    
