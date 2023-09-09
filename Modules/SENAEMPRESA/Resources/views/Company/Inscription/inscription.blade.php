@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">{{ $title }}</div>

                    <div class="card-body">
                        {!! Form::open(['url' => route('inscription')]) !!}
                        <div class="mb-6">
                            <label for="document_number" class="form-label">Documento</label>
                            {!! Form::text('', null, ['class' => 'form-control']) !!}
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
                            <label for="document_number" class="form-label">Telefono</label>
                            {!! Form::number('document_number', null, ['class' => 'form-control']) !!}
                            <br>
                        </div>
                        <div class="mb-6">
                            <label for="document_number" class="form-label">Fecha</label>
                            {!! Form::date('document_number', null, ['class' => 'form-control']) !!}
                            <br>
                        </div>
                        <div class="mb-6">
                            <label for="document_number" class="form-label">Id Vacante</label>
                            {!! Form::select('document_number', $optionsArray, null, ['class' => 'form-control']) !!}
                            <br>
                        </div>
                        <div class="mb-6">
                            <label for="document_number" class="form-label">Hoja de vida</label><br>
                            {!! Form::file('document_number', null, ['class' => 'form-control']) !!}<br>
                            <label for="document_number" class="form-label">Hoja de vida</label><br>
                            {!! Form::file('document_number', null, ['class' => 'form-control']) !!}
                            <br><br>
                        </div>
                        {!! Form::submit('Incribirse', ['class' => 'btn btn-success', 'name' => 'inscribirse']) !!}
                        <a href="{{ route('vacantes') }}">
                            {!! Form::button('Cancelar', ['class' => 'btn btn-danger', 'name' => 'cancelar']) !!}
                        </a>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div><br>
@endsection
