@extends('hdc::layouts.master')

@section('title', 'Datos')

@push('breadcrumbs')
    <li class="breadcrumb-item active">Formulario</li>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="card card-success card-outline shadow col-md-5 mt-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <label for="user_id">Documento de usuario</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-user-alt"></i>
                                        </span>
                                    </div>
                                    {!! Form::number('documento', null, [
                                        'id' => 'documento',
                                        'class' => 'form-control',
                                        'placeholder' => 'Digite número de identificación',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-success mt-4" onclick="calculosUsuario()">Consultar</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <div id="respuesta"></div>
        </div>
    </div>
@endsection






