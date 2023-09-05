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
              <div class="product">
                  {!! Form::select('element[]', $elements, null, [ 'id' => 'element']) !!}
                  {!! Form::number('amount[]', null, ['placeholder' => 'Cantidad']) !!}
                  <button class="remove-product">Eliminar</button>
              </div>
              
          </div>
      </div>
      </div>
      {!! Form:: close() !!}
    </div>
  </div>
</div>

@section('script')
@endsection

<script>
  $(document).ready(function() {
      // Aplicar Select2 al campo de selección con el id 'course'
      $('#receive_warehouse').select2();
  });

  $(document).ready(function() {
      // Aplicar Select2 al campo de selección con el id 'course'
      $('#element').select2();
  });

  $(document).ready(function() {
      // Agregar un nuevo campo de producto
      $("#add-product").click(function() {
              var newProduct = '<div class="product">{!! Form::select("element[]", $elements, null, ["readonly" => "readonly", "class" => "element-select"]) !!} {!! Form::number("amount[]", NULL, ["placeholder" => "Cantidad"]) !!}<button class="remove-product">Eliminar</button></div>';

          // Agregar el nuevo campo al DOM
          $("#products").append(newProduct);

          // Inicializar Select2 en los campos 'element' en el nuevo campo
          $('.element-select:last').select2();

          // Inicializar Select2 en los campos 'measurement_unit' en el nuevo campo
          $('.measurement-unit-select:last').select2();
      });

      // Eliminar un campo de producto
      $("#products").on("click", ".remove-product", function() {
          $(this).parent(".product").remove();
      });
  });
</script>
@endsection

    
