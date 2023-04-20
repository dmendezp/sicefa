@if (isset($category))
    {!! Form::hidden('id', $category->id) !!}
@endif
{!! Form::label('name', 'Nombre:', ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::text('name', isset($category) ? $category->name : null, ['class' => 'form-control', 'required']) !!}
</div>

{!! Form::label('kind_of_property', 'Tipo de Propiedad:', ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::select('kind_of_property', getEnumValues('categories','kind_of_property'), isset($category) ? $category->kind_of_property : 'Bodega',
        ['class' => 'form-control', 'required']) !!}
</div>
