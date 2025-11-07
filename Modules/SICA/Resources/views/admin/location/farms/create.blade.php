@extends('sica::layouts.master')

@section('stylesheet')
    @livewireStyles()
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-8">
                    <div class="card-header">
                        <h4>Registro de finca</h4>
                    </div>
                    <form action="{{ route('sica.admin.location.farms.store') }}" method="post">
                        @csrf
                        <div class="card-body pb-1">
                            <div class="form-group">
                                <label>Nombre:</label>
                                {!! Form::text('name', null, [
                                    'class'=>'form-control',
                                    'required'
                                ]) !!}
                            </div>
                            <div class="form-group">
                                <label>Descripción:</label>
                                {!! Form::textarea('description', null, [
                                    'class'=>'form-control',
                                    'rows'=>'3',
                                    'required'
                                ]) !!}
                            </div>
                            <div class="form-group">
                                <label>Área (m<sup>2</sup>):</label>
                                {!! Form::number('area', null, [
                                    'class'=>'form-control',
                                    'required'
                                ]) !!}
                            </div>

                            {{-- Se incluye el componente para consultar una persona y asignarla como responsable y también para seleccionar el municipio de localización --}}
                            @livewire('sica::admin.location.farms.consult-responsible', ['farm'=>null])

                        </div>
                        <div class="card-footer py-2 text-right">
                            <a href="{{ route('sica.admin.location.farms.index') }}" class="btn btn-secondary btn-sm">Cancelar</a>
                            <button type="submit" class="btn btn-primary btn-sm">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @livewireScripts()
@endsection
