@extends('sigac::layouts.master')

@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Vista previa: {{ $filename }}</h5>
    <a href="javascript:history.back()" class="btn btn-outline-secondary btn-sm">Volver</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      {{-- PhpSpreadsheet ya genera una tabla HTML completa con estilos inline --}}
      {!! $html !!}
    </div>
  </div>
</div>
@endsection
