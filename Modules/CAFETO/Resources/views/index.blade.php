@extends('cafeto::layouts.master')

@section('content')
    <h1>Hello CAFETO</h1>

    <p>
        This view is loaded from module: {!! config('cafeto.name') !!}
    </p>
@endsection
