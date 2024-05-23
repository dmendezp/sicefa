@extends('pqrs::layouts.master')

@section('stylesheet')

<style>
    .save{
        position: relative;
        top: 10px;
        left: 450px
    }

    .saveBtn{
        width: 150px;
        font-weight: bold;
        
    }
</style>

@endsection

@section('content')

<div class="content">
    <div class="d-flex justify-content-center">
        <div class="card card-blue card-outline shadow col-md-12">
            <div class="card-header">
                <h3 class="card-title">Registrar PQRS</h3>            
            </div>
            <div class="card-body"> 
                <div class="container">         
                    {!! Form::open(['method' => 'post', 'url' => route('pqrs.tracking.store')]) !!}
                        <div class="row">
                            <div class="col-6">
                                {!! Form::label('filing_number', 'Numero Radicado') !!}
                                {!! Form::number('filing_number', null, ['class' => 'form-control']) !!}
                                @error('filing_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                {!! Form::label('nis', 'NIS') !!}
                                {!! Form::number('nis', null, ['class' => 'form-control']) !!}
                                @error('nis')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                {!! Form::label('filing_date', 'Fecha Radicado') !!}
                                {!! Form::date('filing_date', null, ['class' => 'form-control']) !!}
                                @error('filing_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                {!! Form::label('end_date', 'Limite respuesta de servicio') !!}
                                {!! Form::date('end_date', null, ['class' => 'form-control']) !!}
                                @error('end_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                {!! Form::label('type_pqrs', 'Asunto') !!}
                                {!! Form::select('type_pqrs', ['' => 'Seleccione el asunto', '1' => 'Peticion', '2' => 'Queja', '3' => 'Sugerencia'], null ,['class' => 'form-control']) !!}
                                @error('type_pqrs')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                {!! Form::label('issue', 'Descripción') !!}
                                {!! Form::textarea('issue', null, ['class' => 'form-control', 'style' => 'height: calc(2.25rem + 2px)']) !!}
                                @error('issue')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12">
                                {!! Form::label('responsible', 'Funcionario') !!}
                                {!! Form::select('responsible', [], null ,['class' => 'form-control responsible', 'style' => 'width: 100%;']) !!}
                                @error('responsible')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="save">                           
                                {!! Form::submit('Guardar', ['class' => 'btn btn-info saveBtn']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<script>
    $(document).ready(function() {
        $('.responsible').select2({
            placeholder: 'Ingrese nombre del funcionario',
            minimumInputLength: 3,
            ajax: {
                url: '{{ route("pqrs.tracking.searchOfficial") }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        name: params.term,
                    };
                },
                processResults: function(data) {
                    var results = data.map(function(item) {
                        return {
                            id: item.id,
                            text: item.name
                        };
                    });

                    return {
                        results: results
                    };
                },
                cache: true
            }
        });
    });
</script>

@endsection