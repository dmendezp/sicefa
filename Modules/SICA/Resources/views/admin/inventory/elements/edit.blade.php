@extends('sica::layouts.master')

@section('stylesheet')
@endsection

@section('content')
    <div class="card card-primary card-outline col-8 mx-auto">
        <div class="card-header">
            <h4>Formulario Elementos</h4>
        </div>
            <div class="card-body">
                @include('sica::admin.inventory.elements.form')
            </div>
            <div class="card-footer bg-white ">
                {!! Form::submit('Registrar', ['class'=>'btn btn-primary btn-md py-0 float-right']) !!}
                <a href="{{ route('sica.admin.inventory.elements') }}" class="btn btn-sm btn-light btn-md py-0 float-right">
                    <b>Cancelar</b>
                </a>
           </div>
    </div>
@endsection

@section('script')
@endsection   
