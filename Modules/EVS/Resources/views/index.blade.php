@extends('evs::layouts.master')

@section('content')
    <h1>Hello ADSI</h1>

    <p>
        Este es el proyecto: {!! config('evs.name') !!}
    </p>
@endsection
