@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">
        <a href="{{ route('ptventa.'.getRoleRouteName(Route::currentRouteName()).'.element.index') }}" class="text-decoration-none">{{ trans('ptventa::element.Breadcrumb_Element') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('ptventa::element.Breadcrumb_Active_Create_Element') }}</li>
@endpush

@section('content')
    {!! Form::open(['route'=>'ptventa.'.getRoleRouteName(Route::currentRouteName()).'.element.store', 'method'=>'POST', 'id'=>'form-element' , 'enctype'=>'multipart/form-data']) !!}
        @csrf
        <div class="card card-success card-outline mx-auto mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-success border-success">
                            <div class="card-header text-center h5 py-1">
                                {{ trans('ptventa::element.Title_Card_Image') }}
                            </div>
                            <div class="card-body text-center">
                                <img src="{{ asset('modules/sica/images/sinImagen.png') }}" id="imagenSeleccionada" class="img-fluid img-thumbnail" style="max-height: 200px; max-width:300px float: left;">
                                <hr>
                                <div class="my-0 text-left">
                                    <label for="formFile" class="form-label">{{ trans('ptventa::element.Title_Form_Image') }}</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        {!! Form::label('name', trans('ptventa::element.Title_Form_Element_Name'), ['class' => 'mt-3']) !!}
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

                        {!! Form::label('measurement_unit', trans('ptventa::element.Title_Form_Unit'), ['class' => 'mt-3']) !!}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-list"></i>
                                </span>
                            </div>
                            <select name="measurement_unit_id" class="form-select" required>
                                <option value="">{{ trans('ptventa::element.Select_Form_MU') }}</option>
                                @foreach ($measurement_units as $mu)
                                    <option value="{{ $mu->id }}" {{ old('measurement_unit_id') == $mu->id ? 'selected' : '' }}>{{ $mu->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('measurement_unit_id')
                            <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                        @enderror

                        {!! Form::label('description', trans('ptventa::element.Title_Form_Description'), ['class' => 'mt-3']) !!}
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
                        {!! Form::label('price', trans('ptventa::element.Title_Form_Price'), ['class' => 'mt-3']) !!}
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

                        {!! Form::label('category_id', trans('ptventa::element.Title_Form_Category'), ['class' => 'mt-3']) !!}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-list"></i>
                                </span>
                            </div>
                            <select name="category_id" class="form-select" required>
                                <option value="">{{ trans('ptventa::element.Select_Form_Category')}}</option>
                                @foreach ($categories as $c)
                                    <option value="{{ $c->id }}" {{ old('measurement_unit_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('category_id')
                            <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                        @enderror

                        {!! Form::label('UNSPSC_code', trans('ptventa::element.Title_Form_COD_UNSPSC'), ['class' => 'mt-3']) !!}
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

                        {!! Form::label('kind_of_purchase_id', trans('ptventa::element.Title_Form_Type_Purchase'), ['class' => 'mt-3']) !!}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-list"></i>
                                </span>
                            </div>
                            <select name="kind_of_purchase_id" class="form-select" required>
                                <option value="">{{ trans('ptventa::element.Select_Form_Type_Purchase')}}</option>
                                @foreach ($kind_of_purchases as $kp)
                                    <option value="{{ $kp->id }}" {{ old('measurement_unit_id') == $kp->id ? 'selected' : '' }}>{{ $kp->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('kind_of_purchase_id')
                            <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white text-right">
                <a href="{{ route('ptventa.'.getRoleRouteName(Route::currentRouteName()).'.element.index') }}" class="btn btn-sm btn-light mr-2">
                    <strong>{{ trans('ptventa::element.Btn_Cancel')}}</strong>
                </a>
                @if(Auth::user()->havePermission('ptventa.'.getRoleRouteName(Route::currentRouteName()).'.element.store'))
                    <button type="submit" class="btn btn-sm btn-success" id="btn-register-element">
                        <b>{{ trans('ptventa::element.Btn_Register')}}</b>
                    </button>
                @endif
            </div>
        </div>
    {!! Form::close() !!}
@endsection

@push('scripts')
    <!-- Recursos para los formatedores de datos -->
    <script src="{{ asset('libs/cleave.js-1.6.0/dist/cleave.js') }}"></script>
    <!-- Formateadores de datos -->
    <script src="{{ asset('modules/ptventa/js/data-formats.js') }}"></script>

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
