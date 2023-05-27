@extends('ptventa::layouts.master')

@push('breadcrumbs')
<div class="col-sm-6">
    <h1 class="m-0">{{ $view['titleView'] }}</h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item active">Caja</li>
    </ol>
</div>
@endpush

@section('content')
    <div class="card text-end" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Special title treatment</h5>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
