@extends('agroindustria::layouts.master')
@section('content')

    <h1>Vista de {{ $selectedUnit->name }}</h1>
    <h2>{{ session('viewing_unit') }}</h2>

@endsection