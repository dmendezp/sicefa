
@extends('evs::layouts.master')

@section('title','Dashboard')

@section('breadcrumb')
<li class="breadcrumb-item active">
  <a href="{{ route('evs.admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> {{ __('Dashboard') }}</a>
</li>
@endsection

@section('content')
    <!-- Main content -->
    <div class="content">

      <div class="container-fluid">

        <div class="row">
            <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-blue">
              <div class="inner">
                <h3>{{ $electionsa }}/{{ $elections }}</h3>
                <p>Elecciones activas</p>
              </div>
              <div class="icon">
                <i class="fas fa-calendar-alt"></i>
              </div>
              <a href="{{ route('evs.admin.elections') }}" class="small-box-footer">Mas información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

            <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $candidates }}</h3>
                <p>Candidatos Registrados</p>
              </div>
              <div class="icon">
                <i class="fas fa-id-card-alt"></i>
              </div>
              <a href="{{ route('evs.admin.candidates') }}" class="small-box-footer">Mas información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
            <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3>{{ $juries }}</h3>
                <p>Jurados Registrados</p>
              </div>
              <div class="icon">
                <i class="fas fa-gavel"></i>
              </div>
              <a href="{{ route('evs.admin.juries') }}" class="small-box-footer">Mas información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>

      </div><!-- /.container-fluid -->
    <!-- /.content -->
  </div>

@stop