@extends('cafeto::layouts.master')

@section('content')

<div class="card">
    <div class="card-body">
        <h1>Hello CAFETO</h1>

        <p>
            This view is loaded from module: {!! config('cafeto.name') !!}
        </p>
    </div>
</div>

@endsection
