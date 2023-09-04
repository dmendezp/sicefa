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
                  {!! Form::number('code_sena[]', null, ['placeholder' => 'Código SENA']) !!}
                  {!! Form::select('product_name[]', ['m' => 'Microscopio'], null, ['readonly' => 'readonly', 'id' => 'element']) !!}
                  {!! Form::number('amount[]', null, ['placeholder' => 'Cantidad']) !!}
                  {!! Form::text('observations[]', null, ['placeholder' => 'Observaciones']) !!}
                  <button class="remove-product">Eliminar</button>
              </div>
              
          </div>
      </div>
      </div>
      {!! Form:: close() !!}
    </div>
  </div>
</div>


@endsection
    
