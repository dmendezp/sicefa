@extends('agroindustria::layouts.master')
@section('content')

<div class="movements">
  <div class="form">
    <div class="form-header">{{trans('agroindustria::menu.Exit from Cellar')}} <a id="pedingMovements" href="{{route('cefa.agroindustria.units.instructor.movements.pending')}}">{{trans(('agroindustria::menu.Pending'))}}  ({{ $pedingMovements }})</a></div>
    <div class="form-body">
      {!! Form::open(['method' => 'post', 'url' => route('cefa.agroindustria.units.instructor.movements.out')]) !!}
      <div class="row">
        <div class="col-md-6">
          {!! Form::hidden('productiveUnitWarehouse', $productiveUnitWarehouse, ['id' => 'productiveUnitWarehouse']) !!}
          {!! Form::label('fecha', trans('agroindustria::menu.Date Time')) !!}
          {!! Form::datetime('date', now()->format('Y-m-d\TH:i:s'), ['class' => 'form-control', 'id' => 'readonly-bg-gray', 'readonly' => 'readonly']) !!}
        </div>
        <div class="col-md-6">
          {!! Form::label('receive', trans('agroindustria::menu.Receiver')) !!}
          {!! Form::text('receive', null,  ['class' => 'form-control', 'readonly' => 'readonly', 'id' => 'receivePerson']) !!}
          {!! Form::hidden('receive_id', null, ['id' => 'receive']) !!}
          @error('receive')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="col-md-6">
          {!! Form::label('productive_unit', 'Unidad Productiva que entrega') !!}
          {!! Form::text('productive_unit', $unitName->name, ['class' => 'form-control', 'id' => 'readonly-bg-gray', 'readonly' => 'readonly']) !!}
        </div>
        <div class="col-md-6" id="receiveUnit">
          {!! Form::label('receiveUnit', 'Unidad productiva que recibe') !!}
          {!! Form::select('receiveUnit', $receiveUnit, old('receiveUnit'), ['class' => 'form-control', 'id' => 'receiveUnit-selected']) !!}
          @error('receiveUnit')
          <span class="text-danger">{{ $message }}</span>
          @enderror
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
          {!! Form::select('receive_warehouse', [], old('receive_warehouse'), ['placeholder' => trans('agroindustria::menu.Select a winery'), 'class' => 'form-control', 'id' => 'receive_warehouse']) !!}
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
                  {!! Form::select('element[]', $elements, null, ['class' => 'form-control', 'id' => 'elementInventory']) !!}
                  @if ($errors->has('element'))
                    <span class="text-danger">{{ $errors->first('element') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  {!! Form::label('amount' , trans('agroindustria::menu.Amount')) !!}
                  {!! Form::number('amount[]', null, ['class' => 'form-control', 'id' => 'amount']) !!}
                  @error('amount')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>    
                <div class="form-group">  
                  {!! Form::label('amountAvailable' , trans('agroindustria::menu.Quantity Available')) !!}
                  {!! Form::number('available[]', null, ['class' => 'form-control', 'id' => 'available', 'readonly' => 'readonly']) !!}
                </div>  
                <div class="form-group">
                  {!! Form::label('price' , trans('agroindustria::menu.Price')) !!}
                  {!! Form::number('price[]', null, ['class' => 'form-control', 'id' => 'price', 'readonly'=> 'readonly']) !!}
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

<h3 id="movimientos">{{trans('agroindustria::menu.Movements')}}</h3>
<div class="table-deliveries">
  @include('agroindustria::instructor.movements.table')
</div>

@section('script')
@endsection


<script>
  // Aplicar Select2 al campo de selección con el id 'elementInventory'
  $(document).ready(function() {
    $('#elementInventory').select2();
  });

  $(document).ready(function() {
    // Agregar un nuevo campo de producto
    $("#add-element").click(function() {
        var newProduct = '<div class="elements"><div class="form-group">{!! Form::label("elementInventory" , trans("agroindustria::menu.Element")) !!} {!! Form::select("element[]", $elements, null, ["readonly" => "readonly", "class" => "elementInventory-select"]) !!}</div> <div class="form-group">{!! Form::label("amount" , trans("agroindustria::menu.Amount")) !!} {!! Form::number("amount[]", NULL, ["class" => "form-control", "id" => "amount"]) !!}</div> <div class="form-group">{!! Form::label("amountAvailable" , trans("agroindustria::menu.Quantity Available")) !!} {!! Form::number("available[]", null, ["class" => "form-control", "id" => "available", "readonly" => "readonly"]) !!}</div> <div class="form-group">{!! Form::label("price" , trans("agroindustria::menu.Price")) !!} {!! Form::number("price[]", null, ["class" => "form-control", "id" => "price", "readonly" => "readonly"]) !!}</div> <button type="button" class="remove-element">{{trans("agroindustria::menu.Delete")}}</button></div>';

        // Agregar el nuevo campo al DOM
        $("#products").append(newProduct);

        // Inicializar Select2 en los campos 'element' en el nuevo campo
        $('.elementInventory-select:last').select2();

    });

    // Eliminar un campo de producto
    $("#products").on("click", ".remove-element", function() {
        $(this).parent(".elements").remove();
    });

    // Escuchar el evento change en el elemento con ID 'products' (delegado)
    $("#products").on("change", ".elementInventory-select", function() {
        var elementoSeleccionado = $(this).val();
        var parentElement = $(this).closest('.elements');
        var availableField = parentElement.find('input#available');
        var priceField = parentElement.find('input#price');

        // Realizar una petición AJAX para obtener la cantidad disponible
        if (elementoSeleccionado) {
            $.ajax({
                url: {!! json_encode(route('cefa.agroindustria.units.instructor.movements.id', ['id' => ':id'])) !!}.replace(':id', elementoSeleccionado.toString()),
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
            priceField.val('');
        }
    });

    
});
</script>

<script>
$(document).ready(function() {
    // Detecta cambios en el primer campo de selección (Receiver)
    $('#receiveUnit-selected').on('change', function() {
        var selectedReceiver = $(this).val();

        var url = {!! json_encode(route('cefa.agroindustria.units.instructor.movements.warehouse', ['id' => ':id'])) !!}.replace(':id', selectedReceiver.toString());

        // Realiza una solicitud AJAX para obtener los almacenes que recibe el receptor seleccionado
        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                var options = '<option value="">' + '{{ trans("agroindustria::menu.Select a winery") }}' + '</option>';
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