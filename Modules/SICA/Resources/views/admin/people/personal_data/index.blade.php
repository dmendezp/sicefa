@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-6">
                    <div class="card-header">
                        <h3 class="card-title">Consultar persona</h3>
                    </div>
                    <div class="card-body">
                        <div class="form_search" id="form_search">
                            {!! Form::open(['url' => route('sica.admin.people.personal_data.search'), 'method' => 'POST']) !!}
                                <div class="row">
                                    <div class="col-md">
                                        {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Número de identificación']) !!}
                                    </div>
                                    <div class="col-md-auto">
                                        {!! Form::submit('Buscar', ['class' => 'btn btn-primary']) !!}
                                    </div>
                                    {{-- <div class="col-md-2">
                                        {!! Form::button('Busqueda avanzada', ['class' => 'btn btn-link btn-xs']) !!}
                                    </div> --}}
                                    <div class="col-md-auto">
                                        <a class="btn btn-outline-secondary" href="{{ route('sica.admin.people.personal_data.load.create') }}">Cargar Archivo</a>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection