@extends('agrocefa::layouts.master')

@section('content')
<h1>Inventario</h1>

@if ($inventory !== null && $inventory->isEmpty())
<h1>vacio</h1>
@elseif ($inventory !== null)
<h1>no vacio</h1>
@else
<h1>null</h1>
@endif

@endsection