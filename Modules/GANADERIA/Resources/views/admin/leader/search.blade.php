@extends('ganaderia::layouts.master')

@section('style')
@endsection

@section('breadcrumb')
@endsection

@section('content')

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-success card-outline">
            <div class="card-header">
              <h5 class="m-0">{{ trans('ganaderia::leader.Search') }}</h5>
            </div>
            <div class="card-body">
              <div class="content">
                <!-- buscar.blade.php -->
                <div class="container text-center">
                  <form action="{{ route('ganaderia.admin.leader.search') }}" method="GET">
                    <div class="row align-items-start">
                      <div class="col">
                        <input class="form-control" type="number" name="code" placeholder="Escribe un número">
                      </div>
                      <div class="col-2">
                        <button type="submit" class="btn btn-light btn-block btn-outline-success">Buscar</button>
                      </div>
                    </div>
                  </form>
                </div>
                <br>
                @if (isset($searchcode) && count($searchcode) > 0)
                  @foreach ($searchcode as $s)
                    <h2>El Animal {{ $s->name }}, codigo: {{ $s->code }}:</h2>
                    <ul>
                      <li>{{ $s->races->name }} - {{ $s->mother }} - {{ $s->weight }} - {{ $s->sex }} - {{ $s->color }} {{ $s->date_of_birth }}</li>
                    </ul>
                  @endforeach
                @else
                  <p>No se encontraron resultados.</p>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script')
@endsection