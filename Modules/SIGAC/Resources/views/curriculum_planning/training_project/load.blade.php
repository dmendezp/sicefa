@extends('sigac::layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="card card-blue card-outline shadow col-md-6">
                    <div class="card-header">
                        <h3 class="card-title">Cargar Trimestralización - {{ $nametraining_projectselected }}</h3>
                    </div>
                    <div class="card-body">
                        {!! Form::open([ 'url' => route('sigac.academic_coordination.curriculum_planning.quarterlie.load.store'), 'files' => 'true', 'enctype' => 'multipart/form-data']) !!}
                            <div class="form_load" id="form_load">
                                <div class="form-group">
                                    <div class="input-group">
                                        {!! Form::hidden('training_project_id', $training_project_id) !!}
                                        {!! Form::hidden('course_id', $course_id) !!}
                                        {{ Form::input('file', 'archivo', @$_REQUEST['archivo'], [
                                            'id' => 'archivo',
                                            'class' => 'form-control',
                                            'required',
                                            'aria-describedby' => 'inputGroupFile',
                                            'aria-label' => 'Upload'
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
        <div id="divResultado"></div>
    </div>
@endsection