@extends('cefamaps::layouts.master')

@section('breadcrumb')

  <li class="breadcrumb-item"><a href="#"><i class="fas fa-solid fa-mountain-sun"></i> {{ trans('cefamaps::unit.Units') }}</a></li>
  <li class="breadcrumb-item"><a href="#"><i class="fas {{ $viewunit->icon }}"></i> {{ $viewunit->name }}</a></li>

@endsection

@section('content')

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-lightblue card-outline">
            <div class="card-header">
              <h3 class="m-0">{{ trans('cefamaps::unit.Unit') }} - {{ $viewunit->name }}</h3>
            </div>
            <div class="card-body">
              <div class="content">
                <h1>{{ $viewunit->description }}</h1>
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