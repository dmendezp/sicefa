@extends('ptventa::layouts.master')

@section('content')
    <h1>Bienvenido grupo <strong>AdsiCodingGroup</strong></h1>

    <p>
        Esta es la vista principal del modulo PTVENTA para el proyecto Punto de Venta.
        <a href="{{ route('cefa.welcome') }}">Volver a SICEFA</a>
    </p>
@endsection
