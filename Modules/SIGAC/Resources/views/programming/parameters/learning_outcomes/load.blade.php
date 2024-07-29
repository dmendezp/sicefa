@extends('sigac::layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="card card-blue card-outline shadow col-md-6">
                    <div class="card-header">
                        <h3 class="card-title">Cargar Resultados - {{ $nameprogram }}</h3>
                    </div>
                    <div class="card-body">
                        {!! Form::open([ 'url' => route('sigac.academic_coordination.programming.learning_outcome.load.store'), 'files' => 'true', 'enctype' => 'multipart/form-data']) !!}
                            <div class="form_load" id="form_load">
                                <div class="form-group">
                                    <div class="input-group">
                                        {{ Form::input('file', 'archivo', @$_REQUEST['archivo'], [
                                            'id' => 'archivo',
                                            'class' => 'form-control',
                                            'required',
                                            'aria-describedby' => 'inputGroupFile',
                                            'aria-label' => 'Upload'
                                        ]) }}
                                        {!! Form::hidden('program_id', $program_id ) !!}
                                        {!! Form::submit('Cargar', ['id' => 'inputGroupFile', 'class' => 'btn btn-outline-secondary']) !!}
                                        
                                    </div>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <div id="divResultado"></div>
    </div>
@endsection