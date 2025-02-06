
@extends('evs::layouts.master')

@section('title','Report')

@section('breadcrumb')
<li class="breadcrumb-item active">
  <a href="{{ route('evs.admin.dashboard') }}"><i class="fas fa-file-alt"></i> {{ __('Report') }}</a>
</li>
@endsection

@section('content')
    <!-- Main content -->
    <div class="content">

      <div class="container-fluid">

			<div class="card card-purple card-outline shadow">
              <div class="card-header">
                <h3 class="card-title">{{ __('Report') }}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

@foreach($program as $p)
        <div class="mtop16">
                <table id="" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <td bgcolor="#7953d2" colspan="3">{{ $p->name }} - {{ $p->code }}</td>
                    </tr>
                  <tr>
                    <th>Nro</th>
                    <th>Nombre</th>
                    <th>Estado</th>

                  </tr>
                  </thead>
                  <tbody>
                    @php
                        $i = 1
                    @endphp
                   @foreach($authorizeds as $a)
                   @if($p->id == $a->id) 
                  <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $a->first_name }} {{ $a->first_last_name }} {{ $a->second_last_name }}</td>
                    <td>
                        @if($a->status=='Activo')
                          Pendiente votar
                        @else
                          Registro voto
                        @endif

                    </td>

                  </tr>
                  @endif
        @endforeach
                  </tbody>

                </table>
            </div>

@endforeach

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

      </div><!-- /.container-fluid -->
    <!-- /.content -->

@stop