@extends('agroindustria::layouts.master')
@section('content')
<div class="container-sm">
    <div class="row">
        <div class="col-md-9">
        <div class="form-formulation">
                <div class="form-header">{{trans('agroindustria::formulations.Recipes')}}</div>
                <div class="form-body">
                    @if (Route::is('*formulario*'))
                    {!! Form::open(['url' => route('cefa.agroindustria.units.instructor.formulations.create'),'method' => 'post']) !!}
                    @else
                    {!! Form::open(['url' => route('cefa.agroindustria.units.instructor.formulations.update'),'method' => 'post']) !!}
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            @if (isset($registros))  
                            {!! Form::hidden('id', $registros->id) !!}
                            @endif
                            @if (isset($productiveUnits))
                                {!! Form::hidden('productive_unit_id', $productiveUnits->id) !!}
                            @endif
                            {!! Form::label('person_id', trans('agroindustria::formulations.Owner')) !!}
                            {!! Form::text('person_id', $person, ['class' => 'form-control', 'readonly' => 'readonly']) !!}                        
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('element_id', trans('agroindustria::formulations.Product Name')) !!}
                            {!! Form::select('element_id', $elements, isset($registros) ? $registros->element_id : null, ['id' => 'element_id', 'class' => 'form-control']) !!}
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
                            {!! Form::label('productive_unit', trans('agroindustria::formulations.Productive Unit')) !!}
                            {!! Form::text('productive_unit', $productiveUnits->name, ['class'=>'form-control', 'id' => 'readonly-bg-gray', 'readonly' => 'readonly']) !!}
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
                                <button type="button" id="add-ingredients-formulation">{{trans('agroindustria::menu.Add Product')}}</button>
                                <div class="ingredient">
                                    <div class="form-group">
                                        @if (isset($registros) && $registros)                   
                                            @foreach ($registros->ingredients as $ingredient)
                                                {!! Form::label('elementInventory', trans('agroindustria::menu.Element')) !!}
                                                {!! Form::select('element_ingredients[]', $ingredients, $ingredient->element_id, ['class'=>'form-control', 'id' => 'ingredient']) !!}
                                                @if ($errors->has('element'))
                                                    <span class="text-danger">{{ $errors->first('element') }}</span>
                                                @endif
                                            @endforeach
                                        @else
                                            {!! Form::label('elementInventory', trans('agroindustria::menu.Element')) !!}
                                            {!! Form::select('element_ingredients[]', $ingredients, null, ['class'=>'form-control', 'id' => 'ingredient']) !!}
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        @if (isset($registros) && $registros)
                                            @foreach ($registros->ingredients as $ingredient)
                                                {!! Form::label('amount' , trans('agroindustria::menu.Amount')) !!}
                                                {!! Form::number('amount_ingredients[]', $ingredient->amount, ['class'=>'form-control', 'id' => 'amount']) !!}
                                                @error('amount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            @endforeach
                                        @else
                                            {!! Form::label('amount' , trans('agroindustria::menu.Amount')) !!}
                                            {!! Form::number('amount_ingredients[]', null, ['class'=>'form-control', 'id' => 'amount']) !!}
                                        @endif
                                    </div>  
                                    <button type="button" class="remove-ingredient">{{trans('agroindustria::menu.Delete')}}</button>
                                </div>
                            </div>
                        </div>  
                        <div class="col-md-6">
                            <div id="utencils">
                                <h3>{{trans('agroindustria::formulations.Utencils')}}</h3>
                                <!-- Aquí se agregarán los campos de producto dinámicamente -->
                                <button type="button" id="add-utencils-formulation">{{trans('agroindustria::menu.Add Product')}}</button>
                                <div class="utencil">
                                    <div class="form-group">
                                        @if (isset($registros) && $registros)                   
                                            @foreach ($registros->utensils as $utensil)
                                                {!! Form::label('elementInventory', trans('agroindustria::menu.Element')) !!}
                                                {!! Form::select('element_utencils[]', $utencils, $utensil->element_id, ['class'=>'form-control', 'id' => 'utencil']) !!}
                                                @if ($errors->has('element'))
                                                    <span class="text-danger">{{ $errors->first('element') }}</span>
                                                @endif
                                            @endforeach
                                        @else
                                            {!! Form::label('elementInventory', trans('agroindustria::menu.Element')) !!}
                                            {!! Form::select('element_utencils[]', $utencils, null, ['class'=>'form-control', 'id' => 'utencil']) !!}
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        @if (isset($registros) && $registros)
                                            @foreach ($registros->utensils as $utensil)
                                                {!! Form::label('amount' , trans('agroindustria::menu.Amount')) !!}
                                                {!! Form::number('amount_utencils[]', $utensil->amount, ['class'=>'form-control', 'id' => 'amount']) !!}
                                                @error('amount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            @endforeach
                                        @else
                                            {!! Form::label('amount' , trans('agroindustria::menu.Amount')) !!}
                                            {!! Form::number('amount_utencils[]', null, ['class'=>'form-control', 'id' => 'amount']) !!}
                                        @endif 
                                    </div>    
                                    <button type="button" class="remove-utencils">{{trans('agroindustria::menu.Delete')}}</button>
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
        $('#ingredient').select2();
        
        // Aplicar Select2 al campo de selección con el id 'elementInventory'
        $('#elementInventory').select2();
    
        // Agregar un nuevo campo de producto
        $("#add-ingredients-formulation").click(function() {
            var newProduct = '<div class="ingredient"><div class="form-group">{!! Form::label("elementInventory" , trans("agroindustria::menu.Element")) !!} {!! Form::select("element_ingredients[]", $ingredients, null, ["placeholder" => trans("agroindustria::formulations.Select an ingredient"), "class" => "ingredient-select"]) !!}</div> <div class="form-group">{!! Form::label("amount" , trans("agroindustria::menu.Amount")) !!} {!! Form::number("amount_ingredients[]", NULL, ["class"=>"form-control", "id" => "amount"]) !!}</div> <button type="button" class="remove-ingredient">{{trans("agroindustria::menu.Delete")}}</button></div>';
    
            // Agregar el nuevo campo al DOM
            $("#ingredients").append(newProduct);
    
            // Inicializar Select2 en los campos 'element' en el nuevo campo
            $('.ingredient-select:last').select2();
    
        });
    
        // Eliminar un campo de producto
        $("#ingredients").on("click", ".remove-ingredient", function() {
            $(this).parent(".ingredient").remove();
        });
    });

    $(document).ready(function() {
        // Aplicar Select2 al campo de selección con el id 'receive_warehouse'
    
        // Aplicar Select2 al campo de selección con el id 'elementInventory'
        $('#utencil').select2();
    
        // Agregar un nuevo campo de producto
        $("#add-utencils-formulation").click(function() {
            var newProduct = '<div class="utencil"><div class="form-group">{!! Form::label("elementInventory" , trans("agroindustria::menu.Element")) !!} {!! Form::select("element_utencils[]", $utencils, null, ["placeholder" =>  trans("agroindustria::formulations.Select an instrument"), "class" => "utencil-select"]) !!}</div> <div class="form-group">{!! Form::label("amount" , trans("agroindustria::menu.Amount")) !!} {!! Form::number("amount_utencils[]", NULL, ["class"=>"form-control", "id" => "amount"]) !!}</div> <button type="button" class="remove-utencils">{{trans("agroindustria::menu.Delete")}}</button></div>';
    
            // Agregar el nuevo campo al DOM
            $("#utencils").append(newProduct);
    
            // Inicializar Select2 en los campos 'element' en el nuevo campo
            $('.utencil-select:last').select2();
    
        });
    
        // Eliminar un campo de producto
        $("#utencils").on("click", ".remove-utencils", function() {
            $(this).parent(".utencil").remove();
        });
    });
</script>

@section('script')
@endsection

@endsection