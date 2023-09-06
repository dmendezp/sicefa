@extends('agroindustria::layouts.master')
@section('content')

<div class="movements">
  <div class="form">
    <div class="form-header">Salida de Bodega</div>
    <div class="form-body">
      {!! Form::open(['method' => 'post', 'url' => route('cefa.agroindustria.instructor.movements')]) !!}
      <div class="row">
        <div class="col-md-12">
          {!! Form::label('fecha', 'Fecha') !!}
          {!! Form::date('date', now(), ['class' => 'form-control', 'readonly' => 'readonly']) !!}
        </div>
        <div class="col-md-12">
          {!! Form::label('deliver_warehouse', 'Bodega Entrega') !!}
          {!! Form::select('deliver_warehouse', $warehouseDeliver, null, ['class' => 'form-control', 'id' => 'deliver_warehouse']) !!}
        </div>
        <div class="col-md-12">
          {!! Form::label('receive_warehouse', 'Bodega Recibe') !!}
          {!! Form::select('receive_warehouse', $warehouseReceive, null, ['placeholder' => 'Seleccione una bodega', 'class' => 'form-control', 'id' => 'receive_warehouse']) !!}
        </div>
        <div class="col-md-12">
          <div id="products">
              <label for="products" class="form-label">Productos</label>
              <!-- Aquí se agregarán los campos de producto dinámicamente -->
              <button type="button" id="add-product">Agregar Producto</button>
              <div class="elements">
                <div class="form-group">
                  {!! Form::label('elementInventory' , 'Elemento:') !!}
                  {!! Form::select('element[]', $elements, null, [ 'id' => 'elementInventory']) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('amount' , 'Cantidad:') !!}
                  {!! Form::number('amount[]', null, ['id' => 'amount', 'placeholder' => 'Cantidad']) !!}
                </div>    
                <div class="form-group">  
                  {!! Form::label('amountAvailable' , 'Cantidad Disponible:') !!}
                  {!! Form::number('available[]', null, ['id' => 'available', 'placeholder' => 'Cantidad Disponible', 'readonly' => 'readonly']) !!}
                  {!! Form::hidden('price[]', null, ['id' => 'price']) !!}
                </div>  
                  <button type="button" class="remove-product">Eliminar</button>
              </div>
          </div>
      </div>
      </div>
      <div class="button">
        {!! Form::submit('Registrar Salida',['class' => 'salida', 'name' => 'salida']) !!}
      </div>
      {!! Form:: close() !!}
    </div>
  </div>
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
    $("#add-product").click(function() {
        var newProduct = '<div class="elements"><div class="form-group">{!! Form::label("elementInventory" , "Elemento:") !!} {!! Form::select("element[]", $elements, null, ["id" => "elementInventory", "readonly" => "readonly", "class" => "element-select"]) !!}</div> <div class="form-group">{!! Form::label("amount" , "Cantidad:") !!} {!! Form::number("amount[]", NULL, ["placeholder" => "Cantidad"]) !!}</div> <div class="form-group">{!! Form::label("amountAvailable" , "Cantidad Disponible:") !!} {!! Form::number("available[]", null, ["id" => "available", "placeholder" => "Cantidad Disponible", "readonly" => "readonly"]) !!}</div> {!! Form::hidden("price[]", null, ["id" => "price"]) !!}<button class="remove-product">Eliminar</button></div>';

        // Agregar el nuevo campo al DOM
        $("#products").append(newProduct);

        // Inicializar Select2 en los campos 'element' en el nuevo campo
        $('.element-select:last').select2();

        // Inicializar Select2 en los campos 'measurement_unit' en el nuevo campo
        $('.measurement-unit-select:last').select2();
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
    $("#products").on("click", ".remove-product", function() {
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

    
