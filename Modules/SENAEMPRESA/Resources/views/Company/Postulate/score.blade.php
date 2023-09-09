@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="formulario">
                    <div class="card-header">Puntaje</div>

                    <div class="card-body">
                        {!! Form::open(['url' => route('Nuevo')]) !!}
                        <div class="mb-6">
                            <label for="document_number" class="form-label">Documento</label>
                            {!! Form::number('document_number', null, ['class' => 'form-control']) !!}
                            <br>
                        </div>
                        <div class="mb-6">
                            <label for="document_number" class="form-label">Nombre</label>
                            {!! Form::text('document_number', null, ['class' => 'form-control']) !!}
                            <br>
                        </div>
                        <div class="mb-6">
                            <label for="document_number" class="form-label">Correo</label>
                            {!! Form::text('document_number', null, ['class' => 'form-control']) !!}
                            <br>
                        </div>
                        <div class="mb-6">
                            <label for="document_number" class="form-label">Puntaje</label>
                            {!! Form::number('document_number', null, ['class' => 'form-control']) !!}
                            <br>
                        </div>
                        {!! Form::submit('Asinar', ['class' => 'btn btn-success', 'name' => 'guardar']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
