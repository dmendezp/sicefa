@extends('cafeto::layouts.master')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Developers</a></li>
@endsection
@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('cafeto.name') !!}
    </p>
    <input type="text" class="form-control" />
@endsection
