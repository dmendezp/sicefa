@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">Caja</li>
@endpush

@section('content')
    <h1 class="display-3">{{ $view['titleView'] }}</h1>
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
