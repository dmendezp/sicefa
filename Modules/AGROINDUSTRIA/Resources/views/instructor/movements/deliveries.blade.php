@extends('agroindustria::layouts.master')
@section('content')

<div class="movements">
  <div class="form">
    <div class="form-header">{{trans('agroindustria::deliveries.Exit from Cellar')}}</div>
    <div class="form-body">
      {!! Form::open(['method' => 'post', 'url' => route('agroindustria.'.getRoleRouteName(Route::currentRouteName()).'.units.movements.out')]) !!}
      <div class="row">
        <div class="col-md-6">
          {!! Form::label('productive_unit', trans('agroindustria::deliveries.Productive Unit delivering')) !!}
          {!! Form::text('productive_unit', $unitName->name, ['class' => 'form-control', 'id' => 'readonly-bg-gray', 'readonly' => 'readonly']) !!}
        </div>
        <div class="col-md-6" id="receiveUnit">
          {!! Form::label('receiveUnit', trans('agroindustria::deliveries.Productive unit receiving')) !!}
          {!! Form::select('receiveUnit', $receiveUnit, old('receiveUnit'), ['class' => 'form-control', 'id' => 'receiveUnit-selected']) !!}
          @error('receiveUnit')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="col-md-6">
          {!! Form::label('deliver_warehouse', trans('agroindustria::deliveries.Warehouse that Delivers')) !!}
          {!! Form::select('deliver_warehouse', $warehouseDeliver, old('deliver_warehouse'), ['class' => 'form-control', 'id' => 'deliver_warehouse']) !!}
          @error('deliver_warehouse')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="col-md-6">
          {!! Form::label('receive_warehouse', trans('agroindustria::deliveries.Warehouse that Receives')) !!}
          {!! Form::select('receive_warehouse', [], old('receive_warehouse'), ['placeholder' => trans('agroindustria::deliveries.Select a winery'), 'class' => 'form-control', 'id' => 'receive_warehouse']) !!}
          @error('receive_warehouse')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="col-md-6">
          {!! Form::hidden('productiveUnitWarehouse', $productiveUnitWarehouse, ['id' => 'productiveUnitWarehouse']) !!}
          {!! Form::label('fecha', trans('agroindustria::deliveries.Date Time')) !!}
          {!! Form::datetime('date', now()->format('Y-m-d\TH:i:s'), ['class' => 'form-control', 'id' => 'readonly-bg-gray', 'readonly' => 'readonly']) !!}
        </div>
        
        <div class="col-md-6">
          {!! Form::label('receive', trans('agroindustria::deliveries.Receiver')) !!}
          {!! Form::text('receive', null,  ['class' => 'form-control', 'readonly' => 'readonly', 'id' => 'receivePerson']) !!}
          {!! Form::hidden('receive_id', null, ['id' => 'receive']) !!}
          @error('receive')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="col-md-6">
          {!! Form::label('observation', trans('agroindustria::deliveries.Observations')) !!}
          {!! Form::textarea('observation', old('observation'), ['class' => 'form-control', 'id' => 'textarea', 'style' => 'height: 0px'] ) !!}
        </div>
        <div class="col-md-6" id="total-movement">
          {!! Form::label('total_movement', 'Total') !!}
          {!! Form::number('total_movement', null, ['class' => 'form-control', 'id' => 'total_movement', 'readonly' => 'readonly']) !!}
        </div>
        <div class="col-md-12">
          <div id="products">
              <h3>{{trans('agroindustria::deliveries.Products')}}</h3>
              <!-- Aquí se agregarán los campos de producto dinámicamente -->
              <button type="button" class="btn btn-primary" id="add-element"><i class="fa-solid fa-plus"></i> {{trans('agroindustria::deliveries.Add Product')}}</button>
              <div class="elements">
                <div class="form-group">
                  {!! Form::label('elementInventory' , trans('agroindustria::deliveries.Element')) !!}
                  {!! Form::select('element[]', $elements, null, ['class' => 'form-control elementInventory']) !!}
                  @if ($errors->has('element'))
                    <span class="text-danger">{{ $errors->first('element') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <span class="quantity"></span>
                  {!! Form::label('amount' , trans('agroindustria::deliveries.Amount')) !!}
                  {!! Form::number('amount[]', null, ['class' => 'form-control', 'id' => 'amount', 'step' => '0.01']) !!}
                  @error('amount')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  {!! Form::label('price' , trans('agroindustria::deliveries.Price')) !!}
                  {!! Form::number('price[]', null, ['class' => 'form-control', 'id' => 'price', 'readonly'=> 'readonly']) !!}
                </div>
                <div class="form-group-equipments">  
                  {!! Form::label('subtotal', 'Total') !!}
                  {!! Form::number('subtotal', null, ['class'=>'form-control', 'id' => 'subtotal', 'readonly' => 'readonly']) !!}
                </div>
                  <button type="button" class="remove-element">{{trans('agroindustria::deliveries.Delete')}}</button>
              </div>
          </div>
      </div>
      </div>
      <div class="button">
        {!! Form::submit(trans('agroindustria::deliveries.Check Out'),['class' => 'salida btn btn-success', 'name' => 'salida']) !!}
      </div>
      {!! Form:: close() !!}
    </div>
  </div>
</div>

@section('script')
@endsection


<script>
  // Aplicar Select2 al campo de selección con el id 'elementInventory'
  $(document).ready(function() {
    $('.elementInventory').select2();
  });

  $(document).ready(function() {
    // Agregar un nuevo campo de producto
    $("#add-element").click(function() {
        var newProduct = '<div class="elements"><div class="form-group">{!! Form::label("elementInventory" , trans("agroindustria::deliveries.Element")) !!} {!! Form::select("element[]", $elements, null, ["readonly" => "readonly", "class" => "elementInventory", "style" => "width:200px"]) !!}</div> <div class="form-group"><span class="quantity"></span>{!! Form::label("amount" , trans("agroindustria::deliveries.Amount")) !!} {!! Form::number("amount[]", NULL, ["class" => "form-control", "id" => "amount", "step" => "0.01"]) !!}</div>  <div class="form-group">{!! Form::label("price" , trans("agroindustria::deliveries.Price")) !!} {!! Form::number("price[]", null, ["class" => "form-control", "id" => "price", "readonly" => "readonly"]) !!}</div><div class="form-group-equipments">{!! Form::label("subtotal", "Total") !!}{!! Form::number("subtotal", null, ["class"=>"form-control", "id" => "subtotal", "readonly" => "readonly"]) !!}</div> <button type="button" class="remove-element">{{trans("agroindustria::deliveries.Delete")}}</button></div>';

        // Agregar el nuevo campo al DOM
        $("#products").append(newProduct);

        // Inicializar Select2 en los campos 'element' en el nuevo campo
        $('.elementInventory:last').select2();

    });

    // Eliminar un campo de producto
    $("#products").on("click", ".remove-element", function() {
        $(this).parent(".elements").remove();
    });

   
    // Escuchar el evento change en el elemento con ID 'products' (delegado)
    var isAnyProductExceeding = false;
    $("#products").on("change", ".elementInventory", function() {
        var elementoSeleccionado = $(this).val();
        var parentElement = $(this).closest('.elements');
        var availableField = parentElement.find('.quantity');
        var priceField = parentElement.find('input#price');

        // Realizar una petición AJAX para obtener la cantidad disponible
        if (elementoSeleccionado) {
          var url = {!! json_encode(route('agroindustria.'.getRoleRouteName(Route::currentRouteName()).'.units.movements.id', ['id' => ':id'])) !!}.replace(':id', elementoSeleccionado.toString());
          console.log(url);
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    if (Array.isArray(response.id)) {
                        // Si recibes un arreglo de IDs, puedes recorrerlos aquí
                        response.id.forEach(function(value) {
                            var price = parseFloat(value.price);   // Acceder al price
                            priceField.val(price);
                            maxQuantity = parseFloat(value.amount); // Acceder al amount

                            updateSaveButtonState(availableField, 0, maxQuantity);

                            $('#products').off('input', 'input#amount').on('input', 'input#amount', function() {
                                var amountInput = $(this);
                                var amount = amountInput.val();
                                updateSaveButtonState(availableField, amount, maxQuantity)

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
            availableField.text('');
            priceField.val('');
        }
    }); 
    
    function updateSaveButtonState(availableField, amount, maxQuantity) {
            var saveButton = $('.salida');
            console.log(maxQuantity);

            if (amount > maxQuantity) {
              availableField.text('{{trans("agroindustria::deliveries.amountEnteredGreater")}}').css('color', 'red');
                saveButton.prop('disabled', true);
                saveButton.addClass('disabled-button');
                isAnyProductExceeding = true;
                console.log('Deshabilitado');
            } else {
              availableField.text('{{trans("agroindustria::deliveries.quantityAvailable")}}: ' + maxQuantity).css('color', '#666');
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

});
</script>

<script>
  $(document).ready(function() {
      // Escuchar el evento change en el campo 'cantidad'
      $("#products").on("input", "#amount", function() {
        updateTotalPrice();
        updateTotalMovement();
      });

      function updateTotalPrice() {
            var totalPrice = 0;
            $('.elements').each(function() {
                var priceField = $(this).find('input#price');
                var price = parseInt(priceField.val()) || 0;
                var amountField = $(this).find('input#amount');
                var amount = parseInt(amountField.val()) || 0;
                var totalField = $(this).find('input#subtotal');
                var totalPrice = price * amount;
                totalField.val(totalPrice);
            });
        }
      function updateTotalMovement() {
            var totalPriceEquipments = 0;

            $('#products .elements').each(function() {
                var totalField = $(this).find('input#subtotal');
                var totalPrice = parseInt(totalField.val()) || 0;
                totalPriceEquipments += totalPrice;
            });

            var total = totalPriceEquipments;

            $('input[name="total_movement"]').val(total);
        }
  
      // Función para actualizar la suma total
  });
  </script>
  
  
<script>
$(document).ready(function() {
    // Detecta cambios en el primer campo de selección (Receiver)
    $('#receiveUnit-selected').on('change', function() {
        var selectedReceiver = $(this).val();

        var url = {!! json_encode(route('agroindustria.'.getRoleRouteName(Route::currentRouteName()).'.units.movements.warehouse', ['id' => ':id'])) !!}.replace(':id', selectedReceiver.toString());

        // Realiza una solicitud AJAX para obtener los almacenes que recibe el receptor seleccionado
        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                var options = '<option value="">' + '{{ trans("agroindustria::deliveries.Select a winery") }}' + '</option>';
                $.each(response.id, function(index, warehouse) {
                    options += '<option value="' + warehouse.id + '">' + warehouse.name + '</option>';
                });
                var personId = response.id[0].idPerson;
                var personName = response.id[0].personName;

                // Actualiza las opciones del segundo campo de selección (Warehouse that Receives)
                $('#receive_warehouse').html(options);
                $('#receivePerson').val(personName);
                $('#receive').val(personId);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
});

</script>
@endsection