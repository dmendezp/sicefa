
@extends('bolmeteor::layouts.admin')

@section('title','Candidates')

@section('breadcrumb')
<li class="breadcrumb-item active">
  <a href="{{ route('bolmeteor.admin.candidates') }}"><i class="fas fa-id-card-alt"></i> {{ __('Candidates') }}</a>
</li>
@endsection

@section('content')
    <!-- Main content -->

Aqui va o diseño de la viata de candidatos
@stop