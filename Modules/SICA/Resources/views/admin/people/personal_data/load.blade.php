@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-6">
                    <div class="card-header">
                        <h3 class="card-title">Cargar Personas</h3>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['url' => route('sica.admin.people.personal_data.load.store'), 'files' => 'true', 'enctype' => 'multipart/form-data']) !!}
                            <div class="form_load" id="form_load">
                                <div class="form-group">
                                    <div class="input-group">
                                        {{ Form::input('file', 'archivo', @$_REQUEST['archivo'], [
                                            'class' => 'form-control',
                                            'id' => 'archivo',
                                            'aria-describedby' => 'inputGroupFile',
                                            'aria-label' => 'Upload',
                                            'required' => 'required'
                                        ]) }}
                                        {!! Form::submit('Cargar', ['id' => 'inputGroupFile', 'class' => 'btn btn-outline-secondary']) !!}
                                    </div>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
