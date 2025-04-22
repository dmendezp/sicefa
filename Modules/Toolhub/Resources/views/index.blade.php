@extends('toolhub::layouts.masterusers')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('toolhub.name') !!}
    </p>
@endsection
