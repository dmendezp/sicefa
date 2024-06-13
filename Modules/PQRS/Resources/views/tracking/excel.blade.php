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
                    <select name="type_excel" id="type_excel" class="form-control">
                        <option value="">Seleccione el Excel que va a cargar</option>
                        <option value="regional">Seguimiento Regional</option>
                        <option value="centro">Seguimiento del Centro</option>
                    </select>
                    <br>
                    <div class="form_load_regional" id="form_load_regional" style="display: none">
                        {!! Form::open([ 'url' => route('pqrs.tracking.excel.store_excel_regional'), 'files' => 'true', 'enctype' => 'multipart/form-data']) !!}
                            <div class="form-group">
                                <div class="input-group">
                                    {{ Form::input('file', 'excel', @$_REQUEST['excel'], [
                                        'id' => 'excel',
                                        'class' => 'form-control',
                                        'required',
                                        'aria-describedby' => 'inputGroupFile',
                                        'aria-label' => 'Upload'
                                    ]) }}
                                    
                                    {!! Form::submit('Cargar Excel Regional', ['id' => 'inputGroupFile', 'class' => 'btn btn-outline-secondary']) !!}
                                    
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="form_load_centro" id="form_load_centro" style="display: none">
                        {!! Form::open([ 'url' => route('pqrs.tracking.excel.store_excel_centro'), 'files' => 'true', 'enctype' => 'multipart/form-data']) !!}
                            <div class="form-group">
                                <div class="input-group">
                                    {{ Form::input('file', 'excel', @$_REQUEST['excel'], [
                                        'id' => 'excel',
                                        'class' => 'form-control',
                                        'required',
                                        'aria-describedby' => 'inputGroupFile',
                                        'aria-label' => 'Upload'
                                    ]) }}
                                    
                                    {!! Form::submit('Cargar Excel de Centro', ['id' => 'inputGroupFile', 'class' => 'btn btn-outline-secondary']) !!}
                                    
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
@section('script')
<script>
    $(document).ready(function() {
        $('#type_excel').on('change', function() {
            var type_excel = $(this).val();

            if (type_excel == 'regional'){
                $('#form_load_centro').hide();
                $('#form_load_regional').show();
            }else{
                $('#form_load_regional').hide();
                $('#form_load_centro').show();
            }
        });
        
    });
</script>
@endsection