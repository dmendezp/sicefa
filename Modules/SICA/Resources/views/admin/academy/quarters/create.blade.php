@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-6">
                    <div class="card-header">
                        <h4>Registro trimestre</h4>
                    </div>
                    <form action="{{ route('sica.admin.academy.quarters.store') }}" method="post">
                        @csrf
                        <div class="card-body pb-1">
                            <div class="form-group">
                                <label>Nombre:</label>
                                {!! Form::text('name', null, ['class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label>Fecha de inicio:</label>
                                {!! Form::date('start_date', null, ['class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label>Fecha de finalización:</label>
                                {!! Form::date('end_date', null, ['class'=>'form-control', 'required']) !!}
                            </div>
                        </div>
                        <div class="card-footer py-2 text-right">
                            <a href="{{ route('sica.admin.academy.quarters.index') }}" class="btn btn-secondary btn-sm">Cancelar</a>
                            <button type="submit" class="btn btn-primary btn-sm">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
