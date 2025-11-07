
@extends('layouts.app')

@section('content')
<link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <div class="content co">
        <div class="container-fluid">
            <div class=" d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Actualizar Datos Personales</h3>
                    </div>
                    <div class="card-body box-profile" style="margin-top: 0px">
                        {!! Form::open(['url' => route('register.usergoogle'), 'style' => 'margin-top: 0px']) !!}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <b class="text-danger">*</b>
                                        <label>Nickname</label>
                                        {!! Form::text('nickname', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Ingrese su nickname',
                                            'required',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <b class="text-danger">*</b>
                                        <label>Nombre</label>
                                        {!! Form::text('name', $user->name, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Ingrese su primer nombre',
                                            'required',
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <b class="text-danger">*</b>
                                        <label>Tipo documento</label>
                                        {!! Form::select('document_type', getEnumValues('people', 'document_type'), null, [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Seleccione --',
                                            'required'
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <b class="text-danger">*</b>
                                        <label>Número de documento</label>
                                        {!! Form::number('document_number', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Documento',
                                            'required'
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Correo personal</label>
                                        {!! Form::email('personal_email', $user->email, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Correo electrónico'
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                {!! Form::submit('Actualizar', ['class' => 'btn btn-primary bt']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
