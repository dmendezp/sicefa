@extends('pqrs::layouts.master')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <div class="card card-blue card-outline shadow col-md-12">
                <div class="card-header">
                    <h3 class="card-title">Cargar Excel de PQRS</h3>            
                </div>
                <div class="card-body">
                    {!! Form::open([ 'url' => route('pqrs.tracking.excel.store'), 'files' => 'true', 'enctype' => 'multipart/form-data']) !!}
                            <div class="form_load" id="form_load">
                                <div class="form-group">
                                    <div class="input-group">
                                        {{ Form::input('file', 'excel', @$_REQUEST['excel'], [
                                            'id' => 'excel',
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
</div>


@endsection