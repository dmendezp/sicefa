
@extends('evs::layouts.master')

@section('title','Juries')

@section('breadcrumb')
<li class="breadcrumb-item active">
  <a href="{{ route('evs.admin.juries') }}"><i class="fas fa-gavel"></i> {{ __('Juries') }}</a>
</li>
@endsection

@section('content')
   
    <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="">
        <div class="card card-purple card-outline shadow">
          <div class="card-header">
            <h3 class="card-title">Jurados</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
          <!-- Timelime example  -->
            <div class="row">
              <div class="col-md-12">
                <!-- The time line -->
                <div class="timeline">
                  <!-- timeline time label -->
                  <div class="time-label">
                    <span class="bg-yellow"> Elecciones </span>
                  </div>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->

                  @foreach($juries as $election) 
                    <div>
                      <i class="fas fa-calendar-alt bg-green"></i>
                      <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i> {{ $election->start_date }} -> {{ $election->end_date }}</span>
                        <h2 class="timeline-header">{{ $election->name }}</h2>
                        <div class="timeline-body row">
                        @foreach($election->juries as $jury)
                            <div class="col-md-3">
                              <div class="card card-purple card-outline shadow">
                                <div class="card-body box-profile">
                                  <h3 class="profile-username text-center">{{ $jury->person->first_name." ".$jury->person->first_last_name." ".$jury->person->second_last_name }}</h3>
                                  <p class="text-muted text-center">Pasante / Instructor / Aprendiz etc</p>
                                </div>
                                <div class="mbottom16 text-center">
                                  @if($election->status=='Activo')
                                    <a href="{{ url('evs/admin/juries/edit/'.$jury->id) }}" class="btn btn-warning btn-circle"><i class="fas fa-edit"></i></a>
                                    <a class="btn btn-danger btn-circle btn-delete"  data-action="delete" data-toggle='tooltip' data-placement="top" data-object="{{ $jury->id }}" data-path="evs/admin/juries"><i class="fas fa-trash-alt"></i></a>
                                  @endif
                                </div>
                              </div>
                            </div>
                          @endforeach
                        </div>
                        <div class="timeline-footer">
                          @if($election->status=='Activo')
                          <a class="btn btn-info btn-sm" href="{{ url('evs/admin/juries/add/'.$election->id) }}">Agregar Jurado</a> 
                          @endif
                        </div>
                      </div>
                    </div>
                  @endforeach             
                  <!-- END timeline item -->
                  <div>
                    <i class="fas fa-clock bg-gray"></i>
                  </div>
                </div><!-- /.timeline -->
              </div> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
    <!-- /.content -->



@stop