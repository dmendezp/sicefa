@php
    $role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
@endphp

@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-orange card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Buscar Persona</h3>
                    </div>
                    <div class="card-body">
                        <div class="form_search" id="form_search">
                            {!! Form::open([
                                'url' => route('sica.' . getRoleRouteName(Route::currentRouteName()) . '.people.basic_data.search'),
                                'method' => 'get',
                                'class' => 'submit',
                            ]) !!}
                            <div class="row">
                                <div class="col-md-3">
                                    {!! Form::select('event_id', $events, null, ['class' => 'form-control', 'required']) !!}
                                </div>
                                <div class="col-md-6">
                                    {!! Form::number('document', null, ['class' => 'form-control', 'placeholder' => 'Documento', 'required']) !!}
                                </div>
                                <div class="col-md-3">
                                    {!! Form::submit('Buscar', ['class' => 'btn btn-primary submit']) !!}
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
        @if ($messages = Session::get('message_result'))
            Swal.fire({
                position: 'center', //'top-start','top-end','top-center', 'center-start','center','center-end','bottom','bottom-start','bottom-start'
                icon: 'success',
                title: '{{ $messages }}',
                showConfirmButton: false,
                timer: 2400
            });
        @endif
    </script>
@endsection
