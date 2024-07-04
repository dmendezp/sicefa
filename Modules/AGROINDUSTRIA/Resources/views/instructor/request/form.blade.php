@extends('agroindustria::layouts.master')
@section('content')
<div class="movements">
    <div class="form">
      <div class="form-header">Solicitud de Insumos</div>
      <div class="form-body">
        {!! Form::open(['method' => 'post', 'url' => route('agroindustria.instructor.units.request.create')]) !!}
        <div class="row">
          <div class="col-md-6">
            {!! Form::label('fecha', trans('agroindustria::deliveries.Date Time')) !!}
            {!! Form::datetime('date', now()->format('Y-m-d\TH:i:s'), ['class' => 'form-control', 'id' => 'readonly-bg-gray', 'readonly' => 'readonly']) !!}
          </div>
          <div class="col-md-6">
            {!! Form::label('responsible', trans('agroindustria::deliveries.Responsible')) !!}
            {!! Form::select('responsible', $people, null,  ['class' => 'form-control', 'readonly' => 'readonly', 'id' => 'responsible']) !!}
            
          </div>
          <div class="col-md-6">
            {!! Form::label('deliver_warehouse', trans('agroindustria::deliveries.Warehouse that Delivers')) !!}
            {!! Form::select('deliver_warehouse', $warehouseDeliver->pluck('name', 'id'), old('deliver_warehouse'), ['class' => 'form-control', 'id' => 'deliver_warehouse']) !!}
            @error('deliver_warehouse')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="col-md-6">
            {!! Form::label('receive_warehouse', trans('agroindustria::deliveries.Warehouse that Receives')) !!}
            {!! Form::select('receive_warehouse', $warehouseReceive->pluck('name', 'id'), old('receive_warehouse'), ['placeholder' => trans('agroindustria::deliveries.Select a winery'), 'class' => 'form-control', 'id' => 'receive_warehouse']) !!}
            @error('receive_warehouse')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="col-md-12">
            {!! Form::label('observation', trans('agroindustria::deliveries.Observations')) !!}
            {!! Form::textarea('observation', old('observation'), ['class' => 'form-control', 'id' => 'textarea', 'style' => 'height: 0px'] ) !!}
          </div>
          <div class="col-md-12">
            <div id="products">
                <h3>{{trans('agroindustria::deliveries.Products')}}</h3>
                <!-- Aquí se agregarán los campos de producto dinámicamente -->
                <button type="button" class="btn btn-primary" id="add-element"><i class="fa-solid fa-plus"></i> {{trans('agroindustria::deliveries.Add Product')}}</button>
                <div class="elements">
                  <div class="form-group">
                    {!! Form::label('elementInventory' , trans('agroindustria::deliveries.Search Products')) !!}
                    {!! Form::select('element[]', [], null,['class' => 'form-control elementInventory-select']) !!}
                    @if ($errors->has('element'))
                      <span class="text-danger">{{ $errors->first('element') }}</span>
                    @endif
                  </div>  
                  <div class="form-group">
                    {!! Form::label('amount' , trans('agroindustria::deliveries.Amount')) !!}
                    {!! Form::number('amount[]', null, ['class' => 'form-control', 'id' => 'amount']) !!}
                    @error('amount')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>   
                    {!! Form::hidden('available[]', null, ['class' => 'form-control', 'id' => 'available', 'readonly' => 'readonly']) !!}
                    {!! Form::hidden('price[]', null, ['class' => 'form-control', 'id' => 'price', 'readonly'=> 'readonly']) !!}
                    <button type="button" class="remove-element">{{trans('agroindustria::deliveries.Delete')}}</button>
                </div>
            </div>
        </div>
        </div>
        <div class="button">
          {!! Form::submit(trans('agroindustria::deliveries.save'),['class' => 'salida btn btn-success', 'name' => 'salida']) !!}
        </div>
        {!! Form:: close() !!}
      </div>
    </div>
  </div>
  
  @section('script')
  @endsection

  
  <script>
    $(document).ready(function() {
      // Agregar un nuevo campo de producto
      $("#add-element").click(function() {
          var newProduct = '<div class="elements"><div class="form-group">{!! Form::label("elementInventory" , trans("agroindustria::deliveries.Search Products")) !!} {!! Form::select("element[]", [], null,["class" => "form-control"]) !!}</div> <div class="form-group">{!! Form::label("amount" , trans("agroindustria::deliveries.Amount")) !!} {!! Form::number("amount[]", NULL, ["class" => "form-control", "id" => "amount"]) !!}</div>{!! Form::hidden("available[]", null, ["class" => "form-control", "id" => "available", "readonly" => "readonly"]) !!}{!! Form::hidden("price[]", null, ["class" => "form-control", "id" => "price", "readonly" => "readonly"]) !!}<button type="button" class="remove-element">{{trans("agroindustria::deliveries.Delete")}}</button></div>';
  
          // Agregar el nuevo campo al DOM
          $("#products").append(newProduct);
  
          var baseUrl = '{{ route("agroindustria.instructor.units.element.name") }}';
          console.log(baseUrl);
          $('select[name="element[]"]').select2({
            placeholder: 'Seleccione un elemento',
            minimumInputLength: 3,
            ajax: {
                url: baseUrl,
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        element_id: params.term,
                    };
                },
                processResults: function(data) {
                    var results = data.map(function(item) {
                        return {
                            id: item.id,
                            text: item.name
                        };
                    });
                    return {
                        results: results
                    };
                },
                cache: true
            }
          });


          // Manejar la selección de una persona en el campo de búsqueda
          $('#elementInventory-select:last').on('select2:select', function(e) {
              var selectedElement = e.params.data;
              console.log(selectedElement);
              // Actualizar el contenido de la etiqueta con el nombre de la persona seleccionada
              $(this).closest('.elements').find('input#element_id').val(selectedElement.id);
              $(this).closest('.elements').find('input#element_name').val(selectedElement.text);
          });
  
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
                  url: {!! json_encode(route('agroindustria.instructor.units.movements.id', ['id' => ':id'])) !!}.replace(':id', elementoSeleccionado.toString()),
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
  
          var url = {!! json_encode(route('agroindustria.instructor.units.movements.warehouse', ['id' => ':id'])) !!}.replace(':id', selectedReceiver.toString());
  
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
