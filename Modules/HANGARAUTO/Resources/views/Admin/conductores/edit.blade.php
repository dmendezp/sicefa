@extends('hangarauto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hangarauto::drivers.Update_driver') }}</li>
@endpush

@section('content')
<br>
<div class="content">
    <div class="row justify-content-center">
        <div class="card card-primary card-outline shadow col-md-4">
            <div class="card-header">
                <h3>{{ trans('hangarauto::drivers.Update_driver') }}</h3>
            </div>

            <div class="form_search" id="form_search">
                <br>
                {!! Form::open(['url' => route('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.drivers.searchedit',$drivers->person_id)]) !!}
                <div class="row">
                    <div class="col-md-8">
                        {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => $drivers->person->document_number , 'required']) !!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::submit(trans('hangarauto::drivers.Search'), ['class' => 'btn btn-success']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
                <br>
            </div>
            @if(isset($people))
                @if(is_null($people))
                    <h1>{{ trans('hangarauto::drivers.Document Not Found')}}</h1>
                @else
                    {!! Form::open(['url' => route('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.drivers.update',$people->id), 'method'=> 'POST']) !!}
                    @csrf
                    <label class="mtop16" for="name">{{ trans('hangarauto::drivers.Name')}}:</label>
                    <div>
                        {{ $peopleupdate->first_name." ".$peopleupdate->first_last_name." ".$peopleupdate->second_last_name." ".$peopleupdate->document_number }}

                        {!! Form::hidden('person_id', $peopleupdate->id, ['class' => 'form-control', 'required']) !!}
                    </div>
                    <br>
                    {!! Form::submit( trans('hangarauto::drivers.Save'), ['class' => 'btn btn-success mtop16', 'style' => 'margin-bottom:20px']) !!}
                    {!! Form::close() !!}
                @endif
            @endif
        </div>
    </div>
</div>
@endsection