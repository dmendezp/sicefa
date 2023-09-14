@extends('agroindustria::layouts.master')
@section('content')
<div class="container_create">
    <div class="row">
        <div class="col-md-9">
        <div class="form">
                <div class="form-header">{{trans('agroindustria::formulations.Recipes')}}</div>
                <div class="form-body">
                    @if (Route::is('*formulario*'))
                    {!! Form::open(['url' => route('cefa.agroindustria.instructor.formulations.create'),'method' => 'post']) !!}
                    @else
                    {!! Form::open(['url' => route('cefa.agroindustria.instructor.formulations.update'),'method' => 'post']) !!}
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            @if (isset($registros))  
                            {!! Form::hidden('id', $registros->id) !!}
                            @endif
                            {!! Form::label('person_id', trans('agroindustria::formulations.Owner')) !!}
                            {!! Form::text('person_id', $person, ['class' => 'form-control', 'readonly' => 'readonly']) !!}                        
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('element_id', trans('agroindustria::formulations.Product Name')) !!}
                            {!! Form::select('element_id', $elements, isset($registros) ? $registros->element_id : null, ['id' => 'element_id', 'class' => 'form-control', 'placeholder' => trans('agroindustria::formulations.Select a product to prepare')]) !!}
                            @error('element_id')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('date', trans('agroindustria::formulations.Date')) !!}
                            {!! Form::date('date', isset($registros) ? $registros->date : now(), ['class'=>'form-control', 'readonly' => 'readonly']) !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('amount', trans('agroindustria::formulations.Amount')) !!}
                            {!! Form::number('amount', isset($registros) ? $registros->amount : null, ['id' => 'amount', 'class'=>'form-control', 'placeholder' => trans('agroindustria::formulations.Quantity produced')]) !!}
                            @error('amount')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('productive_unit_id', trans('agroindustria::formulations.Productive Unit')) !!}
                            {!! Form::select('productive_unit_id', $productiveUnits, isset($registros) ? $registros->productive_unit_id : null, ['class'=>'form-control']) !!}
                            @error('productive_unit_id')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            {!! Form::label('proccess', trans('agroindustria::formulations.Process')) !!}
                            {!! Form::textarea('proccess', isset($registros) ? $registros->proccess : null, ['class'=>'form-control', 'id'=>'proccess']) !!}
                            @error('proccess')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div id="ingredients">
                                <h3>{{trans('agroindustria::formulations.Ingredients')}}</h3>
                                <!-- Aquí se agregarán los campos de producto dinámicamente -->
                                <button type="button" id="add-ingredients">{{trans('agroindustria::menu.Add Product')}}</button>
                                <div class="ingredient">
                                    <div class="form-group">
                                        @if ($registros)                   
                                            @foreach ($registros->ingredients as $ingredient)
                                                {!! Form::label('elementInventory', trans('agroindustria::menu.Element')) !!}
                                                {!! Form::select('element_ingredients[]', $elements, $ingredient->element_id, ['id' => 'elementInventory_' . $ingredient->id, 'placeholder' => trans('agroindustria::formulations.Select an ingredient')]) !!}
                                                @if ($errors->has('element'))
                                                    <span class="text-danger">{{ $errors->first('element') }}</span>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="form-group">
                                            @foreach ($registros->ingredients as $ingredient)
                                                {!! Form::label('amount' , trans('agroindustria::menu.Amount')) !!}
                                                {!! Form::number('amount_ingredients[]', $ingredient->amount, ['id' => 'amount']) !!}
                                                @error('amount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            @endforeach
                                        @endif
                                  </div>    
                                    <button type="button" class="remove-element">{{trans('agroindustria::menu.Delete')}}</button>
                                </div>
                            </div>
                        </div>  
                        <div class="col-md-6">
                            <div id="utencils">
                                <h3>{{trans('agroindustria::formulations.Utencils')}}</h3>
                                <!-- Aquí se agregarán los campos de producto dinámicamente -->
                                <button type="button" id="add-utencils">{{trans('agroindustria::menu.Add Product')}}</button>
                                <div class="utencil">
                                  <div class="form-group">
                                    @if ($registros)        
                                        @foreach ($registros->utensils as $utensil)
                                        {!! Form::label('elementInventory' , trans('agroindustria::menu.Element')) !!}
                                        {!! Form::select('element_utencils[]', $elements, $utensil->element_id, ['id' => 'elementInventory', 'placeholder' => trans('agroindustria::formulations.Select an instrument')]) !!}
                                        @if ($errors->has('element'))
                                        <span class="text-danger">{{ $errors->first('element') }}</span>
                                        @endif
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        @foreach ($registros->utensils as $utensil)
                                        {!! Form::label('amount' , trans('agroindustria::menu.Amount')) !!}
                                        {!! Form::number('amount_utencils[]', $utensil->amount, ['id' => 'amount']) !!}
                                        @error('amount')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        @endforeach
                                    @endif
                                  </div>    
                                    <button type="button" class="remove-element">{{trans('agroindustria::menu.Delete')}}</button>
                                </div>
                            </div>
                        </div>   
                        <div class="button_receipe">{!! Form::submit(trans('agroindustria::formulations.Save'),['class' => 'save_receipe', 'name' => 'enviar']) !!}</div>
                </div>
            </div>
        </div>
    {!! Form:: close() !!}     
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        // Aplicar Select2 al campo de selección con el id 'receive_warehouse'
    
        // Aplicar Select2 al campo de selección con el id 'elementInventory'
        $('#elementInventory').select2();
    
        // Agregar un nuevo campo de producto
        $("#add-ingredients").click(function() {
            var newProduct = '<div class="ingredient"><div class="form-group">{!! Form::label("elementInventory" , trans("agroindustria::menu.Element")) !!} {!! Form::select("element_ingredients[]", $elements, null, ["id" => "elementInventory", "placeholder" => trans("agroindustria::formulations.Select an ingredient"), "class" => "element-select"]) !!}</div> <div class="form-group">{!! Form::label("amount" , trans("agroindustria::menu.Amount")) !!} {!! Form::number("amount_ingredients[]", NULL, ["id" => "amount"]) !!}</div> <button type="button" class="remove-element">{{trans("agroindustria::menu.Delete")}}</button></div>';
    
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
            var newProduct = '<div class="utencil"><div class="form-group">{!! Form::label("elementInventory" , trans("agroindustria::menu.Element")) !!} {!! Form::select("element_utencils[]", $elements, null, ["id" => "elementInventory", "placeholder" =>  trans("agroindustria::formulations.Select an instrument"), "class" => "element-select"]) !!}</div> <div class="form-group">{!! Form::label("amount" , trans("agroindustria::menu.Amount")) !!} {!! Form::number("amount_utencils[]", NULL, ["id" => "amount"]) !!}</div> <button type="button" class="remove-element">{{trans("agroindustria::menu.Delete")}}</button></div>';
    
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

<script>
    
</script>
@section('script')
@endsection

@endsection