@extends('cefamaps::layouts.master')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="#"><i class="fas fa-solid fa-user-tie"></i> {{ trans('cefamaps::menu.Administrator') }}</a></li>
@endsection

@section('content')

<div class="content">
  <div class="container-fluid">
    <h3>Bienvenido {{ Auth::user()->roles[0]->name }} - {{ Auth::user()->nickname }}</h3>
    
  </div>
</div>
@endsection
