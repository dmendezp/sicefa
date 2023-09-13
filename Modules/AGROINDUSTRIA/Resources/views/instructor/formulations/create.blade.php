@extends('agroindustria::layouts.master')
@section('content')
<div class="container_create">
    <div class="row">
        <div class="col-md-9">
        <div class="form">
                <div class="form-header">Formulaciones</div>
                <div class="form-body">
                    {!! Form::open(['url' => route('cefa.agroindustria.instructor.formulations.create'),'method' => 'post']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('person_id', 'Propietario') !!}
                            {!! Form::text('person_id', $person, ['class' => 'form-control', 'readonly' => 'readonly']) !!}                        
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('element_id', 'Nombre del producto') !!}
                            {!! Form::select('element_id',  $elements, null, ['class'=>'form-control', 'placeholder' => 'Seleccione un producto para preparar']) !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('date', 'Fecha') !!}
                            {!! Form::date('date', now(), ['class'=>'form-control', 'readonly' => 'readonly']) !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('amount', 'Cantidad') !!}
                            {!! Form::number('amount', null, ['class'=>'form-control', 'placeholder' => 'Cantidad que se produce']) !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('productive_unit_id', 'Unidad Productiva') !!}
                            {!! Form::select('productive_unit_id', $productiveUnits, null, ['class'=>'form-control']) !!}
                        </div>
                        <div class="col-md-12">
                            {!! Form::label('proccess', 'Proceso') !!}
                            {!! Form::textarea('proccess', null, ['class'=>'form-control', 'id'=>'textarea']) !!}
                        </div>
                        <div class="col-md-6">
                            <div id="ingredients">
                                <h3>Ingredientes</h3>
                                <!-- Aquí se agregarán los campos de producto dinámicamente -->
                                <button type="button" id="add-ingredients">{{trans('agroindustria::menu.Add Product')}}</button>
                                <div class="ingredient">
                                  <div class="form-group">
                                    {!! Form::label('elementInventory' , trans('agroindustria::menu.Element')) !!}
                                    {!! Form::select('element_ingredients[]', $elements, null, ['id' => 'elementInventory', 'placeholder' => 'Seleccione un ingrediente']) !!}
                                    @if ($errors->has('element'))
                                      <span class="text-danger">{{ $errors->first('element') }}</span>
                                    @endif
                                  </div>
                                  <div class="form-group">
                                    {!! Form::label('amount' , trans('agroindustria::menu.Amount')) !!}
                                    {!! Form::number('amount_ingredients[]', null, ['id' => 'amount']) !!}
                                    @error('amount')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                  </div>    
                                    <button type="button" class="remove-element">{{trans('agroindustria::menu.Delete')}}</button>
                                </div>
                            </div>
                        </div>  
                        <div class="col-md-6">
                            <div id="utencils">
                                <h3>Utencilios</h3>
                                <!-- Aquí se agregarán los campos de producto dinámicamente -->
                                <button type="button" id="add-utencils">{{trans('agroindustria::menu.Add Product')}}</button>
                                <div class="utencil">
                                  <div class="form-group">
                                    {!! Form::label('elementInventory' , trans('agroindustria::menu.Element')) !!}
                                    {!! Form::select('element_utencils[]', $elements, null, ['id' => 'elementInventory', 'placeholder' => 'Seleccione un utencilio']) !!}
                                    @if ($errors->has('element'))
                                      <span class="text-danger">{{ $errors->first('element') }}</span>
                                    @endif
                                  </div>
                                  <div class="form-group">
                                    {!! Form::label('amount' , trans('agroindustria::menu.Amount')) !!}
                                    {!! Form::number('amount_utencils[]', null, ['id' => 'amount']) !!}
                                    @error('amount')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                  </div>    
                                    <button type="button" class="remove-element">{{trans('agroindustria::menu.Delete')}}</button>
                                </div>
                            </div>
                        </div>   
                </div>
            </div>
        </div>
        <div class="button">
            {!! Form::submit('Enviar',['class' => 'enviar','name' => 'enviar']) !!}
        </div>
    {!! Form:: close() !!}     
    </div>
</div>
</div>

<div class="table_formulation">
    @include('agroindustria::instructor.formulations.index')
</div>

@section('script')
@endsection
<script>
    $(document).ready(function() {
        // Aplicar Select2 al campo de selección con el id 'receive_warehouse'
    
        // Aplicar Select2 al campo de selección con el id 'elementInventory'
        $('#elementInventory').select2();
    
        // Agregar un nuevo campo de producto
        $("#add-ingredients").click(function() {
            var newProduct = '<div class="ingredient"><div class="form-group">{!! Form::label("elementInventory" , trans("agroindustria::menu.Element")) !!} {!! Form::select("element_ingredients[]", $elements, null, ["id" => "elementInventory", "placeholder" => "Seleccione un ingrediente", "class" => "element-select"]) !!}</div> <div class="form-group">{!! Form::label("amount" , trans("agroindustria::menu.Amount")) !!} {!! Form::number("amount_ingredients[]", NULL, ["id" => "amount"]) !!}</div> <button type="button" class="remove-element">{{trans("agroindustria::menu.Delete")}}</button></div>';
    
            // Agregar el nuevo campo al DOM
            $("#ingredients").append(newProduct);
    
            // Inicializar Select2 en los campos 'element' en el nuevo campo
            $('.element-select:last').select2();
    
        });
    
        // Eliminar un campo de producto
        $("#ingredients").on("click", ".remove-element", function() {
            $(this).parent(".ingredient").remove();
        });
    });

    $(document).ready(function() {
        // Aplicar Select2 al campo de selección con el id 'receive_warehouse'
    
        // Aplicar Select2 al campo de selección con el id 'elementInventory'
        $('#elementInventory').select2();
    
        // Agregar un nuevo campo de producto
        $("#add-utencils").click(function() {
            var newProduct = '<div class="utencil"><div class="form-group">{!! Form::label("elementInventory" , trans("agroindustria::menu.Element")) !!} {!! Form::select("element_utencils[]", $elements, null, ["id" => "elementInventory", "placeholder" => "Seleccione un ingrediente", "class" => "element-select"]) !!}</div> <div class="form-group">{!! Form::label("amount" , trans("agroindustria::menu.Amount")) !!} {!! Form::number("amount_utencils[]", NULL, ["id" => "amount"]) !!}</div> <button type="button" class="remove-element">{{trans("agroindustria::menu.Delete")}}</button></div>';
    
            // Agregar el nuevo campo al DOM
            $("#utencils").append(newProduct);
    
            // Inicializar Select2 en los campos 'element' en el nuevo campo
            $('.element-select:last').select2();
    
        });
    
        // Eliminar un campo de producto
        $("#utencils").on("click", ".remove-element", function() {
            $(this).parent(".utencil").remove();
        });
    });
</script>
    
@endsection
