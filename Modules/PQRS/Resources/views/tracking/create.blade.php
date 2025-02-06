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
                <h3 class="card-title">{{ trans('pqrs::tracking.register_pqrs') }}</h3>            
            </div>
            <div class="card-body"> 
                <div class="container">         
                    {!! Form::open(['method' => 'post', 'url' => route('pqrs.tracking.store')]) !!}
                        <div class="row">
                            <div class="col-6">
                                {!! Form::label('filing_number', trans('pqrs::tracking.filed_number')) !!}
                                {!! Form::number('filing_number', null, ['class' => 'form-control', 'placeholder' => trans('pqrs::tracking.enter_filing_number')]) !!}
                                @error('filing_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                {!! Form::label('nis', 'NIS') !!}
                                {!! Form::number('nis', null, ['class' => 'form-control', 'placeholder' => trans('pqrs::tracking.enter_the_nis')]) !!}
                                @error('nis')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                {!! Form::label('filing_date', trans('pqrs::tracking.date_filed')) !!}
                                {!! Form::date('filing_date', null, ['class' => 'form-control']) !!}
                                @error('filing_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                {!! Form::label('end_date', trans('pqrs::tracking.service_response_limit')) !!}
                                {!! Form::date('end_date', null, ['class' => 'form-control']) !!}
                                @error('end_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                {!! Form::label('type_pqrs', trans('pqrs::tracking.issue')) !!}
                                {!! Form::select('type_pqrs', $type_pqrs, null ,['class' => 'form-control', 'placeholder' => trans('pqrs::tracking.select_the_subject')]) !!}
                                @error('type_pqrs')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                {!! Form::label('issue', trans('pqrs::tracking.description')) !!}
                                {!! Form::textarea('issue', null, ['class' => 'form-control', 'style' => 'height: calc(2.25rem + 2px)', 'placeholder' => trans('pqrs::tracking.enter_the_subject_description')]) !!}
                                @error('issue')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12">
                                {!! Form::label('responsible', trans('pqrs::tracking.official')) !!}
                                {!! Form::select('responsible', [], null ,['class' => 'form-control responsible', 'style' => 'width: 100%;']) !!}
                                @error('responsible')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12">
                                {!! Form::label('assistant_one', trans('pqrs::tracking.assist_1')) !!}
                                {!! Form::select('assistant_one', [], null ,['class' => 'form-control assistant_one', 'style' => 'width: 100%;']) !!}
                            </div>
                            <div class="col-12">
                                {!! Form::label('assistant_two', trans('pqrs::tracking.assist_2')) !!}
                                {!! Form::select('assistant_two', [], null ,['class' => 'form-control assistant_two', 'style' => 'width: 100%;']) !!}
                            </div>
                            <div class="save">                           
                                {!! Form::submit(trans('pqrs::tracking.save'), ['class' => 'btn btn-info saveBtn']) !!}
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
            placeholder: '{{ trans("pqrs::tracking.enter_name_of_official") }}',
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
        $('.assistant_one').select2({
            placeholder: '{{ trans("pqrs::tracking.enter_support_name") }}',
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
        $('.assistant_two').select2({
            placeholder: '{{ trans("pqrs::tracking.enter_support_name") }}',
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