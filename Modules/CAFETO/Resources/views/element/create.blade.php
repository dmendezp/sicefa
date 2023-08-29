@extends('cafeto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">
        <a href="{{ route('cafeto.element.index') }}" class="text-decoration-none">Producto</a>
    </li>
    <li class="breadcrumb-item active">Registrar Producto</li>
@endpush

@section('content')
    {!! Form::open(['route'=>'cafeto.element.store', 'method'=>'POST', 'id'=>'form-element' , 'enctype'=>'multipart/form-data']) !!}
        @csrf
        <div class="card card-success card-outline mx-auto mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-success border-success">
                            <div class="card-header text-center h5 py-1">
                                Imagen
                            </div>
                            <div class="card-body text-center">
                                <img src="{{ asset('modules/sica/images/sinImagen.png') }}" id="imagenSeleccionada" class="img-fluid img-thumbnail" style="max-height: 200px; max-width:300px float: left;">
                                <hr>
                                <div class="my-0 text-left">
                                    <label for="formFile" class="form-label">Seleccione</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        {!! Form::label('name', 'Nombre', ['class' => 'mt-3']) !!}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-keyboard"></i>
                                </span>
                            </div>
                            {!! Form::text('name', null, [
                                'class' => 'form-control',
                                'required'
                            ]) !!}
                        </div>
                        @error('name')
                            <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                        @enderror

                        {!! Form::label('measurement_unit', 'Unidad de Medida', ['class' => 'mt-3']) !!}
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
                        @error('measurement_unit_id')
                            <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                        @enderror

                        {!! Form::label('description', 'Descripciòn', ['class' => 'mt-3']) !!}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-keyboard"></i>
                                </span>
                            </div>
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '5']) !!}
                        </div>
                        @error('description')
                            <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        {!! Form::label('price', 'Precio', ['class' => 'mt-3']) !!}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-keyboard"></i>
                                </span>
                            </div>
                            {!! Form::text('price', null, [
                                'class' => 'form-control price-format',
                                'id' => 'price',
                                'required'
                            ]) !!}
                        </div>
                        @error('price')
                            <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                        @enderror

                        {!! Form::label('category_id', 'Categoria', ['class' => 'mt-3']) !!}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-list"></i>
                                </span>
                            </div>
                            {!! Form::select('category_id', $categories, isset($element) ? $element->category_id : null, [
                                    'class' => 'form-control',
                                    'required',
                                    'placeholder' => '--Seleccione--',
                                ]) !!}
                        </div>
                        @error('category_id')
                            <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                        @enderror

                        {!! Form::label('UNSPSC_code', 'Codigo', ['class' => 'mt-3']) !!}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-keyboard"></i>
                                </span>
                            </div>
                            {!! Form::number('UNSPSC_code', null, ['class' => 'form-control']) !!}
                        </div>
                        @error('UNSPSC_code')
                            <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                        @enderror

                        {!! Form::label('kind_of_purchase_id', 'Tipo de Compra', ['class' => 'mt-3']) !!}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-list"></i>
                                </span>
                            </div>
                            {!! Form::select( 'kind_of_purchase_id', $kind_of_purchase, isset($element) ? $element->kind_of_purchase_id : null,
                                [
                                    'class' => 'form-control',
                                    'required',
                                    'placeholder' => '--Seleccione--',
                                ],
                            ) !!}
                        </div>
                        @error('kind_of_purchase_id')
                            <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white text-right">
                <a href="{{ route('cafeto.element.index') }}" class="btn btn-sm btn-light mr-2">
                    <strong>Cancelar</strong>
                </a>
                    <button type="submit" class="btn btn-sm btn-success" id="btn-register-element">
                        <b>Guardar</b>
                    </button>
            </div>
        </div>
    {!! Form::close() !!}
@endsection

@push('scripts')
    <!-- Recursos para los formatedores de datos -->
    <script src="{{ asset('libs/cleave.js-1.6.0/dist/cleave.js') }}"></script>
    <!-- Formateadores de datos -->
    <script src="{{ asset('modules/cafeto/js/data-formats.js') }}"></script>

    <script>
        $(document).ready(function (e) {
            // Obtener la URL de la imagen predeterminada
            var defaultImageSrc = $('#imagenSeleccionada').attr('src');
            $('#image').change(function () {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#imagenSeleccionada').attr('src', e.target.result);
                }
                // Verificar si se seleccionó una imagen
                if (this.files && this.files[0]) {
                    reader.readAsDataURL(this.files[0]);
                } else {
                    // Si no se selecciona una imagen, restaurar la imagen predeterminada
                    $('#imagenSeleccionada').attr('src', defaultImageSrc);
                }
            });

            // Desactivar botón de registrar cuando se envíe el formulario
            $("#form-element").submit(function() {
                $("#btn-register-element").prop("disabled", true); // Deshabilitar el botón
            });
        });
    </script>
@endpush