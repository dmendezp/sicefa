@php
    $role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
@endphp

@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Agregar Datos</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body box-profile">
                        <form action="{{ route('sica.'.$role_name.'.people.basic_data.store') }}" method="post" id="submit">
                            @csrf
                            <input type="hidden" name="event_id" value="{{ $event }}">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Nombres</label>
                                        {!! Form::text('first_name', null, [
                                            'class' => 'form-control',
                                            'required'
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Primer Apellido </label>
                                        {!! Form::text('first_last_name', null, [
                                            'class' => 'form-control',
                                            'required'
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Segundo Apellido</label>
                                        {!! Form::text('second_last_name', null, [
                                            'class' => 'form-control',
                                            'required'
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Tipo Documento</label>
                                        {!! Form::select('document_type', getEnumValues('people', 'document_type'), null, [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Seleccione --',
                                            'required'
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Número Documento </label>
                                        {!! Form::number('document_number', $doc, [
                                            'class' => 'form-control',
                                            'required',
                                            'readonly'
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Eps</label>
                                        <select class="form-control" name="eps_id" id="" required>
                                            @foreach ($eps as $e)
                                                <option value="{{ $e->id }}" {{ old('eps_id') == $e->id ? 'selected' : '' }}>{{ $e->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Grupo poblacional</label>
                                        <select class="form-control" name="population_group_id" required>
                                            @foreach ($population_groups as $groups)
                                                <option value="{{ $groups->id }}" {{ old('population_group_id') == $groups->id ? 'selected' : '' }}>{{ $groups->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Entidad de pensiones</label>
                                        <select class="form-control" name="pension_entity_id" required>
                                            @foreach ($pension_entities as $pension)
                                                <option value="{{ $pension->id }}" {{ old('pension_entity_id') == $pension->id ? 'selected' : '' }}>{{ $pension->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                @if (Auth::user()->havePermission('sica.'.$role_name.'.people.basic_data.store'))
                                    <button type="submit" class="btn btn-primary">Registrar</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
