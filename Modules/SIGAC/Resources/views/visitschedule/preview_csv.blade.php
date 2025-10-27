@extends('sigac::layouts.master')

@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Vista previa: {{ $filename }}</h5>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-sm">
        <tbody>
          @foreach ($rows as $r)
            <tr>
              @foreach ($r as $c)
                <td>{{ $c }}</td>
              @endforeach
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
