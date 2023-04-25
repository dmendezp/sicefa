@if (isset($elements))
    {!! Form::hidden('id', $elements->id) !!}
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
            {!! Form::text('name', isset($elements) ? $elements->name : null, [
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
            {!! Form::select('measurement_unit_id', $measurementUnit,  isset($elements) ? $elements->measurement_unit->name : null, [
                    'class' => 'form-control',
                    'required',
                    'placeholder' => 'Medida',
            ]) !!}
        </div>

        {!! Form::label('description', 'Descripción:', ['class' => 'mt-3']) !!}
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="far fa-keyboard"></i>
                </span>
            </div>
            {!! Form::text('description', isset($elements) ? $elements->description : null, [
                'class' => 'form-control',
                'required',
                'placeholder' => 'Descripción',
            ]) !!}
        </div>
    </div>

    <div class="col-md-4">
        {!! Form::label('category', 'Categoria:', ['class' => 'mt-3']) !!}
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="far fa-list"></i>
                </span>
            </div>
            {!! Form::select('categoty_id', $categories,  isset($elements) ? $elements->categoty->name : null, [
                    'class' => 'form-control',
                    'required',
                    'placeholder' => 'Categoria',
            ]) !!}
        </div>

        {!! Form::label('code', 'Codigo', ['class' => 'mt-3']) !!}
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="far fa-keyboard"></i>
                </span>
            </div>
            {!! Form::text('description', isset($elements) ? $elements->description : null, [
                'class' => 'form-control',
                'required',
                'placeholder' => 'Codigo',
            ]) !!}
        </div>

        <br>
        <div class="input-group">
            <div class="row">
                <label>Subir imagen:</label>
                <div class="flex items-center justify-center w-full">
                    <input type="file" name="image" id="image" class="hidden">
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-secondary mb-3" style="max-width: 18rem;">
            <div class="card-header"><b>Imagen</b></div>
            <div class="card-body">
                <img id="imagenSeleccionada" style="width: 90%; height: 90%; float: left;">
            </div>
        </div>
    </div>
</div>

