@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">
        <a href="{{ route('ptventa.element.image.index') }}" class="text-decoration-none">Productos</a>
    </li>
    <li class="breadcrumb-item active">Actualizar imagen</li>
@endpush

@section('content')
    {!! Form::open(['route'=>'ptventa.element.image.store', 'method'=>'POST', 'id'=>'form-config']) !!}
        @csrf
            <div class="card card-success card-outline col-10 mx-auto">

                <div class="card-body pb-0">
                    <div class="row">

                        <div class="col-4">
                            <div class="card card-success border-success">
                                <div class="card-header text-center h5 py-1">
                                    Imagen
                                </div>
                                <div class="card-body mx-auto">
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

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Seleccionar imagen</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>

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
                                        <i class="fas fa-list"></i>
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
                            {!! Form::label('price', 'Precio:', ['class' => 'mt-3']) !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-keyboard"></i>
                                    </span>
                                </div>
                                {!! Form::text('price', isset($element) ? $element->price : null, [
                                    'class' => 'form-control',
                                    'required',
                                    'placeholder' => 'precio',
                                ]) !!}
                            </div>

                            {!! Form::label('category_id', 'Categoria:', ['class' => 'mt-3']) !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-list"></i>
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
                                        <i class="fas fa-list"></i>
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
                </div>
                <br><br>

                <div class="card-footer bg-white text-right">
                    <a href="{{ route('ptventa.element.image.index') }}" class="btn btn-sm btn-light mr-2">
                        <b>Cancelar</b>
                    </a>
                    <button type="submit" class="btn btn-sm btn-success">
                        <b>Guardar</b>
                    </button>
                </div>
            </div>
    {!! Form::close() !!}
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function (e) {
        $('#image').change(function () {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#imagenSeleccionada').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>
@endpush
