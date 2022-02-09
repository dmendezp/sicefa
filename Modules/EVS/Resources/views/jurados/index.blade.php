
@extends('evs::layouts.master')

@section('title','Home')

@section('breadcrumb')
<li class="breadcrumb-item active">
  <a href="{{ route('evs.jurados.index') }}"><i class="fas fa-home"></i> Home</a>
</li>
@endsection

@section('content')
   
Hola aqui van los jurados activos
@stop