@extends('agrocefa::layouts.master')

@section('content')
<h2>Resultado JSON</h2>

    <div class="container">
        <pre>{{ json_encode($responseData, JSON_PRETTY_PRINT) }}</pre>
    </div>
@endsection