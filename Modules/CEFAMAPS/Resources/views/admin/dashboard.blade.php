@extends('cefamaps::layouts.master')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="#"><i class="fas fa-solid fa-user-tie"></i> {{ trans('cefamaps::menu.Administrator') }}</a></li>
@endsection

@section('content')

<div class="content">
  <div class="container-fluid">
    
  </div>
</div>
@endsection

@section('script')

  <script>

  Swal.fire({
    title: 'Bienvenido {{ Auth::user()->roles[0]->name }} - {{ Auth::user()->nickname }}',
    position: 'top-end',
    showConfirmButton: false,
    timer: 2000,
  })

  </script>

@endsection
