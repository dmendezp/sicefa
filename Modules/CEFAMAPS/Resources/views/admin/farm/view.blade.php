@extends('cefamaps::layouts.master')

@section('breadcrumb')

  <li class="breadcrumb-item"><a href="#"><i class="fas fa-solid fa-tractor"></i> {{ trans('cefamaps::farm.Farm') }}</a></li>
  <li class="breadcrumb-item"><a href="#"><i class="fas <!-- falta el icono -->"></i> {{ $viewfarm->name }}</a></li>

@endsection

@section('content')

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-lightblue card-outline">
            <div class="card-header">
              <h3 class="m-0">{{ trans('cefamaps::farm.Farm') }} - {{ $viewfarm->name }}</h3>
            </div>
            <div class="card-body">
              <div class="content">
                <h1>{{ $viewfarm->description }}</h1>
                <br>
                <h1>{{ $viewfarm->municipality_id }}</h1>
                <br>
                <h1>{{ $viewfarm->person_id }}</h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script')

<script>

</script>

@endsection