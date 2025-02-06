@if (isset($element))
    {!! Form::hidden('id', $element->id) !!}
@endif
<div class="row">
    <div class="col-md-4">
        {!! Form::label('name', 'Nombre:', ['class' => 'mt-3']) !!}
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="far fa-keyboard"></i>
                </span>
            </div>
            {!! Form::text('name', isset($element) ? $element->name : null, [
                'class' => 'form-control',
                'required',
                'placeholder' => 'Nombre',
            ]) !!}
        </div>

        {!! Form::label('measurement_unit', 'Medida:', ['class' => 'mt-3']) !!}
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="far fa-list"></i>
                </span>
            </div>
            {!! Form::select(
                'measurement_unit_id',
                $measurement_units,
                isset($element) ? $element->measurement_unit_id : null,
                [
                    'placeholder' => '-- Seleccione --',
                    'class' => 'form-control',
                    'required',
                ],
            ) !!}
        </div>

        {!! Form::label('description', 'Descripción:', ['class' => 'mt-3']) !!}
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="far fa-keyboard"></i>
                </span>
            </div>
            {!! Form::text('description', isset($element) ? $element->description : null, [
                'class' => 'form-control',
                'required',
                'placeholder' => 'Descripción',
            ]) !!}
        </div>
    </div>

    <div class="col-md-4">
        {!! Form::label('category_id', 'Categoria:', ['class' => 'mt-3']) !!}
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="far fa-list"></i>
                </span>
            </div>
            {!! Form::select('category_id', $categories, isset($element) ? $element->category_id : null, [
                'class' => 'form-control',
                'required',
                'placeholder' => 'Categoria',
            ]) !!}
        </div>

        {!! Form::label('UNSPSC_code', 'Codigo', ['class' => 'mt-3']) !!}
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="far fa-keyboard"></i>
                </span>
            </div>
            {!! Form::text('UNSPSC_code', isset($element) ? $element->UNSPSC_code : null, [
                'class' => 'form-control',
                'placeholder' => 'Codigo',
            ]) !!}
        </div>

        {!! Form::label('kind_of_purchase', 'Tipo de Compra:', ['class' => 'mt-3']) !!}
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="far fa-list"></i>
                </span>
            </div>
            {!! Form::select(
                'kind_of_purchase_id',
                $kind_of_purchase,
                isset($element) ? $element->kind_of_purchase_id : null,
                [
                    'class' => 'form-control',
                    'required',
                    'placeholder' => 'Tipo de Compra',
                ],
            ) !!}
        </div>
        
    </div>
</div>
<br>
<br>
<div class="row">
    <label>Subir imagen:</label>
    <div class="flex items-center justify-center w-full">
        <input type="file" name="image" id="image" class="hidden">
    </div>
</div>
<div class="row">
    <div class="card" style="max-width: 150px;">
        <div class="card-header"><b>Imagen</b></div>
        <div class="card-body">
            @if (isset($element))
                <img src="@if ($element->image && file_exists(public_path($element->image))) {{ asset($element->image) }} @else {{ asset('modules/sica/images/sinImagen.png') }} @endif"
                    id="imagenSeleccionada" class="img-fluid img-thumbnail"
                    style="max-height: 200px; max-width:300px float: left;">
            @else
                <img src="" id="imagenSeleccionada" class="img-fluid img-thumbnail"
                    style="max-height: 200px; max-width:300px float: left;">
            @endif
        </div>
    </div>
</div>
